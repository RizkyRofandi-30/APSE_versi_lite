<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutentikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $request->validate([
            'password'  => 'required|string|min:5',
            'nik'  => 'required|string|min:5',
            'email'     => 'required|email|unique:users,email',
            'nama'      => 'required|string|max:50',
            'no_telp'   => 'required|string|min:5',
            'role'     => 'required|string',
            'source'   => 'required|string',
        ],
        [
            'password.required' =>  'Password harus diisi',
            'password.min'      =>  'Password minimal 5 karakter',

            'nik.required' =>  'Nik harus diisi',
            'nik.min'      =>  'Nik minimal 5 karakter',

            'email.required'    => 'Email harus diisi',
            'email.unique'      => 'Email sudah terdaftar',

            'nama.required'     => 'Nama harus diisi',

            'no_telp.required' => 'Nomor telpon harus diisi',
            'no_telp.min'     => 'Nomor telpon minimal 5',
            
        ]);

        $user = User::create([
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'email' => $request->email,
            'nama'=> $request->nama,
            'no_telp'=> $request->no_telp
        ]);

        Auth::login($user); 

        if ($request->source === "healthygate" && $request->role === 'pemohon') {
            return redirect()->route('userHealthygate')->with('success', 'Berhasil registrasi');
        }

        if ($request->source === 'medlicense' && $request->role === 'pemohon'){
            return redirect()->route('userMedlicense')->with('success', 'Berhasil registrasi');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
            'source' => 'required'
        ]);
        
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)){
            return back()->withErrors([
                'login' => 'email atau password salah',
            ]);
        }
        
        Auth::login($user);
        
        // Mapping: role + source → route name
        $redirectMap = [
            'pemohon' => [
                'healthygate' => 'userHealthygate',
                'medlicense'  => 'userMedlicense',
            ],
            'admin_ptsp' => [
                'healthygate' => 'admin-ptsphealthygate',
                'medlicense'  => 'admin-ptspMedlicense',
            ],
            'kepala_ptsp' => [
                'healthygate' => 'kepala-ptspHealthygate', 
                'medlicense'  => 'kepala-ptspMedlicense',  // fill later
            ],
            'admin_dinkes' => [
                'healthygate' => 'dinkesHealthygate', // fill later
                'medlicense'  => 'dinkesMedlicense',  // fill later
            ],
        ];

        // Ambil role & source
        $role   = $user->role;
        $source = $request->source;

        // Cek apakah route tersedia dalam mapping
        if (isset($redirectMap[$role][$source])) {
            return redirect()
                ->route($redirectMap[$role][$source])
                ->with('success', 'login berhasil');
        }

        // Default jika tidak cocok
        return redirect()->route('home')->with('error', 'Role atau source tidak valid');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
