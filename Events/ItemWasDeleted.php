<?php

namespace Modules\Warehouse\Events;

use Modules\Media\Contracts\DeletingMedia;
use Modules\Warehouse\Entities\Item;

class ItemWasDeleted implements DeletingMedia
{
     /**
     * @var Item
     */
    private $Item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }
    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->item->id;
    }
    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return get_class($this->item);
    }
}
