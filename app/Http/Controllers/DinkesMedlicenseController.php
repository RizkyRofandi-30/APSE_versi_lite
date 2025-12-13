<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DinkesMedlicenseController extends Controller
{
    public function index()
    {
        // ================ PERPANJANGAN ================
        $perpanjangan = DB::table('perpanjangan_medlicense')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'perpanjangan_medlicense.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->where('izin_medlicenses.status_proses', 'dinkes')
            ->select(
                'izin_medlicenses.id',
                'users.nama',
                'perpanjangan_medlicense.id_medlicense',
                'perpanjangan_medlicense.izin_profesi_terbit',
                'perpanjangan_medlicense.created_at',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses',
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.jenis_profesi'
            )
            ->where('izin_medlicenses.status', 'Diproses')
            ->orderBy('perpanjangan_medlicense.created_at', 'desc')
            ->get();

        // ================ PERMOHONAN BIASA ================
        $permohonan = DB::table('izin_medlicenses')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->where('izin_medlicenses.status_proses', 'dinkes')
            ->where('izin_medlicenses.jenis_izin', 'Permohonan')
            ->select(
                'izin_medlicenses.id',
                'users.nama',
                'izin_medlicenses.jenis_profesi',
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.created_at',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses'
            )
            ->where('izin_medlicenses.status', 'Diproses')
            ->orderBy('izin_medlicenses.created_at', 'desc')
            ->get();

        $berkasDokter = DB::table('berkas_dokter')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_dokter.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_dokter.*',
                'users.nama',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_dokter.created_at', 'desc')
            ->get();

        $berkasPerawat = DB::table('berkas_perawat')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_perawat.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_perawat.*',
                'users.nama',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_perawat.created_at', 'desc')
            ->get();

        $berkasBidan = DB::table('berkas_bidan')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_bidan.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_bidan.*',
                'users.nama',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_bidan.created_at', 'desc')
            ->get()
        ;

        $berkasApoteker = DB::table('berkas_apoteker')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'berkas_apoteker.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->select(
                'berkas_apoteker.*',
                'users.nama',
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_apoteker.created_at', 'desc')
            ->get()
        ;

        return view('dinkes.medlicense',[
            'permohonan' => $permohonan, 
            'perpanjangan' => $perpanjangan,
            'berkasDokter' => $berkasDokter,
            'berkasPerawat' => $berkasPerawat,
            'berkasBidan' => $berkasBidan,
            'berkasApoteker' => $berkasApoteker
        ]);
    }

    // =========================
    // SETUJUI OLEH DINKES
    // =========================
    public function setujui(Request $request, $id)
    {
        // VALIDASI
        $request->validate([
            'surat_rekomendasi' => 'required|file|mimes:pdf|max:5120'
        ]);

        $jenisIzin  = $request->jenis_izin;
        $jenisProfesi = $request->jenis_profesi;
        $file       = $request->file('surat_rekomendasi');

        // Tentukan folder berdasarkan jenis izin
        if ($jenisIzin === 'Perpanjangan') {
            $folder = "medlicense/perpanjangan/{$jenisProfesi}/{$id}";
        } elseif ($jenisIzin === 'Permohonan') {
            $folder = "medlicense/permohonan/{$jenisProfesi}/{$id}";
        } else {
            return back()->with('error', 'Jenis izin tidak valid');
        }

        // Simpan file
        $surat_rekomendasi = $file->store($folder, 'public');

        // Update database
        DB::table('izin_medlicenses')
            ->where('id', $id)
            ->update([
                'status'             => 'Diproses',
                'status_proses'      => 'kepala',
                'surat_rekomendasi_dinkes'  => $surat_rekomendasi,
                'updated_at'         => now(),
            ]);

        return back()->with('success', 'Permohonan Medlicense dikirim dinkes ke Kepala PTSP!');
    }

    // =========================
    // TOLAK OLEH DINKES
    // =========================
    public function tolak(Request $request, $id)
    {
        DB::table('izin_medlicenses')
            ->where('id', $id)
            ->update([
                // enum status → Ditolak
                'status'        => 'Ditolak',
                'status_proses' => 'ditolak',
                'keterangan'    => request('keterangan'),
                'updated_at'    => now(),
            ]);

        // kalau mau simpan alasan, nanti perlu kolom baru, misal `keterangan`
        // dan diisi: 'keterangan' => $request->alasan

        return back()->with('success', 'Permohonan telah ditolak oleh Dinkes!');
    }
}
