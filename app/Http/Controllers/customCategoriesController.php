<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom_categories_pizza;
use App\Models\Custom_categories_properties;
use App\Models\Custom_categories_size_properties;
use Illuminate\Support\Facades\DB;

class CustomCategoriesController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'form_target' => 'required|array',
            'form_target.*' => 'required|string',
            'from1.categories' => 'required|string',
            'size' => 'required|array',
            'size.*' => 'nullable|string',
            'price' => 'required|array',
            'price.*' => 'nullable|numeric',
            'allowed_flavor' => 'required|array',
            'allowed_flavor.*' => 'nullable|string',
        ]);

        try {
            // Begin transaction
            DB::beginTransaction();

            // Simpan data untuk Custom_categories_pizza
            $customPizza = Custom_categories_pizza::create([
                'categories_type' => $validatedData['from1']['categories'],
                'is_active' => true,
            ]);

            // Simpan data untuk Custom_categories_size_properties
            $sizes = $validatedData['size'];
            $prices = $validatedData['price'];
            $allowedFlavors = $validatedData['allowed_flavor'];

            // Simpan relasi Custom_categories_size_properties
            foreach ($sizes as $index => $size) {
                if (!empty($size)) {
                    $customPizza->sizeProperties()->create([
                        'size' => $size,
                        'price' => $prices[$index],
                        'allowed_flavor' => $allowedFlavors[$index],
                    ]);
                }
            }

            // Simpan data tambahan ke Custom_categories_properties jika diperlukan
            if ($request->has('form_target')) {
                foreach ($validatedData['form_target'] as $target) {
                    Custom_categories_properties::create([
                        'categories_ID' => $customPizza->categories_ID,
                        'properties_name' => $target,
                        'price' => 0, // Default price jika tidak ada
                        'is_active' => true,
                    ]);
                }
            }

            // Commit transaction
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi kesalahan
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        // Temukan menu berdasarkan ID
        $menuCustom = Custom_categories_pizza::find($id);

        // Jika menu tidak ditemukan
        if (!$menuCustom) {
            return redirect()->back()->with('error', 'Menu not found.');
        }

        // Hapus menu
        $menuCustom->delete();

        // Jika berhasil menghapus menu
        return redirect()->back()->with('success', 'Menu deleted successfully.');
    }
}
