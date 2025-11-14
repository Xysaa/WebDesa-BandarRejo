<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGaleriFotoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'judul'   => ['sometimes','required','string','max:150'],
            'tanggal' => ['sometimes','required','date'],
            // gambar opsional saat update
            'gambar'  => ['sometimes','nullable','image','mimes:jpg,jpeg,png,webp','max:3072'],
        ];
    }
}
