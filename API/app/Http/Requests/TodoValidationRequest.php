<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoValidationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => 'required|string|max:255',
                    'description' => 'required|string',
                    'completed' => 'required|boolean',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'completed' => 'required|boolean',
                ];
            default:
                return [];
        }
    }
}
