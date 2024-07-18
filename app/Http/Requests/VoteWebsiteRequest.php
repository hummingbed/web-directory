<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteWebsiteRequest extends FormRequest
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
            'url' => 'required|url|exists:websites,url',
            'action' => 'required|string|in:vote,unvote',
        ];
    }
}
