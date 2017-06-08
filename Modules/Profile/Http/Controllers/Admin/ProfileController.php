<?php

namespace Modules\Profile\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Profile\Entities\Profile;
use Modules\Profile\Repositories\ProfileRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ProfileController extends AdminBaseController
{
    /**
     * @var ProfileRepository
     */
    private $profile;

    public function __construct(ProfileRepository $profile)
    {
        parent::__construct();

        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$profiles = $this->profile->all();

        return view('profile::admin.profiles.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('profile::admin.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->profile->create($request->all());

        return redirect()->route('admin.profile.profile.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('profile::profiles.title.profiles')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Profile $profile
     * @return Response
     */
    public function edit(Profile $profile)
    {
        return view('profile::admin.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Profile $profile
     * @param  Request $request
     * @return Response
     */
    public function update(Profile $profile, Request $request)
    {
        $this->profile->update($profile, $request->all());

        return redirect()->route('admin.profile.profile.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('profile::profiles.title.profiles')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Profile $profile
     * @return Response
     */
    public function destroy(Profile $profile)
    {
        $this->profile->destroy($profile);

        return redirect()->route('admin.profile.profile.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('profile::profiles.title.profiles')]));
    }
}
