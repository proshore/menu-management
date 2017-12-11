<?php

namespace Proshore\MenuManagement\Rules;

use Illuminate\Contracts\Validation\Rule;

class MenuLinkValue implements Rule
{
    /**
     * The type of Menu.
     *
     * @var
     */
    public $type;

    /**
     * The value of menu type.
     *
     * @var
     */
    public $typeValue;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type, $typeValue)
    {
        $this->type = $type;
        $this->typeValue = $typeValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->type != $this->typeValue) {
            return $value[0] != null || ! empty($value[0]);
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be required.';
    }
}
