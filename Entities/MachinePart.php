<?php

namespace Modules\Warehouse\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachinePart extends Model
{
    use SoftDeletes;
    use Translatable;

    protected $table = 'warehouse__machineparts';
    public $translatedAttributes = ['title'];
    protected $fillable = ['title','code'];
    protected $dates = ['deleted_at'];
}
