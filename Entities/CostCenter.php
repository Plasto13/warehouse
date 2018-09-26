<?php

namespace Modules\Warehouse\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostCenter extends Model
{
    use Translatable;
    use SoftDeletes;

    protected $table = 'warehouse__costcenters';
    public $translatedAttributes = ['title'];
    protected $fillable = ['title','code','extra'];
    protected $dates = ['deleted_at'];
    /**
     * Warehouse relationship
     * @return collection
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
