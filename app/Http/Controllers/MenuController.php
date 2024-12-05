<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\MenuRepo;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;


class MenuController extends Controller
{
    private MenuRepo $menuRepo;

    public function __construct(MenuRepo $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }
    public function NewMenu(Request $request)
    {
        $validated = $request->validate([
            'menu_type' => 'required|string|min:1|max:10',
            'image' => 'required|mimes:jpg,jpeg,bmp,png|max:2048',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'stock' => 'required|integer|min:1|max:100',
            'menu_description' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:255',
            'price' => 'required|numeric|min:20000|max:250000',
            'is_active' => 'required|int|min:0|max:1',
        ]);

        try {
            // Proses upload gambar
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('menu_images', 'public');
                $validated['image'] = $imagePath;
            }

            // Delegasikan insert ke repository
            $this->menuRepo->insert($validated);

            return redirect()->back()->with('success', 'New Menu Added');
        } catch (\Exception $e) {
            Log::error('Menu insertion error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to add : ' . $e->getMessage()]);
        }
    }

    public function updateMenu(Request $request, $id)
    {
        $validated = $request->validate([
            'menu_type' => 'required|string|min:1|max:10',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png|max:2048',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'stock' => 'required|integer|min:1|max:100',
            'menu_description' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:255',
            'price' => 'required|numeric|min:20000|max:250000',
            'is_active' => 'required|int|min:0|max:1',
        ]);
        try {
            $menu = Menu::find($id);

            if (!$menu) {
                return redirect()->back()->withErrors(['error' => 'Menu not found.']);
            }

            // Proses upload gambar jika ada
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('menu_images', 'public');
                $validated['image'] = $imagePath; // Tambahkan path gambar yang baru
            }

            // Delegasikan update ke repository
            $this->menuRepo->update($menu, $validated);

            return redirect()->route('menu.details', ['id' => $id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            Log::error('Menu update error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update: ' . $e->getMessage()]);
        }
    }

    public function getMenuDetails($id)
    {
        try {
            // Menemukan menu berdasarkan ID
            $menus = Menu::all();
            $menuDetails = Menu::find($id);

            // Mengecek apakah menu ditemukan
            if (!$menuDetails) {
                return redirect()->route('menu.index')->withErrors(['error' => 'Menu not found']);
            }

            // Mengecek apakah request ini untuk halaman admin atau frontend
            if (request()->is('admin/*')) {
                // Jika rute dimulai dengan 'admin/', tampilkan tampilan admin
                return view('Backend.Admin-Product', [
                    'menus' => $menus,
                    'menusDetails' => $menuDetails, // Data detail menu berdasarkan ID
                ]);
            } else {
                // Jika bukan admin, tampilkan tampilan frontend
                return view('Frontend.menu-detail', [
                    'menus' => $menus,
                    'menusDetails' => $menuDetails,
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
