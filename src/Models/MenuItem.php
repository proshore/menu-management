<?php

namespace Proshore\MenuManagement\Models;

use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

class MenuItem extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name'  => 'display_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'menu_id',
        'menu_item_id',
        'name',
        'type',
        'value',
        'target_group',
        'status',
        'display_order',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('Proshore\MenuManagement\Models\Menu', 'menu_id')->select(['id', 'name']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentMenu()
    {
        return $this->belongsTo('Proshore\MenuManagement\Models\MenuItem', 'menu_item_id')->select(['id', 'name']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subMenus()
    {
        return $this->hasMany('Proshore\MenuManagement\Models\MenuItem', 'menu_item_id')
                    ->orderBy('display_order', 'ASC');
    }

    public function page()
    {
        return $this->belongsTo(config('proshore.menu-management.cms.model'), 'value')->select(['id', 'slug', config('proshore.menu-management.cms.value')]);
    }

    /**
     * List of menu type allowed.
     * @return array
     */
    public function menuTypeList()
    {
        return ['Internal Link', 'Pages', 'External Link'];
    }

    /**
     * List of menu status.
     * @return array
     */
    public function menuStatusList()
    {
        return ['Inactive', 'Active'];
    }

    /**
     * Get the target group name.
     *
     * @return string
     */
    public function getTargetGroupNameAttribute()
    {
        $targetGroups = config('proshore.menu-management.target-group');

        return $targetGroups[$this->target_group];
    }

    /**
     * Get the target group name.
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        $status = $this->menuStatusList();

        return $status[$this->status];
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = ($this->type == 1) ? $value[1] : $value[0];
    }

    /**
     * Get child menu items based on parent menu id
     * @param $menuItemId
     * @return integer
     */
    public static function getChildCount($menuItemId)
    {
        return static::where('menu_item_id', $menuItemId)->count();
    }

}
