<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriFotoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'judul'   => ['required','string','max:150'],
            'tanggal' => ['required','date'],
            'gambar'  => ['required','image','mimes:jpg,jpeg,png,webp','max:3072'], // 3MB
        ];
    }

    public function messages(): array
    {
        return [
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format diizinkan: JPG, JPEG, PNG, WEBP.',
            'gambar.max'   => 'Ukuran maksimal 3MB.',
        ];
    }
}
