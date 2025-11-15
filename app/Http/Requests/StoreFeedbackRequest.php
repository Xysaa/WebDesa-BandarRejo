<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'    => ['required','string','max:100'],
            'email'   => ['required','email','max:150'],
            'pesan'   => ['required','string'],
            'tanggal' => ['required','date'],
        ];
    }
}
