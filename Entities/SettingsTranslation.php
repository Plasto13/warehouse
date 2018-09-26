<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class SettingsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'warehouse__settings_translations';
}
