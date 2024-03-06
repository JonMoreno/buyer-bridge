<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeCapsulePostRequest extends FormRequest
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
        // simple validation rules
        // additional validation rules should be added to dates and times
        return [
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
            'openAtDate' => ['required'],
            'openAtTime' => ['required'],
        ];
    }
}