<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\MenuRepo;
use App\Models\Menu;
use App\Models\menuProperties;
use App\Services\MenuService;
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
            'stock' => 'required|integer|min:1|max:100',
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
            'stock' => 'required|integer|min:1|max:100',
            'menu_description' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:255',
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
            // Menemukan menu berdasarkan ID dengan relasi menu_properties
            $menuDetails = Menu::with('properties')->where('menu_ID', $id)->first();

            // Mengecek apakah menu ditemukan
            if (!$menuDetails) {
                return redirect()->route('menu.index')->withErrors(['error' => 'Menu not found']);
            }

            // Jika size diberikan, kita cari property berdasarkan size yang dipilih
            if ($size) {
                // Mencari property berdasarkan size yang dipilih
                $selectedProperty = $menuDetails->properties->firstWhere('size', $size);
            } else {
                // Jika size tidak diberikan, pilih property pertama (default)
                $selectedProperty = $menuDetails->properties->first();
            }

            // Mengecek apakah properti dengan ukuran yang dipilih ada
            if ($selectedProperty) {
                $selectedPrice = $selectedProperty->price;
            } else {
                $selectedPrice = null; // Jika tidak ada harga untuk ukuran yang dipilih
            }

            // Mendapatkan semua menu untuk digunakan dalam view
            $menus = Menu::all();

            // Mengecek apakah request ini untuk halaman admin atau frontend
            if (request()->is('admin/*')) {
                // Jika rute dimulai dengan 'admin/', tampilkan tampilan admin
                return view('Backend.Admin-Product', compact('menuDetails', 'menus', 'selectedProperty', 'selectedPrice'));
            } else {
                // Jika bukan admin, tampilkan tampilan frontend
                return view('Frontend.menu-detail', compact('menuDetails', 'menus', 'selectedProperty', 'selectedPrice'));
            }
        } catch (\Exception $e) {
            // Menangani error dan mengarahkan kembali dengan pesan kesalahan
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
}
