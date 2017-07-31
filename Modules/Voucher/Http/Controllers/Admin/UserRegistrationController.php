<?php

namespace Modules\Voucher\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Voucher\Entities\UserRegistration;
use Modules\Voucher\Repositories\UserRegistrationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Repositories\UserRepository;
 use Modules\Voucher\Entities\Cgmsbc;

class UserRegistrationController extends AdminBaseController
{
    /**
     * @var UserRegistrationRepository
     */
    private $userregistration;

    public function __construct(UserRegistrationRepository $userregistration, UserRepository $user)
    {
        parent::__construct();

        $this->userregistration = $userregistration;
        $this->user = $user;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$userregistrations = $this->userregistration->all();

        $users=$this->user->all();

 

        $userArray= array();


        foreach ($users as $key => $value) {
            # code...
            $usersUregistration= new UserRegistration();
            $userArray[$key]["id"]=$value->id;
            $userArray[$key]["first_name"]=$value->first_name;
            $userArray[$key]["last_name"]=$value->last_name;

            $getRegistrationUser=$usersUregistration->getRegistrationUser($value->id);
            if($getRegistrationUser->count()){
                $userArray[$key]["USERIID"]= $getRegistrationUser[0]->USERIID;
                $Cgmsbc= new Cgmsbc();

                  if($getRegistrationUser[0]->CGMSBC_SUBCUE=="0"){
                    $userArray[$key]["CGMSBC_DESCRP"]="";


                  }else{
                   $getNameMovie=$Cgmsbc->getNameMovie($getRegistrationUser[0]->CGMSBC_SUBCUE);
 
                    $userArray[$key]["CGMSBC_DESCRP"]= $getNameMovie[0]->CGMSBC_DESCRP;
                  }

            }else{
                $userArray[$key]["USERIID"]="";
                $userArray[$key]["CGMSBC_DESCRP"]="";
            }

         }




         return view('voucher::admin.userregistrations.index')->with("users",$userArray);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('voucher::admin.userregistrations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->userregistration->create($request->all());

        return redirect()->route('admin.voucher.userregistration.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('voucher::userregistrations.title.userregistrations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UserRegistration $userregistration
     * @return Response
     */
    public function edit($id)
    {
 

         $Cgmsbc = Cgmsbc::pluck("CGMSBC_DESCRP","CGMSBC_SUBCUE")->all();
 
        $user=$this->user->find($id);
        $userRegistraion= new UserRegistration();
        $getRegistrationUser=$userRegistraion->getRegistrationUser($user->id);
         $registrationId="";
         $CGMSBC_SUBCUE=0;

         if($getRegistrationUser->count()){
            $registrationId=$getRegistrationUser[0]->USERIID; 
            $CGMSBC_SUBCUE=$getRegistrationUser[0]->CGMSBC_SUBCUE; 

         }

        $userRegistrationArray= array(
            "first_name"=>$user->first_name,
            "last_name"=>$user->last_name,
            "id"=>$user->id,
            "registrationId"=>$registrationId,
            "CGMSBC_SUBCUE"=>$CGMSBC_SUBCUE
            );




 
        return view('voucher::admin.userregistrations.edit', compact('userRegistrationArray'))->with("Cgmsbc",array('0' => 'Seleccione una Película') +$Cgmsbc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRegistration $userregistration
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {



        ///$this->userregistration->user_id=$request->get();

        $userregistration= new UserRegistration();

        $getRegistrationUserId=$userregistration->getRegistrationUser($request->get("user_id"));

          if($getRegistrationUserId->count()){
            $userRegistrationFind=UserRegistration::find($getRegistrationUserId[0]->id);
            $userRegistrationFind->CGMSBC_SUBCUE=$request->get("CGMSBC_SUBCUE");
            $userRegistrationFind->USERIID=$request->get("USERIID");
            $userRegistrationFind->save();
        }else{
            $userregistration->user_id=$request->get("user_id");
            $userregistration->CGMSBC_SUBCUE=$request->get("CGMSBC_SUBCUE");
            $userregistration->USERIID=$request->get("USERIID");
            $userregistration->save();
        }

 

        //$this->userregistration->update($userregistration, $request->all());

        return redirect()->route('admin.voucher.userregistration.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('voucher::userregistrations.title.userregistrations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UserRegistration $userregistration
     * @return Response
     */
    public function destroy(UserRegistration $userregistration)
    {
        $this->userregistration->destroy($userregistration);

        return redirect()->route('admin.voucher.userregistration.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('voucher::userregistrations.title.userregistrations')]));
    }
}
