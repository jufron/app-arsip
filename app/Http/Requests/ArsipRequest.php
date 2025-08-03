<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArsipRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'dokumen_pemohon_id' => ['required', 'exists:dokumen_pemohon,id'],
            'ruangan'            => ['required', 'string', 'max:200'],
            'lemari'             => ['required', 'string', 'max:200'],
            'rak'                => ['required', 'string', 'max:255'],
            'laci'               => ['required', 'string', 'max:200'],
            'box'                => ['required', 'string', 'max:255'],
            'keterangan'         => ['nullable', 'string', 'max:200'],
            'tanggal_arsip'      => ['required', 'date'],
        ];
    }

    public function messages() : array
    {
        return [
            'dokumen_pemohon_id.required' => 'Dokumen pemohon harus diisi.',
            'ruangan.required'            => 'Ruangan harus diisi.',
            'lemari.required'             => 'Lemari harus diisi.',
            'rak.required'                => 'Rak harus diisi.',
            'laci.required'               => 'Laci harus diisi.',
            'box.required'                => 'Box harus diisi.',
            'tanggal_arsip.required'      => 'Tanggal arsip harus diisi.',
        ];
    }
}
