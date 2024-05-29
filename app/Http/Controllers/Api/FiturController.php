<?php

namespace App\Http\Controllers\Api;

use App\Models\Layanan;
use App\Models\Formulir;
use App\Models\Berita;
use App\Models\Pengajuan;
use App\Models\BerkasPengajuan;
use App\Http\Controllers\Controller;
use App\Http\Resources\FiturResource;
use Illuminate\Http\Request;

class FiturController extends Controller
{
    public function layanan()
    {
        $layanan = Layanan::all();

        return new FiturResource(true, 'List Data Layanan', $layanan);
    }

    public function berita()
    {
        $berita = Berita::select('judul_berita', 'foto_berita', 'isi_berita')
            ->selectRaw('DATE_FORMAT(tgl_berita, "%d/%m/%Y %H:%i") as tgl_berita')
            ->orderBy('tgl_berita', 'desc')
            ->get();

        foreach ($berita as $item) {
            $item->foto_berita = base64_encode($item->foto_berita);
        }

        return new FiturResource(true, 'List Data Berita', $berita);
    }

    public function getFormulirByLayanan($id_layanan)
    {
        $formulir = Formulir::where('id_layanan', $id_layanan)->get();

        if ($formulir->isEmpty()) {
            return new FiturResource(false, 'Formulir tidak ditemukan untuk id_layanan ini', []);
        }

        foreach ($formulir as $item) {
            $item->data_formulir = json_decode($item->data_formulir);
        }

        return new FiturResource(true, 'Formulir ditemukan', $formulir);
    }

    public function kirimPengajuan(Request $request)
    {
        try {

            $formulir = Formulir::where('id_layanan', $request->id_layanan)->first();
            if (!$formulir) {
                return response()->json(['error' => 'Formulir tidak ditemukan untuk id_layanan ini'], 404);
            }

            $dataFormulir = json_decode($formulir->data_formulir, true);

            $pengajuan = Pengajuan::create([
                'id_penduduk' => $request->id_penduduk,
                'id_layanan' => $request->id_layanan,
                'tgl_pengajuan' => now(),
                'status' => 'Diproses',
                'catatan' => 'Pengajuan menunggu verifikasi',
                'id_rt' => null,
                'id_rw' => null,
                'id_admin' => null,
            ]);

            foreach ($request->fields as $field) {
                $fieldName = $field['nama_field'];
                $fieldValue = $field['value'];
                BerkasPengajuan::create([
                    'id_pengajuan' => $pengajuan->id,
                    'nama_field' => $fieldName,
                    'value' => $fieldValue,
                ]);
            }

            return response()->json(['message' => 'Data formulir berhasil dikirim'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function fetchRiwayatPengajuan($id_penduduk)
    {
        try {
            $riwayatPengajuan = Pengajuan::join('layanan', 'pengajuan.id_layanan', '=', 'layanan.id')
                ->select('pengajuan.*', 'layanan.nama_layanan')
                ->where('pengajuan.id_penduduk', $id_penduduk)
                ->orderBy('pengajuan.tgl_pengajuan', 'desc')
                ->get();

            return new FiturResource(true, 'Riwayat Pengajuan Ditemukan', $riwayatPengajuan);
        } catch (\Exception $e) {
            return new FiturResource(false, 'Terjadi kesalahan dalam mengambil riwayat pengajuan', []);
        }
    }
}
