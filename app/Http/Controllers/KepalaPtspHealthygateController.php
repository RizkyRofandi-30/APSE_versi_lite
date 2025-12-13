<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepalaPtspHealthygateController extends Controller
{
    public function index()
    {
        // PERPANJANGAN (sudah sampai Kepala PTSP)
        $perpanjangan = DB::table('perpanjangan_healthygate')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'perpanjangan_healthygate.id_healthygate')
            ->join('users', 'users.id', '=', 'izin_healthygates.id_user')
            ->where('izin_healthygates.status_proses', 'kepala')
            ->select(
                'izin_healthygates.id',            // id izin_healthygates
                'users.nama',
                'izin_healthygates.jenis_izin',
                'izin_healthygates.jenis_usaha',
                'perpanjangan_healthygate.izin_usaha_terbit',
                'perpanjangan_healthygate.created_at',
                'izin_healthygates.status',
                'izin_healthygates.status_proses',
                'izin_healthygates.surat_rekomendasi_dinkes',
            )
            ->orderBy('perpanjangan_healthygate.created_at', 'desc')
            ->get();

        // PERMOHONAN (Permohonan biasa yang sudah sampai Kepala PTSP)
        $permohonan = DB::table('izin_healthygates')
            ->join('users', 'users.id', '=', 'izin_healthygates.id_user')
            ->where('izin_healthygates.status_proses', 'kepala')
            ->where('izin_healthygates.jenis_izin', 'Permohonan')
            ->select(
                'izin_healthygates.id',
                'users.nama',
                'izin_healthygates.jenis_izin',
                'izin_healthygates.jenis_usaha',
                'izin_healthygates.created_at',
                'izin_healthygates.status',                
                'izin_healthygates.status_proses',                
            )
            ->orderBy('izin_healthygates.created_at', 'desc')
            ->get();
        
        // ---------------------------------------------------------
        // AMBIL DATA BERKAS KLINIK (TANPA UNION)
        // ---------------------------------------------------------

        $berkasKlinik = DB::table('berkas_klinik')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'berkas_klinik.id_healthygate')
            ->select('berkas_klinik.*','izin_healthygates.surat_rekomendasi_dinkes', 'izin_healthygates.id as id_permohonan')
            ->orderBy('berkas_klinik.created_at', 'desc')
            ->get();

        // ---------------------------------------------------------
        // AMBIL DATA BERKAS APOTIK (TANPA UNION)
        // ---------------------------------------------------------

        $berkasApotik = DB::table('berkas_apotik')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'berkas_apotik.id_healthygate')
            ->select(
                'berkas_apotik.*',
                'izin_healthygates.surat_rekomendasi_dinkes',
                'izin_healthygates.status'
            )
            ->orderBy('berkas_apotik.created_at', 'desc')
            ->get();

        return view('ptsp.kepala-ptsp.healthygate',[
            'permohonan'   => $permohonan,
            'perpanjangan' => $perpanjangan,
            'berkasKlinik' => $berkasKlinik,
            'berkasApotik' => $berkasApotik,
        ]);
    }

    // Kepala PTSP menyetujui
    public function setujui(Request $request,$id)
    {
        $request->validate([
            'surat_izin_usaha' => 'required|file|mimes:pdf|max:5120'
        ]);

        $jenisIzin  = $request->jenis_izin;
        $jenisUsaha = $request->jenis_usaha;
        $file       = $request->file('surat_izin_usaha');

        // Tentukan folder berdasarkan jenis izin
        if ($jenisIzin === 'Perpanjangan') {
            $folder = "healthygate/perpanjangan/{$jenisUsaha}/{$id}";
        } elseif ($jenisIzin === 'Permohonan') {
            $folder = "healthygate/permohonan/{$jenisUsaha}/{$id}";
        } else {
            return back()->with('error', 'Jenis izin tidak valid');
        }

        // Simpan file
        $surat_izin_usaha = $file->store($folder, 'public');

        // Update database
        DB::table('izin_healthygates')
            ->where('id', $id)
            ->update([  
                'status'             => 'Diterima',
                'status_proses'      => 'selesai',
                'surat_izin_usaha'   => $surat_izin_usaha,
                'Keterangan'         => 'Surat Izin Telah Terbit',
                'updated_at'         => now(),
            ]);

        return back()->with('success', 'Permohonan Healthygate disetujui Kepala PTSP!');
    }

    // Kepala PTSP menolak
    public function tolak(Request $request, $id)
    {
        DB::table('izin_healthygates')
            ->where('id', $id)
            ->update([
                'status'        => 'Ditolak',
                'status_proses' => 'ditolak',
                'keterangan'    => request('keterangan'),  
                'updated_at'    => now(),
            ]);

        return back()->with('success', 'Permohonan Healthygate ditolak oleh Kepala PTSP!');
    }
}
