<?php

namespace Modules\Warehouse\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateMachinePartRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'code' => 'required'
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
