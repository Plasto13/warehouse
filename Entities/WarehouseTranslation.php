<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class WarehouseTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description','slug'];
    protected $table = 'warehouse__warehouse_translations';
}
