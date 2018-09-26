<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class ZebraTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'warehouse__zebra_translations';
}
