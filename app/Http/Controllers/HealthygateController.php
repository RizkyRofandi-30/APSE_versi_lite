<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BerkasApotik;
use App\Models\BerkasKlinik;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\IzinHealthygate;
use Illuminate\Support\Facades\DB;
use App\Models\PerpanjanganHealthygate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Container\Attributes\Auth;



class HealthygateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function permohonan(Request $request)
    {
        $request->validate([
            'jenis_usaha' => 'required|in:apotik,klinik',
        ]);

        $izinData = [
            'id_user'           => $request->user()->id,  
            'jenis_izin'        => $request->jenis_izin,
            'jenis_usaha'       => $request->jenis_usaha,
            'tanggal_pengajuan' => Carbon::now()->toDateString(),
            'status'            => 'Diproses',
            'surat_izin_usaha'  => null,
        ];

        if ($request->jenis_usaha === 'klinik' && $request->jenis_izin === 'Permohonan') {
            return $this->handleKlinik($request, $izinData);
        }

        if ($request->jenis_usaha === 'apotik' && $request->jenis_izin === 'Permohonan') {
            return $this->handleApotik($request, $izinData);
        }

        if ($request->jenis_izin === 'Perpanjangan') {
            print('Redirect kesini rek');
        }

        // Tidak akan sampai sini, tapi sebagai fallback:
        abort(400, "Jenis usaha tidak valid.");
    }



    /**
     * Show the form for creating a new resource.
     */
    private function handleKlinik(Request $request, array $izinData)
    {
        // Validasi dokumen klinik
        $request->validate([
            // Dokumen wajib umum
            'surat_permohonan' => 'required|mimes:pdf|max:5000',
            'ktp_pemilik'      => 'required|mimes:pdf|max:5000',
            'npwp_pemilik'     => 'required|mimes:pdf|max:5000',
            'nib'              => 'required|mimes:pdf|max:5000',
            
            // Dokumen spesifik klinik
            'bpjs_pemilik'                  => 'required|mimes:pdf|max:5000',
            'daftar_obat'                   => 'required|mimes:pdf|max:5000',
            'surat_izin_tenaga_kesehatan'   => 'required|mimes:pdf|max:5000',
            'perjanjian_limbah_b3'          => 'required|mimes:pdf|max:5000',
            'deskripsi_pengorganisasian'    => 'required|mimes:pdf|max:5000',
            'lokasi_bangunan'               => 'required|mimes:pdf|max:5000',
            'prasarana_ketenagaan'          => 'required|mimes:pdf|max:5000',
            'peralatan_kesehatan'           => 'required|mimes:pdf|max:5000',
            'kefarmasian'                   => 'required|mimes:pdf|max:5000',
            'laboratorium'                  => 'required|mimes:pdf|max:5000',
        ]);
        
        try {
            // SIMPAN TABEL IZIN HEALTHYGATE
            $izin = IzinHealthygate::create($izinData);
            
            // SIMPAN TABEL BERKAS KLINIK
            $dokumenData = ['id_healthygate' => $izin->id];
            
            foreach ((new BerkasKlinik)->getFillable() as $field) {
                // Lewati id_healthygate karena sudah diisi di atas
                if ($field === 'id_healthygate') continue;
                
                if ($request->hasFile($field)) {
                    $dokumenData[$field] = $request->file($field)->store(
                        "healthygate/permohonan/klinik/{$izin->id}", 
                        'public'
                    );
                }
            }
            
            BerkasKlinik::create($dokumenData);
            
            return redirect()->route('userHealthygate')
                ->with('success', 'Permohonan klinik telah diajukan');
                
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function handleApotik(Request $request, array $izinData)
    {
        $request->validate([
            'surat_permohonan' => 'required|mimes:pdf|max:5000',
            'ktp_pemilik'      => 'required|mimes:pdf|max:5000',
            'npwp_pemilik'     => 'required|mimes:pdf|max:5000',
            'nib'              => 'required|mimes:pdf|max:5000',
            
            'sip_apt_jawab'           => 'required|mimes:pdf|max:5000',
            'denah_lokasi'            => 'required|mimes:pdf|max:5000',
            'denah_ruangan'           => 'required|mimes:pdf|max:5000',
            'sip_asisten_apoteker'    => 'required|mimes:pdf|max:5000',
            'daftar_peralatan_apotik' => 'required|mimes:pdf|max:5000',
            'rekom_puskesmas'         => 'required|mimes:pdf|max:5000',
            'imb_pbg'                 => 'required|mimes:pdf|max:5000',
            'pbb_tahun'               => 'required|mimes:pdf|max:5000',
            'sppl'                    => 'required|mimes:pdf|max:5000',
            'bpjs_apoteker'           => 'required|mimes:pdf|max:5000',
            'bpjs_asisten'            => 'required|mimes:pdf|max:5000',
            'bpjs_kesehatan_asisten'  => 'required|mimes:pdf|max:5000',
            'pas_foto'                => 'required|mimes:pdf|max:5000',
        ]);

        try {
            // Simpan izin
            $izin = IzinHealthygate::create($izinData);

            // Simpan berkas
            $dokumenData = ['id_healthygate' => $izin->id];

            foreach ((new BerkasApotik)->getFillable() as $field) {
                if ($field === 'id_healthygate') continue;

                if ($request->hasFile($field)) {
                    $dokumenData[$field] = $request->file($field)->store(
                        "healthygate/permohonan/apotik/{$izin->id}",
                        'public'
                    );
                }
            }

            BerkasApotik::create($dokumenData);

            return redirect()->route('userHealthygate')
                ->with('success', 'Permohonan apotik telah diajukan');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function showHealthygate(Request $request)
    {
        try {
            $suratLayanan = IzinHealthygate::with(['user'])
                ->where('id_user', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('healthygate.dashboard', compact('suratLayanan'));
                
        } catch (Exception $e) {
            return redirect()->route('dashboard')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function perpanjangan(Request $request)
    {
        $validated = $request->validate([
            'jenis_usaha' => 'required|in:apotik,klinik',
            'jenis_izin' => 'required|in:Perpanjangan',
            'izin_usaha_terbit' => 'required|file|mimes:pdf|max:5000',
        ]);

        DB::beginTransaction();

        try {
            // Create the main izin record first (without file path initially)
            $izinHealthygate = IzinHealthygate::create([
                'id_user' => $request->user()->id,
                'jenis_izin' => $validated['jenis_izin'],
                'jenis_usaha' => $validated['jenis_usaha'],
                'tanggal_pengajuan' => now(),
                'status' => 'Diproses',
                'surat_izin_usaha' => null, // Will update after file is stored
            ]);

            // Store the uploaded file with the new path format
            $filePath = null;
            if ($request->hasFile('izin_usaha_terbit')) {
                $filePath = $request->file('izin_usaha_terbit')->store(
                    "healthygate/perpanjangan/{$validated['jenis_usaha']}/{$izinHealthygate->id}", 
                    'public'
                );
                
            }

            // Create the perpanjangan record
            $perpanjanganData = [
                'id_healthygate' => $izinHealthygate->id,
                'izin_usaha_terbit' => $filePath,
            ];
            
            PerpanjanganHealthygate::create($perpanjanganData);

            DB::commit();

            // Redirect with success message
            return redirect()->route('userHealthygate')
                ->with('success', 'Pengajuan perpanjangan layanan berhasil dikirim!');

        } catch (Exception $e) {
            DB::rollBack();
            
            // If there's an error, delete any uploaded file
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
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
