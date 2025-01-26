<?php

namespace App\Http\Requests\API\V0;

use Illuminate\Foundation\Http\FormRequest;

class AIGCRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'data_type' => 'required',
            'operation_type' => 'required',
            'content' => 'required'
        ];
    }
}
