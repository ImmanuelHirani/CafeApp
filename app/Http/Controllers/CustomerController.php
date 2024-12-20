<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;



class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    // Bussines Logic
    public function Register(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email' => 'required|email|unique:customers,email', // Pastikan email unik
            'phone' => 'required|regex:/^[0-9]{10,15}$/', // Validasi nomor telepon (opsional)
            'password' => 'required|min:4', // Konfirmasi password
        ]);

        try {
            // Ambil data dari form dan hash password
            $data = $request->only(['email', 'phone', 'password']);

            // Panggil service untuk membuat customer
            $customer = $this->customerService->registerCustomer($data);

            // Redirect ke halaman yang ditentukan dengan pesan sukses
            return redirect()->route('template')->with('success', 'Register Successfully');
        } catch (\Exception $e) {
            // Log error untuk debugging (opsional)
            Log::error('Error during customer registration: ' . $e->getMessage());

            // Redirect kembali dengan pesan kesalahan
            return redirect()->back()->withErrors(['error' => 'Failed to register customer.'])->withInput();
        }
    }
    public function updateCustomer(Request $request, $customer_ID)
    {
        $request->validate([
            'username' => 'required|string|max:30',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'image' => 'nullable|image|mimes:jpeg,png|max:1024', // Maks. 1 MB
        ]);

        // Ambil data dari request
        $data = $request->only(['username', 'email', 'phone']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image'); // Simpan file langsung
        }

        // Validasi customer
        $customer = Auth::user();
        if (!$customer || $customer->customer_ID != $customer_ID) {
            return redirect()->back()->with('error', 'Unauthorized or User Not Found');
        }

        // Panggil service untuk update
        $this->customerService->updateCustomer($customer, $data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('template')->with([
                'success' => 'Login Success',
            ]);;
        }

        return back()->withErrors([
            'email' => 'Password Or Email Wrong.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('template')->with(['success' => 'Logout success',]);
    }
    public function getCustomerDetails($id)
    {
        // Jika menu tidak ditemukan, kirimkan error
        try {
            // Menemukan menu berdasarkan ID yang diberikan
            $customerDetails = Customer::find($id);
            $customers = Customer::all();
            // Mengembalikan view dengan data JSON dan semua menu
            return view('Backend.Admin-Customers', [
                'customers' => $customers,
                'customerDetails' =>  $customerDetails, // Data detail menu berdasarkan ID
            ]);
        } catch (\Exception $e) {
            if (! $customerDetails) {
                return redirect()->back()->withErrors(['error' => 'Failed to get details: ' . $e->getMessage()]);
            }
        }
    }
    // View
    public function viewAdmin()
    {
        $customers = Customer::all();

        return view('Backend.Admin-Customers', [
            'customers' => $customers,
        ]);
    }
    public function index()
    {
        $menus = Menu::all();
        return view('Frontend.index', [
            'menus' => $menus
        ]);
    }
}
