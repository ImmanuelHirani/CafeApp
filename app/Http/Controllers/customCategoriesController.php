<?php

namespace App\Http\Controllers;

use App\Models\custom_categories;
use Illuminate\Http\Request;
use App\Models\Custom_categories_pizza;
use App\Models\custom_properties;
use App\Models\custom_size;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class CustomCategoriesController extends Controller
{

    public function adminCustomOrder()
    {
        // Mengambil data kategori beserta properties dan sizes
        $categories = custom_categories::with(['properties'])->get();

        return view('Backend.Admin-Customs-Order', [
            'categories' => $categories,
        ]);
    }

    public function getCategoriesDetails($id)
    {
        // Ambil detail kategori berdasarkan ID
        $detailCategories = custom_categories::with(['properties'])->find($id);
        $categories = custom_categories::with(['properties'])->get();
        $sizes = custom_size::all();

        // Jika kategori tidak ditemukan
        if (!$categories) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        if (!$detailCategories) {
            return redirect()->route('admin.custom.order')->with('error', 'Category Details not Found.');
        }

        // Return view dengan data kategori dan detail
        return view('Backend.Admin-Customs-Order', [
            'categories' => $categories,
            'detailCategories' => $detailCategories,
            'sizes' => $sizes,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'form_target' => 'required|array',
            'form_target.*' => 'required|string',
            'from1.categories' => 'required|string',
            'properties_name' => 'required|array',
            'properties_name.*' => 'nullable|string',
            'price' => 'required|array',
            'price.*' => 'nullable|numeric',
        ]);

        try {
            // Begin transaction

            DB::beginTransaction();

            // Simpan data untuk Custom_categories_pizza
            $customPizza = custom_categories::create([
                'categories_type' => $validatedData['from1']['categories'],
                'is_active' => true,
            ]);

            // Ambil ID kategori yang baru dibuat
            $categoriesID = $customPizza->categories_ID;

            // Simpan data untuk custom_properties
            $propertiesNames = $validatedData['properties_name'];
            $prices = $validatedData['price'];

            foreach ($propertiesNames as $index => $property) {
                if (!empty($property)) {
                    custom_properties::create([
                        'categories_ID' => $categoriesID, // Gunakan ID kategori yang baru dibuat
                        'properties_name' => $property,
                        'price' => $prices[$index] ?? 0, // Menggunakan harga yang diberikan, atau default 0
                        'is_active' => true,
                    ]);
                }
            }

            // Commit transaction
            DB::commit();

            return redirect()->back()->with('success', 'Data Store.');
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi kesalahan
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Had been a problem: ' . $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        // Temukan menu berdasarkan ID
        $menuCustom = custom_categories::find($id);

        // Jika menu tidak ditemukan
        if (!$menuCustom) {
            return redirect()->back()->with('error', 'Menu not found.');
        }

        // Hapus menu
        $menuCustom->delete();

        // Jika berhasil menghapus menu
        return redirect()->back()->with('success', 'Menu deleted .');
    }

    // Method untuk menyimpan data berdasarkan categories_ID
    public function storeProperties(Request $request, $id)
    {
        // Validasi form input
        $request->validate([
            'properties_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            // Insert data ke tabel custom_properties
            custom_properties::create([
                'categories_ID' => $id,
                'properties_name' => $request->input('properties_name'),
                'price' => $request->input('price'),
                'is_active' => 1, // Default aktif
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'New Topping added.');
        } catch (\Exception $e) {
            // Tangani error jika ada
            return redirect()->back()->with('error', 'Failed to add Topping. Please try again.');
        }
    }

    public function updateProperties(Request $request)
    {
        // Validasi input
        $request->validate([
            'properties.*.name' => 'nullable|string|max:255',
            'properties.*.price' => 'nullable|numeric|min:0',
            'properties.*.is_active' => 'nullable|boolean', // Validate as boolean
            'sizeProperties.*.size' => 'nullable|string|max:255',
            'sizeProperties.*.price' => 'nullable|numeric|min:0',
            'sizeProperties.*.allowed_flavor' => 'nullable|string|max:255',
        ]);

        // Update untuk Topping List (Table: properties)
        if ($request->has('properties')) {
            foreach ($request->properties as $id => $propertyData) {
                $existingProperty = custom_properties::find($id);

                if (!$existingProperty) {
                    continue; // Skip jika ID tidak ditemukan
                }

                $name = $propertyData['name'] ?? null;
                $price = $propertyData['price'] ?? null;
                $status = $propertyData['is_active'] ?? $existingProperty->is_active; // Gunakan nilai lama jika null

                // Periksa apakah ada perubahan data
                if (
                    $name !== $existingProperty->properties_name ||
                    $price != $existingProperty->price || // Gunakan == agar numeric dibandingkan
                    $status != $existingProperty->is_active
                ) {
                    $existingProperty->update([
                        'properties_name' => $name,
                        'price' => $price,
                        'is_active' => $status,
                    ]);
                }
            }
        }

        // Update untuk Size List (Table: custom_size)
        if ($request->has('sizeProperties')) {
            foreach ($request->sizeProperties as $id => $sizeData) {
                $existingSize = custom_size::find($id);

                if (!$existingSize) {
                    continue; // Skip jika ID tidak ditemukan
                }

                $size = $sizeData['size'] ?? null;
                $price = $sizeData['price'] ?? null;
                $allowed_flavor = $sizeData['allowed_flavor'] ?? null;

                // Periksa apakah ada perubahan data
                if (
                    $size !== $existingSize->size ||
                    $price != $existingSize->price || // Gunakan == agar numeric dibandingkan
                    $allowed_flavor !== $existingSize->allowed_flavor
                ) {
                    $existingSize->update([
                        'size' => $size,
                        'price' => $price,
                        'allowed_flavor' => $allowed_flavor,
                    ]);
                }
            }
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data updated ');
    }


    public function updateStatus(Request $request, $categoriesID)
    {
        // Validasi input status
        $validated = $request->validate([
            'is_active' => 'required',
        ]);

        // Temukan order transaction berdasarkan order ID
        $customCategories = custom_categories::where('categories_ID', $categoriesID)->first();

        if ($customCategories) {
            // Update status_order dengan nilai yang dipilih
            $customCategories->is_active = $request->is_active;
            $customCategories->save(); // simpan perubahan

            // Kembalikan response sukses
            return back()->with('success', 'status updated.');
        } else {
            // Jika order tidak ditemukan
            return back()->with('error', 'not found.');
        }
    }


    public function storeSizeProperties(Request $request)
    {
        // Validasi input
        $request->validate([
            'size' => 'required|array',
            'size.*' => 'required|string|max:5',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
            'allowed_flavor' => 'required|array',
            'allowed_flavor.*' => 'required|integer|min:1',
        ]);

        // Loop untuk menyimpan setiap data berdasarkan indeks
        foreach ($request->size as $index => $size) {
            custom_size::updateOrCreate(
                [
                    'size' => $size, // Kondisi unik jika ingin menghindari duplikat
                ],
                [
                    'price' => $request->price[$index],
                    'allowed_flavor' => $request->allowed_flavor[$index],
                ]
            );
        }

        return redirect()->back()->with('success', 'Size Added');
    }
}
