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
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
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

    public function updateMenu(Request $request, $id, $size = null)
    {
        // Memanggil service untuk memperbarui menu
        $result = $this->menuService->updateMenu($request, $id,);

        // Mengecek apakah update berhasil atau gagal
        if ($result == 'Menu not found.' || $result == 'Size not found for this menu.' || strpos($result, 'Failed') === 0) {
            return redirect()->back()->withErrors(['error' => $result]);
        }

        return redirect()->route('admin.product.detail', ['id' => $id])->with('success', $result);
    }


    public function getMenuDetails($id, $size = null)
    {
        try {
            // Menemukan menu berdasarkan ID
            $menuDetails = Menu::find($id);

            // Mengecek apakah menu ditemukan
            if (!$menuDetails) {
                return redirect()->route('menu.index')->withErrors(['error' => 'Menu not found']);
            }

            // Jika ada size, cari properti berdasarkan size
            $menuProperties = $size ? $menuDetails->properties()->where('size', $size)->first() : null;

            // Mengatur ukuran yang dipilih
            $selectedSize = $size;

            // Mengecek apakah request ini untuk halaman admin atau frontend
            if (request()->is('admin/*')) {
                // Jika rute dimulai dengan 'admin/', tampilkan tampilan admin
                return view('Backend.Admin-Product', [
                    'menus' => Menu::all(),
                    'menusDetails' => $menuDetails,
                    'menuProperties' => $menuProperties,
                    'selectedSize' => $selectedSize,
                ]);
            } else {
                // Jika bukan admin, tampilkan tampilan frontend
                return view('Frontend.menu-detail', [
                    'menus' => Menu::all(),
                    'menusDetails' => $menuDetails,
                    'menuProperties' => $menuProperties,
                    'selectedSize' => $selectedSize,
                ]);
            }
        } catch (\Exception $e) {
            // Menangani error dan mengarahkan kembali dengan pesan kesalahan
            return redirect()->back()->withErrors(['error' => 'Failed to get details: ' . $e->getMessage()]);
        }
    }


    public function deleteMenu($id)
    {
        // Menemukan menu yang ingin dihapus
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->back()->with('error', 'Menu not found.');
        }

        // Melakukan penghapusan
        if ($this->menuRepo->delete($id)) {
            // Mengalihkan ke daftar menu setelah berhasil dihapus
            return redirect()->route('admin.product')->with('success', 'Menu deleted successfully.');
        }

        // Jika gagal menghapus menu
        return redirect()->back()->with('error', 'Failed to delete menu.');
    }

    public function Product()
    {
        $menus = Menu::all();

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
