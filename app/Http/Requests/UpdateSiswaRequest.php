<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == Role::ADMIN->value;
    }

    public function attributes(): array
    {
        return [
            'nama' => 'nama',
            'alamat' => 'alamat',
            'telp' => 'nomor telepon',
            'idKelas' => 'kelas',
            'idSpp' => 'spp',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required'],
            'alamat' => ['required'],
            'telp' => ['required'],
            'idKelas' => 'required',
            'idSpp' => 'required',
        ];
    }
}
