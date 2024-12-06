<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\MenuProperties;
use App\Repository\MenuRepo;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuService
{
    protected $menuRepo;

    public function __construct(MenuRepo $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    public function createNewMenu(array $data)
    {
        try {
            // Proses upload gambar
            if (isset($data['image'])) {
                $image = $data['image'];
                $imagePath = Storage::disk('public')->put('menu_images', $image);
                $data['image'] = $imagePath;
            }

            // Buat menu baru menggunakan Repository
            $newMenu = $this->menuRepo->create($data);

            // Menambahkan menu properties default dengan price = 0
            $this->addMenuProperties($newMenu->menu_ID);

            return $newMenu;
        } catch (\Exception $e) {
            Log::error('Error while creating new menu: ' . $e->getMessage());
            throw new \Exception('Failed to create menu: ' . $e->getMessage());
        }
    }

    private function addMenuProperties($menuId)
    {
        // Default size yang akan ditambahkan
        $sizes = ['sm', 'md', 'lg', 'xl'];

        // Loop untuk menambahkan menu properties dengan price = 0
        foreach ($sizes as $size) {
            MenuProperties::create([
                'menu_ID' => $menuId,
                'size' => $size,
                'price' => 0, // Set price default 0
                'is_active' => 1, // Default aktif
            ]);
        }
    }

    public function updateMenu(Request $request, $id, $size = null)
    {
        $validated = $request->validate([
            'menu_type' => 'required|string|min:1|max:10',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png|max:2048',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'stock' => 'required|integer|min:1|max:100',
            'menu_description' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:255',
            'is_active' => 'required|int|min:0|max:1',
            'price' => 'required|numeric|min:20000',
            'is_active_properties' => 'required|int|min:0|max:1',
        ]);

        try {
            $menu = Menu::find($id);

            if (!$menu) {
                return 'Menu not found.';
            }

            // Proses upload gambar jika ada
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('menu_images', 'public');
                $validated['image'] = $imagePath;
            }


            $properties = menuProperties::where('menu_ID', $id)
                ->where('size', $size) // Pastikan size diikutsertakan
                ->first();

            if (!$properties) {
                Log::error("MenuProperties not found for menu_ID: $id and size: $size");
                return 'Size not found for this menu.';
            }

            // Simpan perubahan menggunakan repository
            $this->menuRepo->update($menu, $properties, $validated);

            return 'Menu and size properties updated successfully.';
        } catch (\Exception $e) {
            Log::error('Menu update error: ' . $e->getMessage());
            return 'Failed to update menu: ' . $e->getMessage();
        }
    }
}
