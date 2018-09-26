<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

class IssueCardTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['local_name'];
    protected $table = 'warehouse__issuecard_translations';
}
