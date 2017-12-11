<?php

namespace Proshore\MenuManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = [
        'slug',
        'name'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuItems()
    {
        return $this->hasMany('Proshore\MenuManagement\Models\MenuItem');
    }
}
