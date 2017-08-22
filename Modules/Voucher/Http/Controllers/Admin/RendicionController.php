<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\Rendicion;
use Modules\Voucher\Repositories\RendicionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;
use Modules\Voucher\Entities\UserRegistration;
use Modules\Voucher\Entities\HeadRegistration;
use Modules\Voucher\Repositories\CgmsbcRepository;
 use Modules\Voucher\Entities\Pvmprh;
use Modules\Voucher\Entities\Stmpdh;
use Modules\Voucher\Entities\Cgmsbc;
use Modules\Voucher\Entities\Grcfor;
use Modules\Voucher\Entities\UsrAgrp;
use Illuminate\Support\Facades\Redirect;
use PDF;
use View;
use Mail;

class RendicionController extends AdminBaseController
{
    /**
     * @var RendicionRepository
     */
    private $rendicion;
    private $auth;

    public function __construct(RendicionRepository $rendicion,Authentication $auth)
    {
        parent::__construct();

        $this->rendicion = $rendicion;
                $this->auth = $auth;

    }


 public function generatePdf(){

      $pdf = PDF::LoadEmpty();
      $mpdf=$pdf->getMpdf();

      $user = $this->auth->user();
      $userRegistraion= new UserRegistration();
      $getRegistrationUser=$userRegistraion->getRegistrationUser($user->id);
 
      foreach ($getRegistrationUser as $usuario) {
      
        $HeadRegistration= new HeadRegistration();
        $getRegistrationsByStatus= $HeadRegistration->getRegistrationsByStatus(1,$usuario->USERIID);
         $arrayGroupByAgr=array();
        $vouchersArray=array();

         foreach ($getRegistrationsByStatus as $header) {
            foreach ($header->registrations as $key=> $registration ) {
                $HeadRegistration=HeadRegistration::find($header->id);
                $HeadRegistration->status=2;
                $HeadRegistration->save();
                $arrayRegistration=$registration->toArray();
                $arrayGroupByAgr[$registration->CGMSBC_SUBCUE][$registration->stmpdhs->USR_STMPDH_AGRP01][]=$registration;
                $vouchersArray[]=$registration->toArray();
            }
         }        

         foreach ($arrayGroupByAgr as $key=> $peliculas) {
            $Cgmsbc= new Cgmsbc();

            $getNameMovie=$Cgmsbc->getNameMovie($key);

            $totalRendicion=0;
            $arrayRegistrosPrimerPdf=array();
            $contador=0;

            foreach ($peliculas as $key=> $agrupados) {
           
              $usrAgrp=new UsrAgrp();
              $getUsrAgrpByid=$usrAgrp->getUsrAgrpByid($key);
              foreach ( $getUsrAgrpByid as $usta ) {

                $total=0;
                foreach ($agrupados as $registros ) {
                  $total=$total+(($registros->REGIST_IMPORT*$registros->REGIST_CANTID)+$registros->REGIST_IMPIVA);
                }

                $arrayRegistrosPrimerPdf[$contador]["rubro"]=$usta->USR_AGRP01_DESCRP;
                $arrayRegistrosPrimerPdf[$contador]["rubroId"]=$key;
                $arrayRegistrosPrimerPdf[$contador]["total"]=$total;
                $totalRendicion=$totalRendicion+$total;
                $contador++;

              }

              $data1 = [
               'encabezado' => array("proyecto"=>strtoupper($getNameMovie[0]->CGMSBC_DESCRP),'area'=> $usuario->areas->name,'nombre_usuario'=> strtoupper($user->first_name." ".$user->last_name),"fecha"=>date("d/m/Y")),
              'data' => $arrayRegistrosPrimerPdf,
              'totalRendicion' => $totalRendicion
              ];
            }
             
            $mpdf->AddPage();
            $mpdf->WriteHTML(View::make('voucher::admin.registrations.pdf.tableone', $data1, [])->render());

        }

      }


      foreach ($arrayGroupByAgr as $key => $pelicula) {
           $Cgmsbc= new Cgmsbc();

            $getNameMovie=$Cgmsbc->getNameMovie($key);

        foreach ($pelicula as $key => $rubro) {

          $usrAgrp=new UsrAgrp();
          $getUsrAgrpByid=$usrAgrp->getUsrAgrpByid($key);
             $arrayRubro=array();
             $arrayVoucher=array();
             $totalValorItems=0;
          foreach ($rubro as $item) {

            $total=($item->REGIST_IMPORT*$item->REGIST_CANTID)+$item->REGIST_IMPIVA;
            $arrayVoucher[]=array(
              "desc"=>$item->stmpdhs->STMPDH_DESCRP." ".$item->pvmprhs->PVMPRH_NOMBRE." - ".$item->grcfors->GRCFOR_CODFOR." - ".$item->REGIST_NROFOR." - ".$item->order_item." - ".$item->comentario_individual_voucher,
              "cod"=>$item->stmpdhs->STMPDH_ARTCOD,
              "total"=>$total);
             $totalValorItems=$totalValorItems+$total;
          }

          $arrayRubro["items"]=$arrayVoucher;
          $arrayRubro["rubro"]=$key;
          $arrayRubro["valortotal"]=$totalValorItems;
          $arrayRubro["encabezado"]=array("proyecto"=>strtoupper($getNameMovie[0]->CGMSBC_DESCRP),'area'=> $usuario->areas->name,'nombre_usuario'=> strtoupper($user->first_name." ".$user->last_name),"fecha"=>date("d/m/Y"));
          $mpdf->AddPage();
          $mpdf->WriteHTML(View::make('voucher::admin.registrations.pdf.tabletwo', $arrayRubro, [])->render());


        }

      }

      if(count($arrayGroupByAgr)==0){
        return 0;
      }
        $nameOutput='renditions/'.$getRegistrationUser[0]->USERIID.'-'.time().'.pdf';
        $mpdf->Output($nameOutput,'F');
        $rendition= new Rendicion();
        $rendition->url='renditions/'.$getRegistrationUser[0]->USERIID.'-'.time().'.pdf';
        $rendition->user_id=$getRegistrationUser[0]->USERIID;
        $rendition->save();


         foreach ($getRegistrationsByStatus as $header) {
            foreach ($header->registrations as $key=> $registration ) {
                $HeadRegistration=HeadRegistration::find($header->id);
                $HeadRegistration->rendition=$rendition->id;
                $HeadRegistration->save();
            
            }
         } 


    return $nameOutput;

  }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {


      $user = $this->auth->user();
      $userRegistraion= new UserRegistration();
      $getRegistrationUser=$userRegistraion->getRegistrationUser($user->id);
    
        $rendicions = Rendicion::where("user_id",$getRegistrationUser[0]->USERIID)->get();

        return view('voucher::admin.rendicions.index', compact('rendicions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return $this->generatePdf();
        //return view('voucher::admin.rendicions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->rendicion->create($request->all());

        return redirect()->route('admin.voucher.rendicion.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::rendicions.title.rendicions')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Rendicion $rendicion
     * @return Response
     */
    public function edit(Rendicion $rendicion)
    {
        return view('voucher::admin.rendicions.edit', compact('rendicion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Rendicion $rendicion
     * @param  Request $request
     * @return Response
     */
    public function update(Rendicion $rendicion, Request $request)
    {
        $this->rendicion->update($rendicion, $request->all());

        return redirect()->route('admin.voucher.rendicion.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::rendicions.title.rendicions')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rendicion $rendicion
     * @return Response
     */
    public function destroy(Rendicion $rendicion)
    {
        $this->rendicion->destroy($rendicion);

        return redirect()->route('admin.voucher.rendicion.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('voucher::rendicions.title.rendicions')]));
    }
}
