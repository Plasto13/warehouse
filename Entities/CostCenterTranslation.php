<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class CostCenterTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'warehouse__costcenter_translations';
}
