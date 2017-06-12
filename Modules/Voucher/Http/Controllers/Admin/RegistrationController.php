<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\Registration;
use Modules\Voucher\Repositories\RegistrationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
 use Modules\Voucher\Entities\Pvmprh;
use Modules\Voucher\Entities\Stmpdh;
use Modules\Voucher\Entities\Cgmsbc;
use Modules\Voucher\Entities\Grcfor;
use Modules\Voucher\Entities\HeadRegistration;
use Nwidart\Modules\Facades\Module;
use Modules\User\Contracts\Authentication;
use Modules\Voucher\Entities\UserRegistration;
use Modules\Voucher\Repositories\GrcforRepository;
use Modules\Voucher\Repositories\CgmsbcRepository;
use Modules\Voucher\Repositories\StmpdhRepository;
use Illuminate\Support\Facades\DB;
class RegistrationController extends AdminBaseController
{
    /**
     * @var RegistrationRepository
     */
    private $registration;

    private $auth;
    private $grcfor;
    private $cgmsbc;
    private $stmpdh;


    public function __construct(RegistrationRepository $registration,Authentication $auth, GrcforRepository $grcfor, CgmsbcRepository $cgmsbc,StmpdhRepository $stmpdh )
    {
        parent::__construct();

        $this->registration = $registration;
        $this->auth = $auth;
        $this->grcfor = $grcfor;
        $this->cgmsbc = $cgmsbc;
        $this->stmpdh = $stmpdh;

        $this->requireAssets();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $registrations = HeadRegistration::all();
        $CgmsbcTranslation = Cgmsbc::pluck('CGMSBC_DESCRP', 'CGMSBC_CODDIM');

        $PvmprhTranslation = Pvmprh::pluck('PVMPRH_NOMBRE', 'PVMPRH_NROCTA');

         $date=date('Ymd');
        $GrcforTranslation = Grcfor::pluck('GRCFOR_DESCRP', 'GRCFOR_CODFOR');

        return view('voucher::admin.registrations.index')
        ->with("Cgmsbc",$CgmsbcTranslation)
                ->with("Pvmprh",$PvmprhTranslation)
        ->with("date",$date)
        ->with("Grcfor",$GrcforTranslation)

        ->with("registrations",$registrations) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {



        $headRegistration= new HeadRegistration();
        $headRegistration->CGMSBC_CODDIM=$request->get("CGMSBC_CODDIM");
        $headRegistration->PVMPRH_NROCTA=$request->get("PVMPRH_NROCTA");
        $headRegistration->REGIST_FECMOV=$request->get("REGIST_FECMOV");
        $headRegistration->GRCFOR_CODFOR=$request->get("GRCFOR_CODFOR");
        $headRegistration->REGIST_NROFOR=$request->get("REGIST_NROFOR");
        $headRegistration->save();



        $headerId=$headRegistration->id;

        $user = $this->auth->user();
        $userRegistraion= new UserRegistration();
        $getRegistrationUser=$userRegistraion->getRegistrationUser($user->id);
        
        if($getRegistrationUser->count()){
            $registrationId=$getRegistrationUser[0]->USERIID;   
        }else{
            return redirect()->route('admin.voucher.registration.index')
            ->withError("Es necesario que el usuario este vinculado con un id");
        }

        $Pvmprh= new Pvmprh();
        $listPvmprh= array();
//        $PvmprhTranslation = Pvmprh::pluck('PVMPRH_NOMBRE', 'PVMPRH_NROCTA');
        $StmpdhTranslation = Stmpdh::pluck('STMPDH_DESCRP', 'STMPDH_ARTCOD');
        $CgmsbcTranslation = Cgmsbc::pluck('CGMSBC_DESCRP', 'CGMSBC_CODDIM');
        //$GrcforTranslation = Grcfor::pluck('GRCFOR_DESCRP', 'GRCFOR_CODFOR');
       //  $date=date('Ymd');

        return view('voucher::admin.registrations.create')
       // ->with("Pvmprh",$PvmprhTranslation)
        ->with("Stmpdh",$StmpdhTranslation)
        ->with("Cgmsbc",$CgmsbcTranslation) 
       // ->with("Grcfor",$GrcforTranslation)
        ->with("REGIST_CABITM",$headerId)
        //->with("date",$date)
        ->with("CGMSBC_CODDIM",$request->get("CGMSBC_CODDIM"))
        ->with("registrationId",$registrationId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $headerId=$request->get("REGIST_CABITM");


        $HeadRegistration=HeadRegistration::find($headerId);
        $arrayEs=array();
        $arrayEs["PVMPRH_NROCTA"]=$HeadRegistration->PVMPRH_NROCTA;
        $arrayEs["GRCFOR_CODFOR"]=$HeadRegistration->GRCFOR_CODFOR;
        $arrayEs["CGMSBC_CODDIM"]=$HeadRegistration->CGMSBC_CODDIM;
              

        $stmpdh=$this->stmpdh->findByAttributes(array("STMPDH_ARTCOD"=>$request->get("STMPDH_ARTCOD")));
         $arrayEs["STMPDH_TIPPRO"]=$stmpdh->STMPDH_TIPPRO;
        $arrayEs["STMPDH_ARTCOD"]=$request->get("STMPDH_ARTCOD");
        $arrayEs["REGIST_USERIID"]=$request->get("REGIST_USERIID");
        $arrayEs["REGIST_FECALT"]=date('Ymd');
        $arrayEs["REGIST_TIMALT"]=date('Gis');
        $arrayEs["REGIST_TRANSF"]="N";
        $arrayEs["REGIST_CABITM"]=$headerId;
        $arrayEs["REGIST_NROFOR"]=$HeadRegistration->REGIST_NROFOR;
        $arrayEs["REGIST_IMPIVA"]=$request->get("REGIST_IMPIVA");
        $arrayEs["REGIST_CANTID"]=$request->get("REGIST_CANTID");
        $arrayEs["REGIST_IMPORT"]=$request->get("REGIST_IMPORT");
        $arrayEs["REGIST_FECMOV"]=$HeadRegistration->REGIST_FECMOV;
 

        $grcfor=$this->grcfor->findByAttributes(array("GRCFOR_CODFOR"=>$HeadRegistration->GRCFOR_CODFOR));
        $arrayEs["GRCFOR_MODFOR"]=$grcfor->GRCFOR_MODFOR;
        $cgmsbc=$this->cgmsbc->findByAttributes(array("CGMSBC_CODDIM"=>$HeadRegistration->CGMSBC_CODDIM));
        $arrayEs["CGMSBC_SUBCUE"]=$cgmsbc->CGMSBC_SUBCUE;
        $result=$this->registration->create($arrayEs);
        $incremental = sprintf('%04d',$result->id);
        $resultTemp=Registration::find($result->id);
        $resultTemp->REGIST_NROITM=$result->id;
        $resultTemp->REGIST_ID=date('Ymd').$incremental;
         $resultTemp->save();
 
        return redirect()->route('admin.voucher.registration.edit',array("id"=>$headerId,"CGMSBC_CODDIM=".$request->get("CGMSBC_CODDIM")))

             ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::registrations.title.registrations')]));
    }



    public function editIndividual($id){

        $registration= Registration::find($id);

        $user = $this->auth->user();

        $userRegistraion= new UserRegistration();
        $getRegistrationUser=$userRegistraion->getRegistrationUser($user->id);
        
        if($getRegistrationUser->count()){
            $registrationId=$getRegistrationUser[0]->USERIID;   
        }else{
            return redirect()->route('admin.voucher.registration.index')
            ->withError("Es necesario que el usuario este vinculado con un id");
        }

        $PvmprhTranslation = Pvmprh::pluck('PVMPRH_NOMBRE', 'PVMPRH_NROCTA');
        $StmpdhTranslation = Stmpdh::pluck('STMPDH_DESCRP', 'STMPDH_ARTCOD');
        $CgmsbcTranslation = Cgmsbc::pluck('CGMSBC_DESCRP', 'CGMSBC_CODDIM');
        $GrcforTranslation = Grcfor::pluck('GRCFOR_DESCRP', 'GRCFOR_CODFOR');
        return view('voucher::admin.registrations.editindividual', compact('registration'))
            ->with("Pvmprh",$PvmprhTranslation)
            ->with("Stmpdh",$StmpdhTranslation)
            ->with("Cgmsbc",$CgmsbcTranslation)        
            ->with("Grcfor",$GrcforTranslation)
            ->with("registration",$registration)
            ->with("registrationId",$registrationId);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  Registration $registration
     * @return Response
     */
    public function edit($id,Request $request)
    {

        $user = $this->auth->user();

        $userRegistraion= new UserRegistration();
        $getRegistrationUser=$userRegistraion->getRegistrationUser($user->id);
        
        if($getRegistrationUser->count()){
            $registrationId=$getRegistrationUser[0]->USERIID;   
        }else{
            return redirect()->route('admin.voucher.registration.index')
            ->withError("Es necesario que el usuario este vinculado con un id");
        }

        if(!$request->has("CGMSBC_CODDIM")){
                  return redirect()->route('admin.voucher.registration.index')
            ->withError("Es necesario vincular estos vouchers con una pelicula"); 
        } 

        $Pvmprh= new Pvmprh();
        $listPvmprh= array();
        $PvmprhTranslation = Pvmprh::pluck('PVMPRH_NOMBRE', 'PVMPRH_NROCTA');
        $StmpdhTranslation = Stmpdh::pluck('STMPDH_DESCRP', 'STMPDH_ARTCOD');
        $CgmsbcTranslation = Cgmsbc::pluck('CGMSBC_DESCRP', 'CGMSBC_CODDIM');
        $GrcforTranslation = Grcfor::pluck('GRCFOR_DESCRP', 'GRCFOR_CODFOR');
 
        $registration= HeadRegistration::find($id);
        $date=date('Ymd');
 
        return view('voucher::admin.registrations.edit', compact('registration'))
        ->with("Pvmprh",$PvmprhTranslation)
        ->with("Stmpdh",$StmpdhTranslation)
        ->with("Cgmsbc",$CgmsbcTranslation)
        ->with("Grcfor",$GrcforTranslation)
        ->with("REGIST_CABITM",$id)
        ->with("date",$date)
        ->with("CGMSBC_CODDIM",$request->get("CGMSBC_CODDIM"))
        ->with("registrationId",$registrationId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Registration $registration
     * @param  Request $request
     * @return Response
     */
    public function update(Registration $registration, Request $request)
    {

        $registrationParams=$request->all();
        $registrationParams["REGIST_FECMOD"] =date('Ymd');
        $registrationParams["REGIST_TIMMOD"] =date('Gis');
        $this->registration->update($registration, $registrationParams);

        return redirect()->route('admin.voucher.registration.edit',array($request->REGIST_CABITM,"CGMSBC_CODDIM=".$request->CGMSBC_CODDIM))
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::registrations.title.registrations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Registration $registration
     * @return Response
     */
    public function destroy($id)
    {



        $registrations= HeadRegistration::find($id);

        $contadorRegistros=0;
        foreach ($registrations->registrations as $key ) {
              if($key->REGIST_TRANSF=="S"){
                $contadorRegistros++;
             }
        }


          if($contadorRegistros==0){
            $result=DB::table('voucher__registrations')
            ->where('REGIST_CABITM', $id)
            ->delete();
 
            DB::table('voucher__registrations__head')->where('id', $id)->delete();

            return redirect()->route('admin.voucher.registration.index')
            ->withSuccess("Se han eliminado los vouchers con éxito");
        }
        
         return redirect()->route('admin.voucher.registration.index')
            ->withError("Hay un problema eliminando los vouchers, por que ya fueron eliminados");
        
  
    }

    public function destroyRegistration($id, Request $request)
    {

 
        $result=DB::table('voucher__registrations')
        ->where('id', $id)
        ->where('REGIST_TRANSF', 'N')
        ->delete();


         return redirect()
        ->route('admin.voucher.registration.edit',array("id"=>$request->get("header"),"CGMSBC_CODDIM=".$request->get("CGMSBC_CODDIM")))
            ->withSuccess("Se han eliminado el voucher con éxito");
    }


     private function requireAssets()
    {
        $this->assetManager->addAsset('bootstrap-editables.css', Module::asset('translation:vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css'));
        $this->assetManager->addAsset('bootstrap-editables.js', Module::asset('translation:vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js'));

        $this->assetPipeline->requireJs('bootstrap-editables.js');
        $this->assetPipeline->requireCss('bootstrap-editables.css');
    }
}
  