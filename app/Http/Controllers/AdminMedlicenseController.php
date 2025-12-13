<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMedlicenseController extends Controller
{
    public function index()
    {
        // ----------------------------- //
        // PERMOHONAN (Dokter, Perawat, Bidan, Apoteker)
        // ----------------------------- //

        $dokter = DB::table('berkas_dokter')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_dokter.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_dokter.id_medlicense',
                'users.nama',
                DB::raw("'Dokter' as profesi"),
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses',
                'berkas_dokter.created_at'
            )
            ->where('izin_medlicenses.status', 'Diproses');


        $perawat = DB::table('berkas_perawat')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_perawat.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_perawat.id_medlicense',
                'users.nama',
                DB::raw("'Perawat' as profesi"),
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses',
                'berkas_perawat.created_at'
            )
            ->where('izin_medlicenses.status', 'Diproses');

        $bidan = DB::table('berkas_bidan')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_bidan.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_bidan.id_medlicense',
                'users.nama',
                DB::raw("'Bidan' as profesi"),
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses',
                'berkas_bidan.created_at'
            )
            ->where('izin_medlicenses.status', 'Diproses');

        $apoteker = DB::table('berkas_apoteker')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_apoteker.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_apoteker.id_medlicense',
                'users.nama',
                DB::raw("'Apoteker' as profesi"),
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses',
                'berkas_apoteker.created_at'
            )
            ->where('izin_medlicenses.status', 'Diproses');

        // Gabungkan semua jenis permohonan
        $permohonan = $dokter
            ->unionAll($perawat)
            ->unionAll($bidan)
            ->unionAll($apoteker)
            ->get()
            ->sortByDesc('created_at')
            ->values();


        // ----------------------------- //
        // PERPANJANGAN
        // ----------------------------- //

        $perpanjangan = DB::table('perpanjangan_medlicense')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'perpanjangan_medlicense.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'perpanjangan_medlicense.id_medlicense AS id',  // ← ID yang benar
                'users.nama',
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.status_proses',
                'perpanjangan_medlicense.id_medlicense',
                'perpanjangan_medlicense.izin_profesi_terbit',
                'perpanjangan_medlicense.created_at',
                'izin_medlicenses.status'
            )
            ->where('izin_medlicenses.status', 'Diproses')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $berkasDokter = DB::table('berkas_dokter')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_dokter.id_medlicense')
            ->select(
                'berkas_dokter.*',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_dokter.created_at', 'desc')
            ->get();

        $berkasPerawat = DB::table('berkas_perawat')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_perawat.id_medlicense')
            ->select(
                'berkas_perawat.*',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_perawat.created_at', 'desc')
            ->get();

        $berkasBidan = DB::table('berkas_bidan')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_bidan.id_medlicense')
            ->select(
                'berkas_bidan.*',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_bidan.created_at', 'desc')
            ->get()
        ;

        $berkasApoteker = DB::table('berkas_apoteker')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_apoteker.id_medlicense')
            ->select(
                'berkas_apoteker.*',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_apoteker.created_at', 'desc')
            ->get()
        ;
        
        return view('ptsp.admin-ptsp.medlicense',[
            'permohonan' => $permohonan, 
            'perpanjangan' => $perpanjangan,
            'berkasDokter' => $berkasDokter,
            'berkasPerawat' => $berkasPerawat,
            'berkasBidan' => $berkasBidan,
            'berkasApoteker' => $berkasApoteker
        ]);
    }

    public function setujui($id)
    {
        DB::table('izin_medlicenses')
            ->where('id', $id)
            ->update([
                'status'        => 'Diproses', 
                'status_proses' => 'dinkes', 
                'updated_at' => now()
            ]);

        return back()->with('success', 'Berkas berhasil dikirim ke Dinkes!');
    }

    public function tolak($id) 
    {
        DB::table('izin_medlicenses')
            ->where('id', $id)
            ->update([
                'status'        => 'Ditolak',
                'status_proses' => 'ditolak',
                'keterangan'    => request('keterangan'),
                'updated_at'    => now()
            ]);

        return back()->with('success', 'Berkas ditolak');
    }

}
