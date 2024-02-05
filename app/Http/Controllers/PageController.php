<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        return view('dashboard', [
            'siswa' => Siswa::render($request->search),
            'search' => $request->search,
        ]);
    }

    public function login(Request $request): View|RedirectResponse
    {
        $siswa = $request->session()->get('siswa');
        if ($siswa) {
            return redirect()->route('guest.history', $siswa->nisn);
        }
        return view('pages.guest.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('siswa');
        return redirect()->route('login');
    }

    public function authentication(Request $request): RedirectResponse
    {
        try {
            $siswa = Siswa::where('nisn', $request->get('nisn'))
                ->where('nis', $request->get('nis'))
                ->first();
            if (!$siswa) {
                throw new \Exception('Data tidak cocok!');
            }

            $request->session()->put('siswa', $siswa);
            return redirect()->route('guest.history', $siswa->nisn);
        } catch (\Throwable $exception) {
            return back()->with('status', $exception->getMessage())->with('message', $exception->getMessage());
        }
    }

    public function history(Request $request): RedirectResponse|View
    {
        $siswa = $request->session()->get('siswa');
        if (!$siswa) {
            return redirect()->route('guest.login');
        }
        return view('pages.guest.history', [
            'pembayaran' => Pembayaran::render($request->search, $siswa->nisn),
            'siswa' => $siswa,
        ]);
    }
}
