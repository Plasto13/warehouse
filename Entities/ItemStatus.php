<?php

namespace Modules\Warehouse\Entities;

// use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    // use Translatable;

    protected $table = 'warehouse__itemstatuses';
    public $translatedAttributes = [];
    protected $fillable = ['icon','title','color','description'];

    public function item()
    {
    	return $this->belongsToMany(Item::class, 'warehouses__item_itemstatuses');
    }
}
