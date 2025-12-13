<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHealthygateController extends Controller
{
    public function index()
    {
        // -----------------------------
        // PERMOHONAN
        // -----------------------------

        $klinik = DB::table('berkas_klinik')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'berkas_klinik.id_healthygate')
            ->join('users', 'users.id', '=', 'izin_healthygates.id_user')
            ->select(
                'berkas_klinik.id_healthygate AS id',   // ← ID izin_healthygates
                'users.nama',
                DB::raw("'Klinik' as jenis_izin"),
                'berkas_klinik.created_at',
                'izin_healthygates.status',
                'izin_healthygates.status_proses',
            )
            ->where('izin_healthygates.status', 'Diproses');

        $apotik = DB::table('berkas_apotik')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'berkas_apotik.id_healthygate')
            ->join('users', 'users.id', '=', 'izin_healthygates.id_user')
            ->select(
                'berkas_apotik.id_healthygate AS id',   // ← ID izin_healthygates
                'users.nama',
                DB::raw("'Apotik' as jenis_izin"),
                'berkas_apotik.created_at',
                'izin_healthygates.status',
                'izin_healthygates.status_proses',
            )
            ->where('izin_healthygates.status', 'Diproses');

        // Gabungkan
        $permohonan = $klinik
            ->unionAll($apotik)
            ->get()
            ->sortByDesc('created_at')
            ->values();


        // -----------------------------
        // PERPANJANGAN
        // -----------------------------

        $perpanjangan = DB::table('perpanjangan_healthygate')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'perpanjangan_healthygate.id_healthygate')
            ->join('users', 'users.id', '=', 'izin_healthygates.id_user')
            ->select(
                'perpanjangan_healthygate.id_healthygate AS id', // ← ID izin_healthygates
                'users.nama',
                'izin_healthygates.jenis_izin',
                'izin_healthygates.status_proses',
                'perpanjangan_healthygate.id_healthygate',
                'perpanjangan_healthygate.izin_usaha_terbit',
                'perpanjangan_healthygate.created_at',
                'izin_healthygates.status'
            )
            ->where('izin_healthygates.status', 'Diproses')
            ->orderBy('perpanjangan_healthygate.created_at', 'desc')
            ->get();


        // ---------------------------------------------------------
        // AMBIL DATA BERKAS KLINIK (TANPA UNION)
        // ---------------------------------------------------------

        $berkasKlinik = DB::table('berkas_klinik')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'berkas_klinik.id_healthygate')
            ->select('berkas_klinik.*', 'izin_healthygates.id as id_permohonan')
            ->orderBy('berkas_klinik.created_at', 'desc')
            ->get();


        // ---------------------------------------------------------
        // AMBIL DATA BERKAS APOTIK (TANPA UNION)
        // ---------------------------------------------------------

        $berkasApotik = DB::table('berkas_apotik')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'berkas_apotik.id_healthygate')
            ->select(
                'berkas_apotik.*',
                'izin_healthygates.status'
            )
            ->orderBy('berkas_apotik.created_at', 'desc')
            ->get();

        // ---------------------------------------------------------
        // RETURN SEMUA DATA KE VIEW
        // ---------------------------------------------------------

        return view('ptsp.admin-ptsp.healthygate', [
            'permohonan'   => $permohonan,
            'perpanjangan' => $perpanjangan,
            'berkasKlinik' => $berkasKlinik,
            'berkasApotik' => $berkasApotik,
        ]);
    }

    public function berkasKlinikAjax($id)
    {
        $berkasKlinik = DB::table('berkas_klinik')
            ->where('id_healthygate', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('components.berkas-klinik', compact('berkasKlinik'))->render();
    }


    public function setujui($id)
    {
        DB::table('izin_healthygates')
            ->where('id', $id)
            ->update([
                'status'        => 'Diproses',   // HARUS salah satu dari enum
                'status_proses' => 'dinkes',    // pindah alur ke Dinkes
                'updated_at'    => now()
            ]);

        return back()->with('success', 'Berkas Healthygate berhasil dikirim ke Dinkes!');
    }

    public function tolak($id) 
    {
        DB::table('izin_healthygates')
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
