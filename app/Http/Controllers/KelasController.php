<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Models\Kelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('pages.kelas.index', [
            'kelas' => Kelas::render($request->search),
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request): RedirectResponse
    {
        try {
            Kelas::create($request->validated());
            return redirect()->route('kelas.index')->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return redirect()->route('kelas.index')->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas): View
    {
        return view('pages.kelas.edit', [
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas): RedirectResponse
    {
        try {
            $kelas->update($request->validated());
            return back()->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return back()->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas): RedirectResponse
    {
        try {
            $kelas->delete();
            return back()->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return back()->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }
}
