<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custom_categories_pizza;
use App\Models\Custom_categories_properties;
use App\Models\Custom_categories_size_properties;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomCategoriesController extends Controller
{

    public function adminCustomOrder()
    {
        // Mengambil data kategori beserta properties dan sizes
        $categories = Custom_categories_pizza::with(['properties'])->get();

        return view('Backend.Admin-Customs-Order', [
            'categories' => $categories,
        ]);
    }

    public function getCategoriesDetails($id)
    {
        // Ambil detail kategori berdasarkan ID
        $detailCategories = Custom_categories_pizza::with(['properties'])->find($id);
        $categories = Custom_categories_pizza::with(['properties'])->get();
        $sizes = Custom_categories_size_properties::all();

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
            $customPizza = Custom_categories_pizza::create([
                'categories_type' => $validatedData['from1']['categories'],
                'is_active' => true,
            ]);

            // Ambil ID kategori yang baru dibuat
            $categoriesID = $customPizza->categories_ID;

            // Simpan data untuk Custom_categories_properties
            $propertiesNames = $validatedData['properties_name'];
            $prices = $validatedData['price'];

            foreach ($propertiesNames as $index => $property) {
                if (!empty($property)) {
                    Custom_categories_properties::create([
                        'categories_ID' => $categoriesID, // Gunakan ID kategori yang baru dibuat
                        'properties_name' => $property,
                        'price' => $prices[$index] ?? 0, // Menggunakan harga yang diberikan, atau default 0
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

    // Method untuk menyimpan data berdasarkan categories_ID
    public function storeProperties(Request $request, $id)
    {
        // Validasi form input
        $request->validate([
            'properties_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            // Insert data ke tabel custom_categories_properties
            Custom_categories_properties::create([
                'categories_ID' => $id,
                'properties_name' => $request->input('properties_name'),
                'price' => $request->input('price'),
                'is_active' => 1, // Default aktif
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'New Topping successfully added.');
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
            'sizeProperties.*.size' => 'nullable|string|max:255',
            'sizeProperties.*.price' => 'nullable|numeric|min:0',
            'sizeProperties.*.allowed_flavor' => 'nullable|string|max:255',
        ]);

        // Update untuk Topping List (Table: properties)
        if ($request->has('properties')) {
            foreach ($request->properties as $id => $propertyData) {
                $name = $propertyData['name'] ?? null;
                $price = $propertyData['price'] ?? null;

                // Lakukan update hanya jika salah satu data tidak null
                if (!is_null($name) || !is_null($price)) {
                    Custom_categories_properties::where('properties_ID', $id)->update([
                        'properties_name' => $name,
                        'price' => $price,
                    ]);
                }
            }
        }

        // Update untuk Size List (Table: custom_categories_size_properties)
        if ($request->has('sizeProperties')) {
            foreach ($request->sizeProperties as $id => $sizeData) {
                $size = $sizeData['size'] ?? null;
                $price = $sizeData['price'] ?? null;
                $allowed_flavor = $sizeData['allowed_flavor'] ?? null;

                // Lakukan update hanya jika salah satu data tidak null
                if (!is_null($size) || !is_null($price) || !is_null($allowed_flavor)) {
                    Custom_categories_size_properties::where('size_ID', $id)->update([
                        'size' => $size,
                        'price' => $price,
                        'allowed_flavor' => $allowed_flavor,
                    ]);
                }
            }
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function updateStatus(Request $request, $categoriesID)
    {
        // Validasi input status
        $validated = $request->validate([
            'is_active' => 'required',
        ]);

        // Temukan order transaction berdasarkan order ID
        $customCategories = Custom_categories_pizza::where('categories_ID', $categoriesID)->first();

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
            Custom_categories_size_properties::updateOrCreate(
                [
                    'size' => $size, // Kondisi unik jika ingin menghindari duplikat
                ],
                [
                    'price' => $request->price[$index],
                    'allowed_flavor' => $request->allowed_flavor[$index],
                ]
            );
        }

        return redirect()->back()->with('success', 'Size properties berhasil ditambahkan atau diperbarui.');
    }
}
