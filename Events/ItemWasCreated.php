<?php

namespace Modules\Warehouse\Events;

use Modules\Media\Contracts\StoringMedia;
use Modules\Warehouse\Entities\Item;

class ItemWasCreated implements StoringMedia
{
    private $item;
    private $data;

    public function __construct(Item $item,array $data)
    {
        $this->item = $item;
        $this->data = $data;
    }

/**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->item;
    }
    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
