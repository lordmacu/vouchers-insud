<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\Pvmprh;
use Modules\Voucher\Repositories\PvmprhRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PvmprhController extends AdminBaseController
{
    /**
     * @var PvmprhRepository
     */
    private $pvmprh;

    public function __construct(PvmprhRepository $pvmprh)
    {
        parent::__construct();

        $this->pvmprh = $pvmprh;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pvmprhs = $this->pvmprh->all();
        
        return view('voucher::admin.pvmprhs.index')->with("pvmprhs",$pvmprhs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher::admin.pvmprhs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $result=$this->pvmprh->create($request->all()["es"]);

 
        return redirect()->route('admin.voucher.pvmprh.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::pvmprhs.title.pvmprhs')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Pvmprh $pvmprh
     * @return Response
     */
    public function edit(Pvmprh $pvmprh)
    {
        return view('voucher::admin.pvmprhs.edit', compact('pvmprh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Pvmprh $pvmprh
     * @param  Request $request
     * @return Response
     */
    public function update(Pvmprh $pvmprh, Request $request)
    {
        $this->pvmprh->update($pvmprh, $request->all()["es"]);

        return redirect()->route('admin.voucher.pvmprh.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::pvmprhs.title.pvmprhs')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pvmprh $pvmprh
     * @return Response
     */
    public function destroy(Pvmprh $pvmprh)
    {
        $this->pvmprh->destroy($pvmprh);

        return redirect()->route('admin.voucher.pvmprh.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('voucher::pvmprhs.title.pvmprhs')]));
    }
}
