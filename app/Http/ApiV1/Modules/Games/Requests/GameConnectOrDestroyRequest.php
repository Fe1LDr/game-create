<?php

namespace App\Http\ApiV1\Modules\Games\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GameConnectOrDestroyRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'username' => 'required',
            'password' => 'required',
            'game_name' => 'nullable|max:127',
            'primary_time' => 'nullable',
            'added_time' => 'nullable',
        ];
    }
}
