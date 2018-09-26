<?php

namespace Modules\Warehouse\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Warehouse\Entities\Warehouse;

class Settings extends Model
{
    use Translatable;

    protected $table = 'warehouse__settings';
    public $translatedAttributes = [];
    protected $fillable = [
                            'disiabled_fileds',
                            'issuecard_disabled_fields',
                            'barcode_ip',
                            'issue_card_sap_export',
                            'top_barcode_fields',
                            'bottom_barcode_fields',
                            'item_required_field',
                            'item_footer_search',
                            'item_guest_disabled_fields',
                            'issuecard_guest_disabled_fields',
                            ];
                            
    protected $casts = [
                        'disiabled_fileds' => 'array', 
                        'issuecard_disabled_fields' => 'array',
                        'issue_card_sap_export' => 'array',
                        'top_barcode_fields' => 'array',
                        'bottom_barcode_fields' => 'array',
                        'item_required_field' => 'array',
                        'item_guest_disabled_fields' => 'array',
                        'issuecard_guest_disabled_fields' => 'array',
                        'item_footer_search' => 'boolean',
                        ];

    /**
     * Settings belongs to one warehouse;
     * @return Warehouse relationship
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
