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
    private array $number = [
        1,2,3,4,5,6,7,8,9,10,
    ];

    public function rules() : array
    {
        $numberPattern = implode('|', $this->number); // = 1|2|3|4|5|6|7|8|9|10

        $rules = [
            'files.*'            => ['file', 'mimes:pdf,jpg,png', 'max:10048'],
            'ruangan'            => ['required', 'string', 'max:200', "regex:/^ruangan\s($numberPattern)$/i"],
            'lemari'             => ['required', 'string', 'max:200', "regex:/^lemari\s($numberPattern)$/i"],
            'rak'                => ['required', 'string', 'max:255', "regex:/^rak\s($numberPattern)$/i"],
            'laci'               => ['required', 'string', 'max:200', "regex:/^laci\s($numberPattern)$/i"],
            'box'                => ['required', 'string', 'max:255', "regex:/^box\s($numberPattern)$/i"],
            'keterangan'         => ['nullable', 'string', 'max:200'],
            'tanggal_arsip'      => ['required', 'date'],
        ];

        if($this->isMethod('post')) {
            $rules['files']                 = ['required', 'array', 'min:1'];
            $rules['dokumen_pemohon_id']    = ['required', 'exists:dokumen_pemohon,id'];
        } else {
            $rules['files'] = ['nullable', 'array'];
        }

        return $rules;
    }

    public function messages() : array
    {
        return [
            'dokumen_pemohon_id.required' => 'Dokumen pemohon harus diisi.',
            'ruangan.required'            => 'Ruangan harus diisi.',
            'ruangan.regex'               => 'Format ruangan harus seperti: ruangan 1 s/d ruangan ' . max($this->number),
            'lemari.required'             => 'Lemari harus diisi.',
            'lemari.regex'                => 'Format lemari harus seperti: lemari 1 s/d lemari ' . max($this->number),
            'rak.required'                => 'Rak harus diisi.',
            'rak.regex'                   => 'Format rak harus seperti: rak 1 s/d rak ' . max($this->number),
            'laci.required'               => 'Laci harus diisi.',
            'laci.regex'                  => 'Format laci harus seperti: laci 1 s/d laci ' . max($this->number),
            'box.required'                => 'Box harus diisi.',
            'box.regex'                   => 'Format box harus seperti: box 1 s/d box ' . max($this->number),
            'tanggal_arsip.required'      => 'Tanggal arsip harus diisi.',
            'files.required'              => 'File lampiran wajib diunggah saat membuat data baru.',
            'files.array'                 => 'Format file tidak sesuai, pastikan mengunggah beberapa file sekaligus.',
            'files.*.file'                => 'Setiap file yang diunggah harus berupa file yang valid.',
            'files.*.mimes'               => 'File harus berformat PDF, JPG, atau PNG.',
            'files.*.max'                 => 'Ukuran setiap file maksimal 10 MB.'
        ];
    }
}
