<?php

namespace Modules\Warehouse\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterWarehouseSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->weight(90);
            $group->item(trans('warehouse::warehouses.title.warehouses'), function (Item $item) {
                $item->icon('fa fa-database');
                $item->weight(0);
                // $item->append('admin.warehouse.warehouse.create');
                $item->route('admin.warehouse.warehouse.index');
                $item->authorize(
                        $this->auth->hasAccess('warehouse.warehouses.index')
                    );
            });
            
        });

        return $menu;
    }
}
