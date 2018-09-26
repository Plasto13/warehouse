<?php

namespace Modules\Warehouse\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Entities\IssueCard;

class Item extends Model
{
    // use Translatable;
    use MediaRelation;

    protected $table = 'warehouse__items';
    public $translatedAttributes = [];
    protected $fillable = ['warehouse_id','material_number','name',
                            'local_name','quantity','minimum','maximum','specification',
                            'order_number','price','storage_position','manufacture','supplier',
                            'suppliers','documentation_number','remarks','photo','slug','url','published','unit',
                            ];
    protected $casts  = [
                        'published'=>'boolean'
                        ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function getPhotoAttribute()
    {
        return $this->filesByZone('photo')->get();
    }

    public function issueCard()
    {
        return $this->hasMany(IssueCard::class);
    }

    public function status()
    {
        return $this->belongsToMany(ItemStatus::class, 'warehouses__item_itemstatuses');
    }

    
}
