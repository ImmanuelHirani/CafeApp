<?php

namespace App\Http\Controllers;

use App\Models\favorite_menu;
use Illuminate\Http\Request;
use App\Repository\MenuRepo;
use App\Models\Menu;
use App\Models\menu_size;
use App\Models\menu_review;
use App\Models\menus;
use App\Models\transaction_details;
use App\Models\user;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'image' => 'required|mimes:jpg,jpeg,bmp,png',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:40',
            'stock' => 'required|integer|min:0|max:100',
            'menu_description' => 'required|string|min:1|max:255',
            'is_active' => 'required|int|min:0|max:1',
        ]);
        try {
            // Panggil service untuk menangani logika pembuatan menu
            $newMenu = $this->menuService->createNewMenu($validated);

            return redirect()->back()->with('success', 'Added');
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
                    if (empty($propertyData['menu_size_ID'])) {
                        throw new \Exception('Invalid property ID.');
                    }

                    // Convert price to integer if it's not
                    $propertyData['price'] = isset($propertyData['price']) ? intval($propertyData['price']) : null;

                    $updateData = [
                        'size' => $propertyData['size'] ?? null,
                        'price' => $propertyData['price'] ?? null,
                        'is_active_properties' => $propertyData['is_active_properties'] ?? 1,
                    ];

                    menu_size::where('menu_size_ID', $propertyData['menu_size_ID'])
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
            $menuDetails = menus::with(['properties', 'reviews.user'])->where('menu_ID', $id)->first();

            if (!$menuDetails) {
                return redirect()->route('menu.index')->withErrors(['error' => 'Menu not found']);
            }

            // Jika parameter size diberikan, validasi size
            if ($size) {
                $selectedProperty = $menuDetails->properties->firstWhere('size', $size);

                // Periksa apakah properti ditemukan dan is_active_properties = 1
                if (!$selectedProperty || $selectedProperty->is_active_properties == 0) {
                    return redirect()->back()->withErrors(['error' => 'Size not available']);
                }
            }

            // Ambil property pertama jika size tidak diberikan
            $selectedProperty = $selectedProperty ?? $menuDetails->properties->first();
            $selectedPrice = $selectedProperty ? $selectedProperty->price : null;

            // Ambil data review terkait menu
            $menuReviews = $menuDetails->reviews; // Pastikan ini mengambil semua review terkait menu

            // Menghitung rata-rata rating
            $averageRating = $menuReviews->avg('rating');
            $averageRating = round($averageRating, 1); // Pembulatan ke 1 desimal

            // Mendapatkan semua menu untuk digunakan dalam view
            $menus = menus::all();

            // Mengambil semua menu yang paling sering dibeli (kecuali custom_menu)
            $topProducts = transaction_details::select('menu_ID', DB::raw('SUM(quantity) as total_quantity'))
                ->with('menu') // Memuat relasi menu
                ->whereHas('menu', function ($query) {
                    $query->where('menu_type', '!=', 'custom_menu'); // Mengabaikan custom_menu
                })
                ->groupBy('menu_ID')
                ->orderByDesc('total_quantity')
                ->get()
                ->map(function ($product) {
                    $menu = $product->menu;
                    if ($menu) {
                        $menu->total_quantity = $product->total_quantity;
                    }
                    return $menu;
                })
                ->filter();

            // Mengambil menu dengan rating tertinggi
            $topRatings = menu_review::select('menu_ID', DB::raw('AVG(rating) as avg_rating'))
                ->with(['menu', 'menu.properties']) // Memuat relasi menu dan properties
                ->groupBy('menu_ID')
                ->orderByDesc('avg_rating')
                ->get()
                ->map(function ($review) {
                    $menu = $review->menu;
                    if ($menu) {
                        $menu->avg_rating = round($review->avg_rating, 1); // Menambahkan rata-rata rating
                    }
                    return $menu;
                })
                ->filter();

            // Tentukan tampilan berdasarkan rute (admin atau frontend)
            if (request()->is('admin/*')) {
                return view('Backend.Admin-Product', compact('menuDetails', 'topProducts', 'topRatings',  'menus', 'selectedProperty', 'selectedPrice', 'menuReviews'));
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
        $menus = menus::with('properties')->get();

        // Mengambil semua menu yang paling sering dibeli (kecuali custom_menu)
        $topProducts = transaction_details::select('menu_ID', DB::raw('SUM(quantity) as total_quantity'))
            ->with('menu') // Memuat relasi menu
            ->whereHas('menu', function ($query) {
                $query->where('menu_type', '!=', 'custom_menu'); // Mengabaikan custom_menu
            })
            ->groupBy('menu_ID')
            ->orderByDesc('total_quantity')
            ->get()
            ->map(function ($product) {
                $menu = $product->menu;
                if ($menu) {
                    $menu->total_quantity = $product->total_quantity;
                }
                return $menu;
            })
            ->filter();

        // Mengambil menu dengan rating tertinggi
        $topRatings = menu_review::select('menu_ID', DB::raw('AVG(rating) as avg_rating'))
            ->with(['menu', 'menu.properties']) // Memuat relasi menu dan properties
            ->groupBy('menu_ID')
            ->orderByDesc('avg_rating')
            ->get()
            ->map(function ($review) {
                $menu = $review->menu;
                if ($menu) {
                    $menu->avg_rating = round($review->avg_rating, 1); // Menambahkan rata-rata rating
                }
                return $menu;
            })
            ->filter();


        // Menentukan tampilan berdasarkan kondisi (misalnya, rute atau role)
        if (request()->is('admin/*')) {

            // Ambil data user dari database menggunakan guard 'admin'
            $user = Auth::guard('admin')->user();

            // Validasi apakah user valid dan memiliki user_type admin atau owner
            if (!$user || !in_array($user->user_type, ['admin', 'owner'])) {
                return redirect()->route('admin.auth')->with('error', 'Login First');
            }

            // Jika rute dimulai dengan 'admin/', tampilkan tampilan admin
            return view('Backend.Admin-Product', [
                'menus' => $menus,
                'topProducts' => $topProducts,
                'topRatings' => $topRatings,
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
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Login First!',
            ], 400);
        }


        // Validasi input untuk memastikan menu_ID diberikan
        $request->validate([
            'menu_ID' => 'required|exists:menus,menu_ID',
        ]);

        // Mendapatkan ID menu dari request
        $menuID = $request->input('menu_ID');

        // Memastikan menu belum ada di daftar favorit
        $existingFavorite = favorite_menu::where('user_ID', $user->user_ID)
            ->where('menu_ID', $menuID)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'message' => 'Already Added to Favorite',
            ], 400);
        }

        // Menambahkan menu ke daftar favorit
        favorite_menu::create([
            'user_ID' => $user->user_ID,
            'menu_ID' => $menuID,
        ]);

        return response()->json([
            'message' => 'Menu Added To Favorite',
        ], 200);
    }

    public function storeReview(Request $request)
    {
        // Mendapatkan user yang login
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Login first!');
        }

        // Pesan kesalahan kustom
        $customMessages = [
            'rating.required' => 'At least put 1 star to review!',
            'rating.min' => 'At least put 1 star to review!',
            'rating.integer' => 'The rating must be a valid number.',
            'review_desc.required' => 'Please provide a description for your review.',
            'review_desc.max' => 'Your review is too long. Max 255 characters allowed.',
            'menu_ID.exists' => 'The selected menu item is invalid.',
            'user_ID.exists' => 'The customer ID is invalid.',
        ];

        // Validasi data yang diterima dari request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_desc' => 'required|string|max:255', // Validasi panjang maksimal 255 karakter
            'menu_ID' => 'required|exists:menus,menu_ID',
            'user_ID' => 'required|exists:users,user_ID',
        ], $customMessages);

        // Memeriksa apakah user sudah memberikan review untuk menu yang sama
        $existingReview = menu_review::where('user_ID', $request->user_ID)
            ->where('menu_ID', $request->menu_ID)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Only 1 review is allow');
        }

        // Menyimpan review baru
        menu_review::create([
            'user_ID' => $request->user_ID,
            'menu_ID' => $request->menu_ID,
            'rating' => $request->rating,
            'review_desc' => $request->review_desc,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }


    public function deleteReview($reviewID)
    {
        // Temukan review atau gagal dengan 404
        $review = menu_review::findOrFail($reviewID);

        // Ambil user ID dari user yang sedang login
        $loggedInUserId = Auth::id(); // Gunakan Auth::id() untuk mendapatkan ID user saat ini

        // Cek apakah review milik pengguna yang sedang login
        if ($review->user_ID !== $loggedInUserId) {
            // Jika tidak, tampilkan pesan error atau redirect
            return redirect()->back()->with('error', 'Unauthorized: Not yours');
        }

        // Hapus review
        $review->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Review Deleted.');
    }
}
