<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('pages.siswa.index', [
            'siswa' => Siswa::render($request->search),
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.siswa.create', [
            'kelas' => Kelas::all(),
            'bayar' => Spp::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        try {
            Siswa::create($request->validated());
            return redirect()->route('siswa.index')->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return redirect()->route('siswa.index')->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa): View
    {
        return view('pages.siswa.show', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa): View
    {
        return view('pages.siswa.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
            'bayar' => Spp::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        try {
            $siswa->update($request->validated());
            return back()->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return back()->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa): RedirectResponse
    {
        try {
            $siswa->delete();
            return back()->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return back()->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }
}
