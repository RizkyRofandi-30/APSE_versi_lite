<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepalaPtspMedlicenseController extends Controller
{
    public function index()
    {
        // PERPANJANGAN (yang sudah sampai di Kepala PTSP)
        $perpanjangan = DB::table('perpanjangan_medlicense')
            ->join('izin_medlicenses', 'izin_medlicenses.id', '=', 'perpanjangan_medlicense.id_medlicense')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->where('izin_medlicenses.status_proses', 'kepala')
            ->select(
                'izin_medlicenses.id',            // id izin_medlicenses
                'users.nama',
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.jenis_profesi',
                'perpanjangan_medlicense.izin_profesi_terbit',
                'perpanjangan_medlicense.created_at',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses',
                'izin_medlicenses.surat_rekomendasi_dinkes',
            )
            ->where('izin_medlicenses.status', 'Diproses')
            ->orderBy('perpanjangan_medlicense.created_at', 'desc')
            ->get();

        // PERMOHONAN (Permohonan biasa yang sudah sampai Kepala PTSP)
        $permohonan = DB::table('izin_medlicenses')
            ->join('users', 'users.id', '=', 'izin_medlicenses.id_user')
            ->where('izin_medlicenses.status_proses', 'kepala')
            ->where('izin_medlicenses.jenis_izin', 'Permohonan')
            ->select(
                'izin_medlicenses.id',
                'users.nama',
                'izin_medlicenses.jenis_izin',
                'izin_medlicenses.jenis_profesi',
                'izin_medlicenses.created_at',
                'izin_medlicenses.status',
                'izin_medlicenses.status_proses',
                'izin_medlicenses.surat_rekomendasi_dinkes',
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
                'izin_medlicenses.surat_rekomendasi_dinkes',
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
                'izin_medlicenses.surat_rekomendasi_dinkes',
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
                'izin_medlicenses.surat_rekomendasi_dinkes',
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
                'izin_medlicenses.surat_rekomendasi_dinkes',    
                'izin_medlicenses.status'
            )
            ->orderBy('berkas_apoteker.created_at', 'desc')
            ->get()
        ;

        // pakai view khusus kepala PTSP
        return view('ptsp.kepala-ptsp.medlicense', [
            'permohonan' => $permohonan, 
            'perpanjangan' => $perpanjangan,
            'berkasDokter' => $berkasDokter,
            'berkasPerawat' => $berkasPerawat,
            'berkasBidan' => $berkasBidan,
            'berkasApoteker' => $berkasApoteker
        ]);
    }

    // Kepala PTSP menyetujui
    public function setujui(Request $request,$id)
    {
        $request->validate([
            'surat_izin_profesi' => 'required|file|mimes:pdf|max:5120'
        ]);

        $jenisIzin  = $request->jenis_izin;
        $jenisProfesi = $request->jenis_profesi;
        $file       = $request->file('surat_izin_profesi');

        // Tentukan folder berdasarkan jenis izin
        if ($jenisIzin === 'Perpanjangan') {
            $folder = "medlicense/perpanjangan/{$jenisProfesi}/{$id}";
        } elseif ($jenisIzin === 'Permohonan') {
            $folder = "medlicense/permohonan/{$jenisProfesi}/{$id}";
        } else {
            return back()->with('error', 'Jenis izin tidak valid');
        }

        // Simpan file
        $surat_izin_profesi = $file->store($folder, 'public');

        // Update database
        DB::table('izin_medlicenses')
            ->where('id', $id)
            ->update([  
                'status'             => 'Diterima',
                'status_proses'      => 'selesai',
                'surat_izin_profesi'   => $surat_izin_profesi,
                'Keterangan'         => 'Surat Izin Telah Terbit',
                'updated_at'         => now(),
            ]);

        return back()->with('success', 'Permohonan Healthygate disetujui Kepala PTSP!');
    }

    // Kepala PTSP menolak
    public function tolak(Request $request, $id)
    {
        DB::table('izin_medlicenses')
            ->where('id', $id)
            ->update([
                'status'        => 'Ditolak',
                'status_proses' => 'ditolak',
                'keterangan'    => request('keterangan'),  
                'updated_at'    => now(),
            ]);

        return back()->with('success', 'Permohonan telah ditolak oleh Kepala PTSP!');
    }
}
