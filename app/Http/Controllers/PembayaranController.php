<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Siswa $siswa): View
    {
        return view('pages.pembayaran.index', [
            'pembayaran' => Pembayaran::render($request->search,$siswa->nisn),
            'siswa' =>$siswa,
            'search' => $request->search,
        ]);
    }

    public function print(Request $request, Siswa $siswa): Response
    {
        $pdf = Pdf::loadView('pages.pembayaran.print', [
            'title' => 'Laporan Pembayaran SPP',
            'siswa' =>$siswa,
            'pembayaran' => Pembayaran::where('nisn',$siswa->nisn)->get(),
        ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('laporan_spp_' .$siswa->nisn . '.pdf');
    }

    public function create(Siswa $siswa): View
    {
       $siswa->load(['kelas', 'bayar']);
        return \view('pages.pembayaran.create', [
            'siswa' =>$siswa,
            'bulan' => [
                'Januari', 'Februari', 'Maret', 'April',
                'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        try {
            $exists = Pembayaran::where('nisn', $data['nisn'])
                ->where('tahunBayar', $data['tahunBayar'])
                ->where('bulanBayar', $data['bulanBayar'])->count();
            if ($exists) {
                throw new \Exception('Sudah lunas.');
            }
            $data['idUser'] = auth()->user()->id;
            $data['tanggalBayar'] = now();
            Pembayaran::create($data);
            return redirect()->route('pembayaran.index', $data['nisn'])->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return redirect()->route('pembayaran.index', $data['nisn'])->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }
}
