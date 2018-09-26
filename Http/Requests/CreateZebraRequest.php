<?php

namespace Modules\Warehouse\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateZebraRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'ip' => 'required|ip',
            'code_row' => 'required'
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
