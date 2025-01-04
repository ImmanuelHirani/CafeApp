<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\menu_size;
use App\Models\MenuProperties;
use App\Models\menus;
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
            menu_size::create([
                'menu_ID' => $menuId,
                'size' => $size,
                'price' => 0, // Set price default 0
                'is_active' => 1, // Default aktif
            ]);
        }
    }

    public function updateMenu($id, array $validated, Request $request)
    {
        // Mencari menu
        $menu = $this->menuRepo->find($id);

        if (!$menu) {
            throw new \Exception('Menu not found.');
        }

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('menu_images', 'public');
            $validated['image'] = $imagePath;
        }

        // Memperbarui menu menggunakan repository
        $this->menuRepo->update($menu, $validated);
    }


    public function deleteMenuById(int $id): bool
    {
        $menu = menus::find($id);

        if ($menu) {
            $menu->delete();
            return true;
        }

        return false;
    }
}
