<?php

namespace App\Http\Controllers;

use App\Models\favorite_menu;
use Illuminate\Http\Request;
use App\Repository\MenuRepo;
use App\Models\Menu;
use App\Models\menuProperties;
use App\Models\MenuReview;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;


class MenuController extends Controller
{

    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function NewMenu(Request $request)
    {
        $validated = $request->validate([
            'menu_type' => 'required|string|min:1|max:10',
            'image' => 'required|mimes:jpg,jpeg,bmp,png|max:2048',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:40',
            'stock' => 'required|integer|min:0|max:100',
            'menu_description' => 'required|string|min:1|max:255',
            'is_active' => 'required|int|min:0|max:1',
        ]);
        try {
            // Panggil service untuk menangani logika pembuatan menu
            $newMenu = $this->menuService->createNewMenu($validated);

            return redirect()->back()->with('success', 'New Menu and Default Sizes Added');
        } catch (\Exception $e) {
            Log::error('Menu creation error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to add menu: ' . $e->getMessage()]);
        }
    }

    public function updateMenu(Request $request, $id)
    {
        // Validasi data untuk menu utama
        $validated = $request->validate([
            'menu_type' => 'required|string|min:1|max:10',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png|max:2048',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:40',
            'stock' => 'required|integer|min:0|max:100',
            'menu_description' => 'required|string|min:1|max:255',
            'is_active' => 'required|int|min:0|max:1',
            'price' => 'numeric|min:20000|max:200000',
        ]);

        // Ambil data menu utama
        try {
            $this->menuService->updateMenu($id, $validated, $request);
        } catch (\Exception $e) {
            Log::error('Menu update error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update menu: ' . $e->getMessage()]);
        }

        // Jika ada data properties, lakukan pembaruan
        if ($request->has('properties')) {
            $propertiesData = $request->input('properties');

            try {
                foreach ($propertiesData as $propertyData) {
                    if (empty($propertyData['property_ID'])) {
                        throw new \Exception('Invalid property ID.');
                    }

                    // Convert price to integer if it's not
                    $propertyData['price'] = isset($propertyData['price']) ? intval($propertyData['price']) : null;

                    $updateData = [
                        'size' => $propertyData['size'] ?? null,
                        'price' => $propertyData['price'] ?? null,
                        'is_active_properties' => $propertyData['is_active_properties'] ?? 1,
                    ];

                    MenuProperties::where('property_ID', $propertyData['property_ID'])
                        ->where('menu_ID', $id)
                        ->update($updateData);
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Failed to update properties: ' . $e->getMessage()]);
            }
        }

        // Setelah sukses update menu dan properties, arahkan kembali ke detail produk
        return redirect()->route('admin.product.detail', ['id' => $id])
            ->with('success', 'Updated Successfully');
    }

    public function getMenuDetails($id, $size = null)
    {
        try {
            // Menemukan menu berdasarkan ID dengan relasi menu_properties dan reviews beserta customer-nya
            $menuDetails = Menu::with(['properties', 'reviews.customer'])->where('menu_ID', $id)->first();

            if (!$menuDetails) {
                return redirect()->route('menu.index')->withErrors(['error' => 'Menu not found']);
            }

            // Jika size diberikan, cari property berdasarkan size
            $selectedProperty = $size ? $menuDetails->properties->firstWhere('size', $size) : $menuDetails->properties->first();
            $selectedPrice = $selectedProperty ? $selectedProperty->price : null;

            // Ambil data review terkait menu
            $menuReviews = $menuDetails->reviews; // Pastikan ini mengambil semua review terkait menu

            // Menghitung rata-rata rating
            $averageRating = $menuReviews->avg('rating');
            $averageRating = round($averageRating, 1); // Pembulatan ke 1 desimal

            // Mendapatkan semua menu untuk digunakan dalam view
            $menus = Menu::all();

            // Tentukan tampilan berdasarkan rute (admin atau frontend)
            if (request()->is('admin/*')) {
                return view('Backend.Admin-Product', compact('menuDetails', 'menus', 'selectedProperty', 'selectedPrice', 'menuReviews', 'averageRating'));
            } else {
                return view('Frontend.menu-detail', compact('menuDetails', 'menus', 'selectedProperty', 'selectedPrice', 'menuReviews', 'averageRating'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to get details: ' . $e->getMessage()]);
        }
    }


    public function deleteMenu($id)
    {
        // Menemukan menu yang ingin dihapus
        if (!$this->menuService->deleteMenuById($id)) {
            return redirect()->back()->with('error', 'Menu not found.');
        }

        // Jika berhasil menghapus menu
        return redirect()->route('admin.product')->with('success', 'Menu deleted successfully.');
    }

    public function Product()
    {
        $menus = Menu::with('properties')->get();

        // Menentukan tampilan berdasarkan kondisi (misalnya, rute atau role)
        if (request()->is('admin/*')) {
            // Jika rute dimulai dengan 'admin/', tampilkan tampilan admin
            return view('Backend.Admin-Product', [
                'menus' => $menus,
            ]);
        } else {
            // Jika bukan bagian admin, tampilkan tampilan frontend
            return view('Frontend.Menu', [
                'menus' => $menus,
            ]);
        }
    }

    public function addToFav(Request $request)
    {
        // Mendapatkan data customer yang sedang login
        $customer = Auth::user();

        $customer = Auth::user();

        if (!$customer) {
            return response()->json([
                'message' => 'Login First!',
            ], 400);
        }


        // Validasi input untuk memastikan menu_ID diberikan
        $request->validate([
            'menu_ID' => 'required|exists:menu_items,menu_ID',
        ]);

        // Mendapatkan ID menu dari request
        $menuID = $request->input('menu_ID');

        // Memastikan menu belum ada di daftar favorit
        $existingFavorite = favorite_menu::where('customer_ID', $customer->customer_ID)
            ->where('menu_ID', $menuID)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'message' => 'Already Added to Favorite',
            ], 400);
        }

        // Menambahkan menu ke daftar favorit
        favorite_menu::create([
            'customer_ID' => $customer->customer_ID,
            'menu_ID' => $menuID,
        ]);

        return response()->json([
            'message' => 'Menu Added To Favorite',
        ], 200);
    }

    public function storeReview(Request $request)
    {
        // Mendapatkan user yang login
        $customer = Auth::user();

        if (!$customer) {
            return redirect()->back()->with('error', 'login First!');
        }

        // Validasi data yang diterima dari request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_desc' => 'required|string|max:100',
            'menu_ID' => 'required|exists:menu_items,menu_ID',
            'customer_ID' => 'required|exists:customers,customer_ID',
        ]);

        // Cek apakah customer sudah memberikan review untuk menu ini
        $existingReview = MenuReview::where('menu_ID', $request->menu_ID)
            ->where('customer_ID', $request->customer_ID)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this menu!');
        }

        // Menyimpan review baru
        MenuReview::create([
            'customer_ID' => $request->customer_ID,
            'menu_ID' => $request->menu_ID,
            'rating' => $request->rating,
            'review_desc' => $request->review_desc,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
}
