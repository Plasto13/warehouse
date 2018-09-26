<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemStatusTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'warehouse__itemstatus_translations';
}
