<?php

namespace Modules\Warehouse\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Warehouse\Entities\CostCenter;
use Modules\Warehouse\Entities\MachinePart;
use Modules\Warehouse\Entities\IssueCard;
use Modules\Warehouse\Entities\Item;
use Modules\Warehouse\Entities\Settings;
use Modules\Warehouse\Entities\Zebra;
class Warehouse extends Model
{
    use Translatable;

    protected $table = 'warehouse__warehouses';
    public $translatedAttributes = ['name','slug'];
    protected $fillable = ['department_id','sap_id','name','description','department_only','slug'];
    protected $cast = ['department_only'=> 'boolean'];

    /**
     * Warehouse has many items
     * @return Item relationship
     */
    public function item()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Warehouse has Many Issue Card
     * @return IssueCard relationship
     */
    public function issueCard()
    {
        return $this->hasMany(issueCard::class);
    }

    /**
     * Warehuse has one Settings
     * @return Settings relationship
     */
    public function settings()
    {
        return $this->hasOne(Settings::class);
    }

    public function costCenter()
    {
        return $this->hasMany(CostCenter::class);
    }

    public function machinePart()
    {
        return $this->hasMany(MachinePart::class);
    }

    public function zebra()
    {
        return $this->hasMany(Zebra::class);
    }


}
