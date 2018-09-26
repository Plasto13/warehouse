<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'warehouse__item_translations';
}
