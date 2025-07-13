<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemohonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik'                   => ['required', 'string', 'max:16'],
            'nama'                  => ['required', 'string', 'max:255'],
            'jenis_pengurusan'      => ['required', 'string', 'in:KTP baru,Rusak,Hilang,Lainya'],
            'tanggal_pengurusan'    => ['required', 'date'],
        ];
    }
}
