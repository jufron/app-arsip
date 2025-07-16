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

    public function messages(): array
    {
        return [
            'nik.required'                  => 'NIK wajib diisi.',
            'nik.string'                    => 'NIK harus berupa string.',
            'nik.max'                       => 'NIK tidak boleh lebih dari 16 karakter.',
            'nama.required'                 => 'Nama Pemohon wajib diisi.',
            'nama.string'                   => 'Nama Pemohon harus berupa string.',
            'nama.max'                      => 'Nama Pemohon tidak boleh lebih dari 255 karakter.',
            'jenis_pengurusan.required'     => 'Jenis pengurusan wajib dipilih.',
            'jenis_pengurusan.in'           => 'Jenis pengurusan tidak valid.',
            'tanggal_pengurusan.required'   => 'Tanggal pengurusan wajib diisi.',
            'tanggal_pengurusan.date'       => 'Tanggal pengurusan harus berupa tanggal yang valid.',
        ];
    }
}
