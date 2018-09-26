<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class MachinePartTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'warehouse__machinepart_translations';
}
