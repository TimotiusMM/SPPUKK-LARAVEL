<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('pages.petugas.index', [
            'petugas' => User::render($request->search),
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['username']);
            $data['role'] = Role::PETUGAS;
            User::create($data);
            return redirect()->route('petugas.index')->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return redirect()->route('petugas.index')->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $petugas): View
    {
        return view('pages.petugas.edit', [
            'petugas' => $petugas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $petugas): RedirectResponse
    {
        try {
            $petugas->update($request->validated());
            return back()->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return back()->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $petugas): RedirectResponse
    {
        try {
            $petugas->delete();
            return back()->with('status', 'success')->with('message', 'Berhasil.');
        } catch (\Throwable $exception) {
            return back()->with('status', 'failed')->with('message', $exception->getMessage());
        }
    }
}
