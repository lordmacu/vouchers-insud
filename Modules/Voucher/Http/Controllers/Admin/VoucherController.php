<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\Voucher;
use Modules\Voucher\Repositories\VoucherRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class VoucherController extends AdminBaseController
{
    /**
     * @var VoucherRepository
     */
    private $voucher;

    public function __construct(VoucherRepository $voucher)
    {
        parent::__construct();

        $this->voucher = $voucher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$vouchers = $this->voucher->all();

        return view('voucher::admin.vouchers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher::admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->voucher->create($request->all());

        return redirect()->route('admin.voucher.voucher.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::vouchers.title.vouchers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Voucher $voucher
     * @return Response
     */
    public function edit(Voucher $voucher)
    {
        return view('voucher::admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Voucher $voucher
     * @param  Request $request
     * @return Response
     */
    public function update(Voucher $voucher, Request $request)
    {
        $this->voucher->update($voucher, $request->all());

        return redirect()->route('admin.voucher.voucher.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::vouchers.title.vouchers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Voucher $voucher
     * @return Response
     */
    public function destroy(Voucher $voucher)
    {
        $this->voucher->destroy($voucher);

        return redirect()->route('admin.voucher.voucher.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('voucher::vouchers.title.vouchers')]));
    }
}
