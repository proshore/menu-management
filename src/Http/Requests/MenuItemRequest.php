<?php

namespace Proshore\MenuManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Proshore\MenuManagement\Rules\MenuLinkValue;
use Proshore\MenuManagement\Models\MenuItem;

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
            'menu_item_id' => 'nullable'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            $menuId = $data['menu_id'];
            $menuItemId = $data['menu_item_id'] ?? null;

            if (!$menuItemId) {
                return;
            }

            $valid = false;
            $parent = MenuItem::find($menuItemId);

            // if no parent found or if parent has a different menu_id, then invalid
            if (!$parent || $parent->menu_id != $menuId) {
                $validator->errors()->add('menu_item_id', 'Invalid parent menu');
            }
        });
    }
}
