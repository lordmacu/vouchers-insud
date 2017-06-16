<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/voucher'], function (Router $router) {
    $router->bind('voucher', function ($id) {
        return app('Modules\Voucher\Repositories\VoucherRepository')->find($id);
    });
    $router->get('vouchers', [
        'as' => 'admin.voucher.voucher.index',
        'uses' => 'VoucherController@index',
        'middleware' => 'can:voucher.vouchers.index'
    ]);
    $router->get('vouchers/create', [
        'as' => 'admin.voucher.voucher.create',
        'uses' => 'VoucherController@create',
        'middleware' => 'can:voucher.vouchers.create'
    ]);
    $router->post('vouchers', [
        'as' => 'admin.voucher.voucher.store',
        'uses' => 'VoucherController@store',
        'middleware' => 'can:voucher.vouchers.create'
    ]);
    $router->get('vouchers/{voucher}/edit', [
        'as' => 'admin.voucher.voucher.edit',
        'uses' => 'VoucherController@edit',
        'middleware' => 'can:voucher.vouchers.edit'
    ]);
    $router->put('vouchers/{voucher}', [
        'as' => 'admin.voucher.voucher.update',
        'uses' => 'VoucherController@update',
        'middleware' => 'can:voucher.vouchers.edit'
    ]);
    $router->delete('vouchers/{voucher}', [
        'as' => 'admin.voucher.voucher.destroy',
        'uses' => 'VoucherController@destroy',
        'middleware' => 'can:voucher.vouchers.destroy'
    ]);
    $router->bind('pvmprh', function ($id) {
        return app('Modules\Voucher\Repositories\PvmprhRepository')->find($id);
    });
    $router->get('pvmprhs', [
        'as' => 'admin.voucher.pvmprh.index',
        'uses' => 'PvmprhController@index',
        'middleware' => 'can:voucher.pvmprhs.index'
    ]);
    $router->get('pvmprhs/create', [
        'as' => 'admin.voucher.pvmprh.create',
        'uses' => 'PvmprhController@create',
        'middleware' => 'can:voucher.pvmprhs.create'
    ]);
    $router->post('pvmprhs', [
        'as' => 'admin.voucher.pvmprh.store',
        'uses' => 'PvmprhController@store',
        'middleware' => 'can:voucher.pvmprhs.create'
    ]);
    $router->get('pvmprhs/{pvmprh}/edit', [
        'as' => 'admin.voucher.pvmprh.edit',
        'uses' => 'PvmprhController@edit',
        'middleware' => 'can:voucher.pvmprhs.edit'
    ]);
    $router->put('pvmprhs/{pvmprh}', [
        'as' => 'admin.voucher.pvmprh.update',
        'uses' => 'PvmprhController@update',
        'middleware' => 'can:voucher.pvmprhs.edit'
    ]);
    $router->delete('pvmprhs/{pvmprh}', [
        'as' => 'admin.voucher.pvmprh.destroy',
        'uses' => 'PvmprhController@destroy',
        'middleware' => 'can:voucher.pvmprhs.destroy'
    ]);
    $router->bind('stmpdh', function ($id) {
        return app('Modules\Voucher\Repositories\StmpdhRepository')->find($id);
    });
    $router->get('stmpdhs', [
        'as' => 'admin.voucher.stmpdh.index',
        'uses' => 'StmpdhController@index',
        'middleware' => 'can:voucher.stmpdhs.index'
    ]);
    $router->get('stmpdhs/create', [
        'as' => 'admin.voucher.stmpdh.create',
        'uses' => 'StmpdhController@create',
        'middleware' => 'can:voucher.stmpdhs.create'
    ]);
    $router->post('stmpdhs', [
        'as' => 'admin.voucher.stmpdh.store',
        'uses' => 'StmpdhController@store',
        'middleware' => 'can:voucher.stmpdhs.create'
    ]);
    $router->get('stmpdhs/{stmpdh}/edit', [
        'as' => 'admin.voucher.stmpdh.edit',
        'uses' => 'StmpdhController@edit',
        'middleware' => 'can:voucher.stmpdhs.edit'
    ]);
    $router->put('stmpdhs/{stmpdh}', [
        'as' => 'admin.voucher.stmpdh.update',
        'uses' => 'StmpdhController@update',
        'middleware' => 'can:voucher.stmpdhs.edit'
    ]);
    $router->delete('stmpdhs/{stmpdh}', [
        'as' => 'admin.voucher.stmpdh.destroy',
        'uses' => 'StmpdhController@destroy',
        'middleware' => 'can:voucher.stmpdhs.destroy'
    ]);
    $router->bind('cgmsbc', function ($id) {
        return app('Modules\Voucher\Repositories\CgmsbcRepository')->find($id);
    });
    $router->get('cgmsbcs', [
        'as' => 'admin.voucher.cgmsbc.index',
        'uses' => 'CgmsbcController@index',
        'middleware' => 'can:voucher.cgmsbcs.index'
    ]);
    $router->get('cgmsbcs/create', [
        'as' => 'admin.voucher.cgmsbc.create',
        'uses' => 'CgmsbcController@create',
        'middleware' => 'can:voucher.cgmsbcs.create'
    ]);
    $router->post('cgmsbcs', [
        'as' => 'admin.voucher.cgmsbc.store',
        'uses' => 'CgmsbcController@store',
        'middleware' => 'can:voucher.cgmsbcs.create'
    ]);
    $router->get('cgmsbcs/{cgmsbc}/edit', [
        'as' => 'admin.voucher.cgmsbc.edit',
        'uses' => 'CgmsbcController@edit',
        'middleware' => 'can:voucher.cgmsbcs.edit'
    ]);
    $router->put('cgmsbcs/{cgmsbc}', [
        'as' => 'admin.voucher.cgmsbc.update',
        'uses' => 'CgmsbcController@update',
        'middleware' => 'can:voucher.cgmsbcs.edit'
    ]);
    $router->delete('cgmsbcs/{cgmsbc}', [
        'as' => 'admin.voucher.cgmsbc.destroy',
        'uses' => 'CgmsbcController@destroy',
        'middleware' => 'can:voucher.cgmsbcs.destroy'
    ]);
    $router->bind('grcfor', function ($id) {
        return app('Modules\Voucher\Repositories\GrcforRepository')->find($id);
    });
    $router->get('grcfors', [
        'as' => 'admin.voucher.grcfor.index',
        'uses' => 'GrcforController@index',
        'middleware' => 'can:voucher.grcfors.index'
    ]);
    $router->get('grcfors/create', [
        'as' => 'admin.voucher.grcfor.create',
        'uses' => 'GrcforController@create',
        'middleware' => 'can:voucher.grcfors.create'
    ]);
    $router->post('grcfors', [
        'as' => 'admin.voucher.grcfor.store',
        'uses' => 'GrcforController@store',
        'middleware' => 'can:voucher.grcfors.create'
    ]);
    $router->get('grcfors/{grcfor}/edit', [
        'as' => 'admin.voucher.grcfor.edit',
        'uses' => 'GrcforController@edit',
        'middleware' => 'can:voucher.grcfors.edit'
    ]);
    $router->put('grcfors/{grcfor}', [
        'as' => 'admin.voucher.grcfor.update',
        'uses' => 'GrcforController@update',
        'middleware' => 'can:voucher.grcfors.edit'
    ]);
    $router->delete('grcfors/{grcfor}', [
        'as' => 'admin.voucher.grcfor.destroy',
        'uses' => 'GrcforController@destroy',
        'middleware' => 'can:voucher.grcfors.destroy'
    ]);
    $router->bind('registration', function ($id) {
        return app('Modules\Voucher\Repositories\RegistrationRepository')->find($id);
    });
    $router->get('registrations', [
        'as' => 'admin.voucher.registration.index',
        'uses' => 'RegistrationController@index',
        'middleware' => 'can:voucher.registrations.index'
    ]);
    $router->get('registrations/create', [
        'as' => 'admin.voucher.registration.create',
        'uses' => 'RegistrationController@create',
        'middleware' => 'can:voucher.registrations.create'
    ]);
    $router->post('registrations', [
        'as' => 'admin.voucher.registration.store',
        'uses' => 'RegistrationController@store',
        'middleware' => 'can:voucher.registrations.create'
    ]);
    $router->get('registrations/{id}/edit', [
        'as' => 'admin.voucher.registration.edit',
        'uses' => 'RegistrationController@edit',
        'middleware' => 'can:voucher.registrations.edit'
    ]);

    $router->get('registrations/{id}/editindividual', [
        'as' => 'admin.voucher.registration.edit.individual',
        'uses' => 'RegistrationController@editIndividual',
        'middleware' => 'can:voucher.registrations.edit'
    ]);

    $router->put('registrations/{registration}', [
        'as' => 'admin.voucher.registration.update',
        'uses' => 'RegistrationController@update',
        'middleware' => 'can:voucher.registrations.edit'
    ]);


    $router->get('registrations/{id}/update', [
        'as' => 'admin.voucher.registration.update.individual',
        'uses' => 'RegistrationController@updateRegister',
        'middleware' => 'can:voucher.registrations.edit'
    ]);


    $router->delete('registrations/{id}', [
        'as' => 'admin.voucher.registration.destroy',
        'uses' => 'RegistrationController@destroy',
        'middleware' => 'can:voucher.registrations.destroy'
    ]);

    $router->get('registrations/{id}/registration', [
        'as' => 'admin.voucher.registration.destroyregistration',
        'uses' => 'RegistrationController@destroyRegistration',
        'middleware' => 'can:voucher.registrations.destroy'
    ]);
    $router->bind('userregistration', function ($id) {
        return app('Modules\Voucher\Repositories\UserRegistrationRepository')->find($id);
    });
    $router->get('userregistrations', [
        'as' => 'admin.voucher.userregistration.index',
        'uses' => 'UserRegistrationController@index',
        'middleware' => 'can:voucher.userregistrations.index'
    ]);
    $router->get('userregistrations/create', [
        'as' => 'admin.voucher.userregistration.create',
        'uses' => 'UserRegistrationController@create',
        'middleware' => 'can:voucher.userregistrations.create'
    ]);
    $router->post('userregistrations', [
        'as' => 'admin.voucher.userregistration.store',
        'uses' => 'UserRegistrationController@store',
        'middleware' => 'can:voucher.userregistrations.create'
    ]);
    $router->get('userregistrations/{id}/edit', [
        'as' => 'admin.voucher.userregistration.edit',
        'uses' => 'UserRegistrationController@edit',
        'middleware' => 'can:voucher.userregistrations.edit'
    ]);
    $router->put('userregistrations/{id}', [
        'as' => 'admin.voucher.userregistration.update',
        'uses' => 'UserRegistrationController@update',
        'middleware' => 'can:voucher.userregistrations.edit'
    ]);
    $router->delete('userregistrations/{userregistration}', [
        'as' => 'admin.voucher.userregistration.destroy',
        'uses' => 'UserRegistrationController@destroy',
        'middleware' => 'can:voucher.userregistrations.destroy'
    ]);
// append







});
