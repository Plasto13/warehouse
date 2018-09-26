<?php

namespace Modules\Warehouse\Serialiser;

use Illuminate\Database\Eloquent\Model;
use Modules\Warehouse\Entities\Warehouse;
use Cyberduck\LaravelExcel\Contract\SerialiserInterface;

class IssueCardSerialiser implements SerialiserInterface
{
    private $warehouse;

    public function __construct()
    {
        $this->warehouse = Warehouse::find(\Route::current()->parameter('warehouse'))->first();
    }

    public function getData($data)
    {

        $row = [];
        foreach ($data as $key => $value) {
            if ($key == 'costcenter_id' && $value !== null) {
                $cc = $this->warehouse->costcenter()->find($value);
                $row[] = $cc->code;
            }
            elseif ($key == 'machineparts_id' && $value !== null) {
                $cc = $this->warehouse->costcenter()->find($value);
                $row[] = $cc->code;
            }
            else {
                $row[] = $value;
            }
        }

        // $row[] = $data->field1;
        // $row[] = $data->relationship->field2;

        return $row;
    }

    public function getHeaderRow()
    {
        $header = $this->warehouse->settings;
       return $header->issue_card_sap_export;
    }
}

