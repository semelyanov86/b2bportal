<?php

namespace Modules\Contract\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.system'), function (Group $group) {
            $group->item(trans('user::sidebar.users'), function (Item $item) {
                $item->item(trans('contract::sidebar.contracts'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.contracts.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.contracts.index')
                    );
                });
            });
        });
    }
}
