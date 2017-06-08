<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\Stmpdh;
use Modules\Voucher\Repositories\StmpdhRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class StmpdhController extends AdminBaseController
{
    /**
     * @var StmpdhRepository
     */
    private $stmpdh;

    public function __construct(StmpdhRepository $stmpdh)
    {
        parent::__construct();

        $this->stmpdh = $stmpdh;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $stmpdhs = $this->stmpdh->all();
        return view('voucher::admin.stmpdhs.index')->with("stmpdhs",$stmpdhs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher::admin.stmpdhs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->stmpdh->create($request->all());

        return redirect()->route('admin.voucher.stmpdh.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::stmpdhs.title.stmpdhs')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Stmpdh $stmpdh
     * @return Response
     */
    public function edit(Stmpdh $stmpdh)
    {
        return view('voucher::admin.stmpdhs.edit', compact('stmpdh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Stmpdh $stmpdh
     * @param  Request $request
     * @return Response
     */
    public function update(Stmpdh $stmpdh, Request $request)
    {
        $this->stmpdh->update($stmpdh, $request->all());

        return redirect()->route('admin.voucher.stmpdh.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::stmpdhs.title.stmpdhs')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Stmpdh $stmpdh
     * @return Response
     */
    public function destroy(Stmpdh $stmpdh)
    {
        $this->stmpdh->destroy($stmpdh);

        return redirect()->route('admin.voucher.stmpdh.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('voucher::stmpdhs.title.stmpdhs')]));
    }
}
