<?php

namespace App\Http\ApiV1\Modules\Games\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
            'id' => 'nullable',
            'username' => 'required',
            'password' => 'required',
            'game_name' => 'required|max:127',
            'player_color' => 'nullable',
            'primary_time' => 'required',
            'added_time' => 'required',
        ];
    }
}
