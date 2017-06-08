<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/profile'], function (Router $router) {
    $router->bind('profile', function ($id) {
        return app('Modules\Profile\Repositories\ProfileRepository')->find($id);
    });
    $router->get('profiles', [
        'as' => 'admin.profile.profile.index',
        'uses' => 'ProfileController@index',
        'middleware' => 'can:profile.profiles.index'
    ]);
    $router->get('profiles/create', [
        'as' => 'admin.profile.profile.create',
        'uses' => 'ProfileController@create',
        'middleware' => 'can:profile.profiles.create'
    ]);
    $router->post('profiles', [
        'as' => 'admin.profile.profile.store',
        'uses' => 'ProfileController@store',
        'middleware' => 'can:profile.profiles.create'
    ]);
    $router->get('profiles/{profile}/edit', [
        'as' => 'admin.profile.profile.edit',
        'uses' => 'ProfileController@edit',
        'middleware' => 'can:profile.profiles.edit'
    ]);
    $router->put('profiles/{profile}', [
        'as' => 'admin.profile.profile.update',
        'uses' => 'ProfileController@update',
        'middleware' => 'can:profile.profiles.edit'
    ]);
    $router->delete('profiles/{profile}', [
        'as' => 'admin.profile.profile.destroy',
        'uses' => 'ProfileController@destroy',
        'middleware' => 'can:profile.profiles.destroy'
    ]);
// append

});
