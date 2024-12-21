<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function addLocation(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'location_label' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'reciver_address' => 'required|string|min:1|max:500',
            'reciver_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'reciver_number' => 'required|regex:/^[0-9]{10,15}$/',
        ]);

        // Ambil model Customer berdasarkan ID pengguna yang login
        $customer = Customer::find(Auth::id());

        if (!$customer) {
            return back()->withErrors(['error' => 'Customer not found.']);
        }

        // Cek apakah user sudah memiliki 2 lokasi
        if ($customer->locationCustomer()->count() >= 2) {
            return back()->withErrors(['error' => 'only 2 locations are allowed.']);
        }

        // Buat lokasi baru
        $location = new Location();
        $location->customer_ID = $customer->customer_ID;
        $location->location_label = $validatedData['location_label'];
        $location->reciver_address = $validatedData['reciver_address'];
        $location->reciver_name = $validatedData['reciver_name'];
        $location->reciver_number = $validatedData['reciver_number'];
        $location->is_primary = $customer->locationCustomer()->count() === 0 ? 1 : 0; // Set lokasi pertama sebagai primary
        $location->save();

        return back()->with('success', 'Location added successfully!');
    }

    public function delete($id) {}

    public function deleteLocation($locationID)
    {
        // Cari item berdasarkan orderDetailID
        $location = Location::find($locationID);

        // Hapus item dari keranjang
        $location->delete();

        return redirect()->back()->with('success', 'Location Deleted');
    }

    public function updatePrimary($locationID)
    {
        // Cari lokasi berdasarkan ID
        $Location = Location::find($locationID);

        if (!$Location) {
            // Jika lokasi tidak ditemukan, redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Location not found.');
        }

        // Atur semua lokasi milik pengguna menjadi tidak primary
        Location::where('customer_ID', $Location->customer_ID)->update(['is_primary' => 0]);

        // Atur lokasi yang dipilih menjadi primary
        $Location->is_primary = 1;
        $Location->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Location has been changed.');
    }
}
