<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DinkesHealthygateController extends Controller
{
    public function index()
    {
        // PERPANJANGAN
        $perpanjangan = DB::table('perpanjangan_healthygate')
            ->join('izin_healthygates', 'izin_healthygates.id', '=', 'perpanjangan_healthygate.id_healthygate')
            ->join('users', 'users.id', '=', 'izin_healthygates.id_user')
            ->where('izin_healthygates.status_proses', 'dinkes')
            ->select(
                'izin_healthygates.id',
                'users.nama',
                'perpanjangan_healthygate.id_healthygate',
                'perpanjangan_healthygate.izin_usaha_terbit',
                'perpanjangan_healthygate.created_at',
                'izin_healthygates.status_proses',
                'izin_healthygates.status',
                'izin_healthygates.jenis_izin',
                'izin_healthygates.jenis_usaha',
            )
            ->where('izin_healthygates.status', 'Diproses')
            ->orderBy('perpanjangan_healthygate.created_at', 'desc')
            ->get();
                
        // PERMOHONAN
        $permohonan = DB::table('izin_healthygates')
            ->join('users', 'users.id', '=', 'izin_healthygates.id_user')
            ->where('izin_healthygates.status_proses', 'dinkes')
            ->where('izin_healthygates.jenis_izin', 'Permohonan')
            ->select(
                'izin_healthygates.id',
                'users.nama',
                'izin_healthygates.jenis_usaha',
                'izin_healthygates.jenis_izin',
                'izin_healthygates.created_at',
                'izin_healthygates.status_proses',
                'izin_healthygates.status',
                'izin_healthygates.jenis_usaha',
            )
            ->where('izin_healthygates.status', 'Diproses')
            ->orderBy('izin_healthygates.created_at', 'desc')
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


        return view('dinkes.healthygate', [
            'permohonan'   => $permohonan,
            'perpanjangan' => $perpanjangan,
            'berkasKlinik' => $berkasKlinik,
            'berkasApotik' => $berkasApotik,
        ]);
    }

    public function setujui(Request $request, $id)
    {
        // VALIDASI
        $request->validate([
            'surat_rekomendasi' => 'required|file|mimes:pdf|max:5120'
        ]);

        $jenisIzin  = $request->jenis_izin;
        $jenisUsaha = $request->jenis_usaha;
        $file       = $request->file('surat_rekomendasi');

        // Tentukan folder berdasarkan jenis izin
        if ($jenisIzin === 'Perpanjangan') {
            $folder = "healthygate/perpanjangan/{$jenisUsaha}/{$id}";
        } elseif ($jenisIzin === 'Permohonan') {
            $folder = "healthygate/permohonan/{$jenisUsaha}/{$id}";
        } else {
            return back()->with('error', 'Jenis izin tidak valid');
        }

        // Simpan file
        $surat_rekomendasi = $file->store($folder, 'public');

        // Update database
        DB::table('izin_healthygates')
            ->where('id', $id)
            ->update([
                'status'             => 'Diproses',
                'status_proses'      => 'kepala',
                'surat_rekomendasi_dinkes'  => $surat_rekomendasi,
                'updated_at'         => now(),
            ]);

        return back()->with('success', 'Permohonan Healthygate dikirim ke Kepala PTSP!');
    }


    public function tolak($id)
    {
        DB::table('izin_healthygates')
            ->where('id', $id)
            ->update([
                'status'        => 'Ditolak',    // enum-nya Ditolak
                'status_proses' => 'ditolak',    // detail alur
                'keterangan'    => request('keterangan'),   
                'updated_at'    => now(),
            ]);

        // kalau mau simpan alasan, nanti tambah kolom baru misal 'keterangan'
        // dan isi: 'keterangan' => $request->alasan

        return back()->with('success', 'Permohonan Healthygate ditolak oleh Dinkes!');
    }

}
