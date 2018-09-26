<?php

namespace Modules\Warehouse\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateWarehouseRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [
            "name"  => 'required',
        ];
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
