<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\Grcfor;
use Modules\Voucher\Repositories\GrcforRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class GrcforController extends AdminBaseController
{
    /**
     * @var GrcforRepository
     */
    private $grcfor;

    public function __construct(GrcforRepository $grcfor)
    {
        parent::__construct();

        $this->grcfor = $grcfor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $grcfors = $this->grcfor->all();

        return view('voucher::admin.grcfors.index')->with("grcfors",$grcfors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher::admin.grcfors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->grcfor->create($request->all());

        return redirect()->route('admin.voucher.grcfor.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::grcfors.title.grcfors')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Grcfor $grcfor
     * @return Response
     */
    public function edit(Grcfor $grcfor)
    {
        return view('voucher::admin.grcfors.edit', compact('grcfor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Grcfor $grcfor
     * @param  Request $request
     * @return Response
     */
    public function update(Grcfor $grcfor, Request $request)
    {
        $this->grcfor->update($grcfor, $request->all());

        return redirect()->route('admin.voucher.grcfor.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::grcfors.title.grcfors')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Grcfor $grcfor
     * @return Response
     */
    public function destroy(Grcfor $grcfor)
    {
        $this->grcfor->destroy($grcfor);

        return redirect()->route('admin.voucher.grcfor.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('voucher::grcfors.title.grcfors')]));
    }
}
