<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\Cgmsbc;
use Modules\Voucher\Repositories\CgmsbcRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CgmsbcController extends AdminBaseController
{
    /**
     * @var CgmsbcRepository
     */
    private $cgmsbc;

    public function __construct(CgmsbcRepository $cgmsbc)
    {
        parent::__construct();

        $this->cgmsbc = $cgmsbc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cgmsbcs = $this->cgmsbc->all();

        return view('voucher::admin.cgmsbcs.index')->with("cgmsbcs",$cgmsbcs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher::admin.cgmsbcs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->cgmsbc->create($request->all());

        return redirect()->route('admin.voucher.cgmsbc.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::cgmsbcs.title.cgmsbcs')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Cgmsbc $cgmsbc
     * @return Response
     */
    public function edit(Cgmsbc $cgmsbc)
    {
        return view('voucher::admin.cgmsbcs.edit', compact('cgmsbc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Cgmsbc $cgmsbc
     * @param  Request $request
     * @return Response
     */
    public function update(Cgmsbc $cgmsbc, Request $request)
    {
        $this->cgmsbc->update($cgmsbc, $request->all());

        return redirect()->route('admin.voucher.cgmsbc.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::cgmsbcs.title.cgmsbcs')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cgmsbc $cgmsbc
     * @return Response
     */
    public function destroy(Cgmsbc $cgmsbc)
    {


        if($cgmsbc->registrations->count()==0){
            $this->cgmsbc->destroy($cgmsbc);
            return redirect()->route('admin.voucher.cgmsbc.index')
                ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('voucher::cgmsbcs.title.cgmsbcs')]));
                    
        }else{
                return redirect()->route('admin.voucher.cgmsbc.index')
                ->withError("Esta película tiene uno o mas vouchers asociados y no se puede borrar");
            
        }
    }
}