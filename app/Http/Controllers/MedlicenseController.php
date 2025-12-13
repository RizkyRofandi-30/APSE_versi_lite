<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BerkasBidan;
use App\Models\BerkasDokter;
use Illuminate\Http\Request;
use App\Models\BerkasPerawat;
use App\Models\BerkasApoteker;
use App\Models\IzinMedlicense;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PerpanjanganMedlicense;
use Illuminate\Support\Facades\Storage;

class MedlicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function permohonan(Request $request)
    {
        $request->validate([
            'jenis_profesi' => 'required|in:dokter,perawat,bidan,apoteker',
        ]);

        $izinData = [
            'id_user'            => $request->user()->id,  
            'jenis_izin'         => $request->jenis_izin,
            'jenis_profesi'      => $request->jenis_profesi,
            'tanggal_pengajuan'  => Carbon::now()->toDateString(),
            'status'             => 'Diproses',
            'surat_izin_profesi' => null
        ];

        if ($request->jenis_profesi === 'dokter' && $request->jenis_izin === 'Permohonan') {
            return $this->handleDokter($request, $izinData);
        }

        if ($request->jenis_profesi === 'perawat' && $request->jenis_izin === 'Permohonan') {
            return $this->handlePerawat($request, $izinData);
        }

        if ($request->jenis_profesi === 'bidan' && $request->jenis_izin === 'Permohonan') {
            return $this->handleBidan($request, $izinData);
        }

        if ($request->jenis_profesi === 'apoteker' && $request->jenis_izin === 'Permohonan') {
            return $this->handleApoteker($request, $izinData);
        }

        if ($request->jenis_izin === 'Perpanjangan') {
            return redirect()->back()->with('error', 'Fitur perpanjangan belum tersedia.');
        }

        abort(400, "Jenis profesi tidak valid.");
    }

    /**
     * Handle dokter submission
     */
    public function handleDokter(Request $request, array $izinData)
    {
        $request->validate([
            // Dokumen wajib umum
            'surat_permohonan'            => 'required|mimes:pdf|max:5000',
            'ktp'                         => 'required|mimes:pdf|max:5000',
            'str'                         => 'required|mimes:pdf|max:5000',
            'ijazah'                      => 'required|mimes:pdf|max:5000',
            'surat_sehat'                 => 'required|mimes:pdf|max:5000',
            'pas_foto'                    => 'required|mimes:pdf|max:5000',
            'npwp'                        => 'required|mimes:pdf|max:5000',
            'bpjs_ketenagakerjaan'        => 'required|mimes:pdf|max:5000',
            'bpjs_kesehatan'              => 'required|mimes:pdf|max:5000',
            
            // Dokumen spesifik dokter
            'sip_dokter'                  => 'required|mimes:pdf|max:5000',
            'rekomendasi_idi'             => 'required|mimes:pdf|max:5000',
            'foto_tempat_praktik'         => 'required|mimes:pdf|max:5000',
            'rekomendasi_puskesmas'       => 'required|mimes:pdf|max:5000',
        ]);
        
        try {
            // SIMPAN TABEL IZIN MEDLICENSE
            $izin = IzinMedlicense::create($izinData);
            
            $dokumenData = ['id_medlicense' => $izin->id];
            
            foreach ((new BerkasDokter)->getFillable() as $field) {
                if ($field === 'id_medlicense') continue;
                
                if ($request->hasFile($field)) {
                    $dokumenData[$field] = $request->file($field)->store(
                        "medlicense/permohonan/dokter/{$izin->id}", 
                        'public'
                    );
                }
            }
            
            BerkasDokter::create($dokumenData);
            
            return redirect()->route('userMedlicense')
                ->with('success', 'Permohonan izin dokter telah diajukan');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function handlePerawat(Request $request, array $izinData) {
        $request->validate([
            'surat_permohonan'      => 'required|file|mimes:pdf|max:5000',
            'ktp'                   => 'required|file|mimes:pdf|max:5000',
            'str'                   => 'required|file|mimes:pdf|max:5000',
            'ijazah'                => 'required|file|mimes:pdf|max:5000',
            'surat_sehat'           => 'required|file|mimes:pdf|max:5000',
            'pas_foto'              => 'required|file|mimes:pdf|max:5000',
            'npwp'                  => 'required|file|mimes:pdf|max:5000',
            'bpjs_ketenagakerjaan'  => 'required|file|mimes:pdf|max:5000',
            'bpjs_kesehatan'        => 'required|file|mimes:pdf|max:5000',
            'rekomendasi_ppni'      => 'required|file|mimes:pdf|max:5000',
            'rekomendasi_puskesmas' => 'required|file|mimes:pdf|max:5000',
            'foto_tempat_praktik'   => 'required|file|mimes:pdf|max:5000',
        ]);
        try {
            // SIMPAN TABEL IZIN MEDLICENSE
            $izin = IzinMedlicense::create($izinData);
            
            $dokumenData = ['id_medlicense' => $izin->id];
            
            foreach ((new BerkasPerawat)->getFillable() as $field) {
                if ($field === 'id_medlicense') continue;
                
                if ($request->hasFile($field)) {
                    $dokumenData[$field] = $request->file($field)->store(
                        "medlicense/permohonan/perawat/{$izin->id}", 
                        'public'
                    );
                }
            }
            
            BerkasPerawat::create($dokumenData);
            
            return redirect()->route('userMedlicense')
                ->with('success', 'Permohonan izin perawat telah diajukan');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function handleBidan(Request $request, array $izinData) {
        $request->validate([
            'surat_permohonan'      => 'required|file|mimes:pdf|max:5000',
            'ktp'                   => 'required|file|mimes:pdf|max:5000',
            'str'                   => 'required|file|mimes:pdf|max:5000',
            'ijazah'                => 'required|file|mimes:pdf|max:5000',
            'surat_sehat'           => 'required|file|mimes:pdf|max:5000',
            'pas_foto'              => 'required|file|mimes:pdf|max:5000',
            'npwp'                  => 'required|file|mimes:pdf|max:5000',
            'bpjs_ketenagakerjaan'  => 'required|file|mimes:pdf|max:5000',
            'bpjs_kesehatan'        => 'required|file|mimes:pdf|max:5000',
            'rekomendasi_ibi'       => 'required|file|mimes:pdf|max:5000',
            'rekomendasi_puskesmas' => 'required|file|mimes:pdf|max:5000',
            'foto_tempat_praktik'   => 'required|file|mimes:pdf|max:5000',
        ]);

        try {
            // SIMPAN TABEL IZIN MEDLICENSE
            $izin = IzinMedlicense::create($izinData);
            
            $dokumenData = ['id_medlicense' => $izin->id];
            
            foreach ((new BerkasBidan)->getFillable() as $field) {
                if ($field === 'id_medlicense') continue;
                
                if ($request->hasFile($field)) {
                    $dokumenData[$field] = $request->file($field)->store(
                        "medlicense/permohonan/perawat/{$izin->id}", 
                        'public'
                    );
                }
            }
            
            BerkasBidan::create($dokumenData);
            
            return redirect()->route('userMedlicense')
                ->with('success', 'Permohonan izin bidan telah diajukan');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function handleApoteker(Request $request, array $izinData) {
        $request->validate([
            'surat_permohonan'      => 'required|file|mimes:pdf|max:5000',
            'ktp'                   => 'required|file|mimes:pdf|max:5000',
            'str'                   => 'required|file|mimes:pdf|max:5000',
            'ijazah'                => 'required|file|mimes:pdf|max:5000',
            'surat_sehat'           => 'required|file|mimes:pdf|max:5000',
            'pas_foto'              => 'required|file|mimes:pdf|max:5000',
            'npwp'                  => 'required|file|mimes:pdf|max:5000',
            'bpjs_ketenagakerjaan'  => 'required|file|mimes:pdf|max:5000',
            'bpjs_kesehatan'        => 'required|file|mimes:pdf|max:5000',
            'rekomendasi_iai'       => 'required|file|mimes:pdf|max:5000',
            'surat_tempat_kerja'    => 'required|file|mimes:pdf|max:5000',
        ]);

        try {
            // SIMPAN TABEL IZIN MEDLICENSE
            $izin = IzinMedlicense::create($izinData);
            
            $dokumenData = ['id_medlicense' => $izin->id];
            
            foreach ((new BerkasApoteker)->getFillable() as $field) {
                if ($field === 'id_medlicense') continue;
                
                if ($request->hasFile($field)) {
                    $dokumenData[$field] = $request->file($field)->store(
                        "medlicense/permohonan/perawat/{$izin->id}", 
                        'public'
                    );
                }
            }
            
            BerkasApoteker::create($dokumenData);
            
            return redirect()->route('userMedlicense')
                ->with('success', 'Permohonan izin apoteker telah diajukan');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function showMedlicense(Request $request)
    {
        try {
            $suratPerizinan = IzinMedlicense::with(['user'])
                ->where('id_user', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('medlicense.dashboard', compact('suratPerizinan'));
                
        } catch (Exception $e) {
            return redirect()->route('dashboard')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function perpanjangan(Request $request)
    {
        $validated = $request->validate([
            'jenis_profesi' => 'required|in:dokter,perawat,bidan,apoteker',
            'jenis_izin' => 'required|in:Perpanjangan',
            'izin_profesi_terbit' => 'required|file|mimes:pdf|max:5000',
        ]);

        DB::beginTransaction();

        try {
            // Create the main izin record first (without file path initially)
            $izinMedlicense = IzinMedlicense::create([
                'id_user' => $request->user()->id,
                'jenis_izin' => $validated['jenis_izin'],
                'jenis_profesi' => $validated['jenis_profesi'],
                'tanggal_pengajuan' => now(),
                'status' => 'Diproses',
                'surat_izin_usaha' => null, // Will update after file is stored
            ]);

            // Store the uploaded file with the new path format
            $filePath = null;
            if ($request->hasFile('izin_profesi_terbit')) {
                $filePath = $request->file('izin_profesi_terbit')->store(
                    "medlicense/perpanjangan/{$validated['jenis_profesi']}/{$izinMedlicense->id}", 
                    'public'
                );
                
            }

            // Create the perpanjangan record
            $perpanjanganData = [
                'id_medlicense' => $izinMedlicense->id,
                'izin_profesi_terbit' => $filePath,
            ];
            
            PerpanjanganMedlicense::create($perpanjanganData);

            DB::commit();

            // Redirect with success message
            return redirect()->route('userMedlicense')
                ->with('success', 'Pengajuan perpanjangan profesi berhasil dikirim!');

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

    public function kirimKeDinkes(Request $r)
{
    $izin = IzinMedlicense::findOrFail($r->id);
    $izin->status_proses = 'dinkes';
    $izin->save();

    return back()->with('success', 'Berkas berhasil dikirim ke Dinkes.');
}

}
