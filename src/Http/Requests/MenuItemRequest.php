<?php

namespace Proshore\MenuManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Proshore\MenuManagement\Rules\MenuLinkValue;

class MenuItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required',
            'target_group' => 'required',
            'menu_id'      => 'required',
            'value'        => new MenuLinkValue($this->request->get('type'), 1),
        ];
    }
}
