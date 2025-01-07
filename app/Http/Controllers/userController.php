<?php

namespace App\Http\Controllers;

use App\Services\userService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\menus;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    private userService $userService;

    public function __construct(userService $userService)
    {
        $this->userService = $userService;
    }
    // Bussines Logic
    public function Register(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email' => 'required|email|unique:users,email', // Pastikan email unik
            'phone' => 'required|unique:users,phone|regex:/^[0-9]{10,15}$/', // Validasi nomor telepon (opsional)
            'password' => 'required|min:4', // Konfirmasi password
        ]);

        try {
            // Ambil data dari form dan hash password
            $data = $request->only(['email', 'phone', 'password']);

            // Panggil service untuk membuat user
            $user = $this->userService->registeruser($data);

            // Redirect ke halaman yang ditentukan dengan pesan sukses
            return redirect()->route('template')->with('success', 'Register Successfully');
        } catch (\Exception $e) {
            // Log error untuk debugging (opsional)
            Log::error('Error during user registration: ' . $e->getMessage());

            // Redirect kembali dengan pesan kesalahan
            return redirect()->back()->withErrors(['error' => 'Failed to register user.'])->withInput();
        }
    }

    // Register Admin
    public function RegisterAdmin(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone|regex:/^[0-9]{10,15}$/',
            'password' => 'required|min:4',
            'user_type' => 'required|in:admin,owner', // Validasi pilihan user_type
        ]);

        try {
            // Ambil data dari form dan hash password
            $data = $request->only(['email', 'phone', 'password', 'user_type']);

            // Panggil service untuk membuat user
            $user = $this->userService->registerAdmin($data);

            // Redirect ke halaman yang ditentukan dengan pesan sukses
            return redirect()->back()->with('success', 'Register Successfully');
        } catch (\Exception $e) {
            // Log error untuk debugging (opsional)
            Log::error('Error during user registration: ' . $e->getMessage());

            // Redirect kembali dengan pesan kesalahan
            return redirect()->back()->withErrors(['error' => 'Failed to register user.'])->withInput();
        }
    }

    public function updateuser(Request $request, $user_ID)
    {
        // Ambil data user dari database
        $user = Auth::user();

        // Validasi apakah user valid
        if (!$user || $user->user_ID != $user_ID) {
            return redirect()->back()->with('error', 'Unauthorized or User Not Found');
        }

        // Validasi data dengan pengecualian untuk email dan phone milik sendiri
        $validatedData = $request->validate([
            'username' => 'required|string|max:30',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->user_ID, 'user_ID'),
            ],
            'phone' => [
                'required',
                'regex:/^[0-9]{10,15}$/',
                Rule::unique('users', 'phone')->ignore($user->user_ID, 'user_ID'),
            ],
            'image' => 'nullable|image|mimes:jpeg,png|max:1024', // Maks. 1 MB
        ]);

        // Panggil service untuk update
        $updateduser = $this->userService->updateuser($user, $validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    // Login untuk user (customer)
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        // Login menggunakan guard 'web' untuk customer
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            // Pastikan user_type adalah customer
            if ($user->user_type === 'customer') {
                $request->session()->regenerate();
                return redirect()->back()->with('success', 'Welcome!');
            }

            // Jika bukan customer, logout
            Auth::guard('web')->logout();
            return back()->withErrors(['email' => 'Anda tidak memiliki akses sebagai customer.']);
        }

        return back()->withErrors(['email' => 'Login gagal! Email atau password salah.']);
    }

    // Login untuk admin
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        // Login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Pastikan user_type adalah admin atau owner
            if (in_array($user->user_type, ['admin', 'owner'])) {
                $request->session()->regenerate();
                return redirect()->route('Dashboard.view')->with('success', 'Welcome Admin!');
            }

            // Jika bukan admin atau owner, logout
            Auth::guard('admin')->logout();
            return back()->withErrors(['email' => 'Anda tidak memiliki akses sebagai admin.']);
        }

        return back()->withErrors(['email' => 'Login gagal! Email atau password salah.']);
    }


    public function logoutUser(Request $request)
    {
        // Logout untuk guard 'web' (customer)
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('template')->with('success', 'Logout berhasil.');
    }


    public function logoutAdmin(Request $request)
    {
        // Logout untuk guard 'admin'
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.auth')->with('success', 'Logout berhasil.');
    }




    public function getuserDetails($id)
    {
        // Jika menu tidak ditemukan, kirimkan error
        try {
            $userDetails = user::with('locationuser')->find($id);
            $users = user::all();
            // Mengembalikan view dengan data JSON dan semua menu
            return view('Backend.Admin-users', [
                'users' => $users,
                'userDetails' =>  $userDetails, // Data detail menu berdasarkan ID
            ]);
        } catch (\Exception $e) {
            if (! $userDetails) {
                return redirect()->back()->withErrors(['error' => 'Failed to get details: ' . $e->getMessage()]);
            }
        }
    }
    // View
    public function viewAdmin()
    {
        $users = user::all();

        return view('Backend.Admin-users', [
            'users' => $users,
        ]);
    }

    public function index()
    {
        $menus = menus::all();
        return view('Frontend.index', [
            'menus' => $menus
        ]);
    }

    public function updateStatus(Request $request, $userID)
    {
        // Validasi input status
        $validated = $request->validate([
            'is_active' => 'required',
        ]);

        // Temukan order transaction berdasarkan order ID
        $users = user::where('user_ID', $userID)->first();

        if ($users) {
            // Update status_order dengan nilai yang dipilih
            $users->is_active = $request->is_active;
            $users->save(); // simpan perubahan

            // Kembalikan response sukses
            return back()->with('success', 'status updated.');
        } else {
            // Jika order tidak ditemukan
            return back()->with('error', 'not found.');
        }
    }

    public function adminAuth()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user sudah login dan memiliki user_type 'admin' atau 'owner'
        if ($user && in_array($user->user_type, ['admin', 'owner'])) {
            // Redirect kembali dengan pesan bahwa user sudah login
            return redirect()->back()->with('success', 'Log out First');
        }

        // Jika belum login atau user bukan admin/owner, lanjutkan ke view
        return view('Backend.Admin-Auth');
    }
}
