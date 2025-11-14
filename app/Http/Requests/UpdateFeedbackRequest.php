<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'    => ['sometimes','required','string','max:100'],
            'email'   => ['sometimes','required','email','max:150'],
            'pesan'   => ['sometimes','required','string'],
            'tanggal' => ['sometimes','required','date'],
        ];
    }
}
