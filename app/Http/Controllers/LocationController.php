<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class locationController extends Controller
{
    public function addlocation(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'location_label' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'reciver_address' => 'required|string|min:1|max:500',
            'reciver_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'reciver_number' => 'required|regex:/^[0-9]{10,15}$/',
        ]);

        // Ambil model customer berdasarkan ID pengguna yang login
        $customer = User::find(Auth::id());

        if (!$customer) {
            return back()->withErrors(['error' => 'customer not found.']);
        }

        // Cek apakah user sudah memiliki 2 lokasi
        if ($customer->locationuser()->count() >= 2) {
            return back()->withErrors(['error' => 'only 2 locations allowed.']);
        }

        // Buat lokasi baru
        $location = new Location();
        $location->user_id = $customer->user_ID; // Assuming 'user_id' is the correct column name
        $location->location_label = $validatedData['location_label'];
        $location->reciver_address = $validatedData['reciver_address'];
        $location->reciver_name = $validatedData['reciver_name'];
        $location->reciver_number = $validatedData['reciver_number'];
        $location->is_primary = $customer->locationuser()->count() === 0 ? 1 : 0; // Set lokasi pertama sebagai primary
        $location->save();

        return back()->with('success', 'Location added ');
    }


    public function deletelocation($locationID)
    {
        // Cari item berdasarkan orderDetailID
        $location = location::find($locationID);

        // Hapus item dari keranjang
        $location->delete();

        return redirect()->back()->with('success', 'location Deleted');
    }

    public function updatePrimary($locationID)
    {
        // Cari lokasi berdasarkan ID
        $location = location::find($locationID);

        if (!$location) {
            // Jika lokasi tidak ditemukan, redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'location not found.');
        }

        // Atur semua lokasi milik pengguna menjadi tidak primary
        location::where('user_ID', $location->user_ID)->update(['is_primary' => 0]);

        // Atur lokasi yang dipilih menjadi primary
        $location->is_primary = 1;
        $location->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'location has been changed.');
    }

    public function getlocationData($locationId)
    {
        $location = location::find($locationId);

        if (!$location) {
            return response()->json(['error' => 'location not found'], 404);
        }

        return response()->json([
            'location_ID' => $location->location_ID,
            'location_label' => $location->location_label,
            'reciver_address' => $location->reciver_address,
            'reciver_name' => $location->reciver_name,
            'reciver_number' => $location->reciver_number,
        ]);
    }

    public function updatelocation(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'location_label' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'reciver_address' => 'required|string|min:1|max:500',
            'reciver_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:1|max:30',
            'reciver_number' => 'required|regex:/^[0-9]{10,15}$/',
        ]);

        // Ambil lokasi berdasarkan ID yang diberikan dari input tersembunyi
        $location = location::find($request->input('locationID'));

        if (!$location) {
            return back()->withErrors(['error' => 'location not found.']);
        }

        // Periksa apakah lokasi ini milik customer yang sedang login
        if ($location->user_ID !== Auth::id()) {
            return back()->withErrors(['error' => 'Unauthorized action.']);
        }

        // Update data lokasi
        $location->location_label = $validatedData['location_label'];
        $location->reciver_address = $validatedData['reciver_address'];
        $location->reciver_name = $validatedData['reciver_name'];
        $location->reciver_number = $validatedData['reciver_number'];
        $location->save();

        return back()->with('success', 'location updated');
    }
}
