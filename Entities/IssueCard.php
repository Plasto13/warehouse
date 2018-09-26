<?php

namespace Modules\Warehouse\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Warehouse\Entities\CostCenter;
use Modules\Warehouse\Entities\Item;
use Modules\Warehouse\Entities\MachinePart;

class IssueCard extends Model
{
    // use Translatable;

    protected $table = 'warehouse__issuecards';
    public $translatedAttributes = [];
    protected $fillable = [
                            'item_id',
                            'material_number',
                            'costcenter_id',
                            'machinepart_id',
                            'name',
                            'local_name',
                            'user_full_name',
                            'quantity',
                            'issuing_volume',
                            'reason',
                            'minimum',
                            'maximum',
                            'remark',
                            'specification',
                            'order_number',
                            'price',
                            'storage_position',
                            'manufacture',
                            'documentation_number',
                            'url',
                            'supplier',
                            'suppliers',
                            ];

    protected $cast = [
    			'exported'=>'boolean',
    			];

    /**
     * IsueCard belongs to Item class
     * @return Item class relationship
     */
    public function item()
    {
    	return $this->belongsTo(Item::class);
    }


    /**
     * IssueCard has one CostCenter
     * @return CostCenter relationsip
     */
    public function costCenter()
    {
        return $this->hasOne(CostCenter::class)->withTrashed();
    }

    /**
     * IssueCard has one Machine Part
     * @return MachinePart relationsip
     */
    public function machinePart()
    {
    	return $this->hasOne(MachinePart::class)->withTrashed();
    }

}
