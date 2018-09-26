<?php

namespace Modules\Warehouse\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateItemRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'max:255',
            'local_name' => 'max:255',
            'specification' => 'max:255',
            'order_number' => 'max:255',
            'storage_position' => 'max:255',
            'manufacture' => 'max:255',
            'supplier' => 'max:255',
            'documentation_number' => 'max:255',
            'url' => 'max:255', 
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
