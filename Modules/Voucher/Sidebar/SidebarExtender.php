<?php

namespace Modules\Voucher\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\User\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
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

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('voucher::vouchers.title.vouchers'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
               
                $item->item(trans('voucher::pvmprhs.title.pvmprhs'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                   // $item->append('admin.voucher.pvmprh.create');
                    $item->route('admin.voucher.pvmprh.index');
                    $item->authorize(
                        $this->auth->hasAccess('voucher.pvmprhs.index')
                    );
                });
                $item->item(trans('voucher::stmpdhs.title.stmpdhs'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                  //  $item->append('admin.voucher.stmpdh.create');
                    $item->route('admin.voucher.stmpdh.index');
                    $item->authorize(
                        $this->auth->hasAccess('voucher.stmpdhs.index')
                    );
                });
                $item->item(trans('voucher::cgmsbcs.title.cgmsbcs'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                   // $item->append('admin.voucher.cgmsbc.create');
                    $item->route('admin.voucher.cgmsbc.index');
                    $item->authorize(
                        $this->auth->hasAccess('voucher.cgmsbcs.index')
                    );
                });
                $item->item(trans('voucher::grcfors.title.grcfors'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                 //   $item->append('admin.voucher.grcfor.create');
                    $item->route('admin.voucher.grcfor.index');
                    $item->authorize(
                        $this->auth->hasAccess('voucher.grcfors.index')
                    );
                });
                $item->item(trans('voucher::registrations.title.registrations'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                   // $item->append('admin.voucher.registration.create');
                    $item->route('admin.voucher.registration.index');
                    $item->authorize(
                        $this->auth->hasAccess('voucher.registrations.index')
                    );
                });
                $item->item(trans('voucher::userregistrations.title.userregistrations'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                   // $item->append('admin.voucher.userregistration.create');
                    $item->route('admin.voucher.userregistration.index');
                    $item->authorize(
                        $this->auth->hasAccess('voucher.userregistrations.index')
                    );
                });
// append







            });
        });

        return $menu;
    }
}
