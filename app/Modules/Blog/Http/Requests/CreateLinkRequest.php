<?php

namespace App\Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateLinkRequest extends FormRequest
{
    /** @return array<string, array<int, string>> */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'url' => ['required', 'url', 'unique:links'],
            'text' => '',
        ];
    }
}
