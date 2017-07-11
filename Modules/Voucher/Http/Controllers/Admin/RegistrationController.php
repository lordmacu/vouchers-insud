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


    }

function remove_empty_tags_recursive ($str, $repto = NULL)
{
    //** Return if string not given or empty.
    if (!is_string ($str)
        || trim ($str) == '')
            return $str;

    //** Recursive empty HTML tags.
    return preg_replace (

        //** Pattern written by Junaid Atari.
        '/<([^<\/>]*)>([\s]*?|(?R))<\/\1>/imsU',

        //** Replace with nothing if string empty.
        !is_string ($repto) ? '' : $repto,

        //** Source string
        $str
    );
}

function remove_empty_p($content){
    $content = force_balance_tags($content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function extractCommonWords($string){
      $stopWords = array('alguna','yo','un','una','sobre','y','son','como','de','ser','por','com','de','en','por','de','cual','en','es','eso','la','o','eso','la','eso','a','era','que','entonces','donde','quien','era','sera','con','und','el','lo','dónde','por qué','Qué','quién','cuándo','cuánto','cuál','cómo','e','ni','ni siquiera','sino','tambien','también','pero','aunque','al contrario','en cambio','sin empbargo','a pesar de','no obstante','sino','sino que','o bien','o sea','es decir','esto es','porque','ya que','dado que','debido a que','puesto que','como','a no ser que','aun','muy','luego','pues','por','eso','ahi','aqui','tan','para','fin','apenas','mientras','siempre','las','ylas','enlaedad','imgur','cuando','reddit','twitter','incluso','picture','este','imgrum','overseainstagrammernews','pixabay','cmics','depositphotos','puede','pueden','esto','nuestro','foto','estar','interesantecomar','tuits','saludableinteresantecomar','rexfeatures','puedes','demas','esta','pikabu','rrrrrrr','asko','mismointeresantecomar','todo','solo','estos','muchos' ,'dicen','pase','falta','hace','depositphotoscom','ella','fueron','dice','tener','debe','cada','hasta','quieren','todo','bien','tanto','eastnews','hacia','durante','despues','commons','wikimedia','permite','puedes','tiene','tipo','junto','contiene','encuentra','causar','puesto','algunas','mucho','pasan','desde','haran','menos','algunos','tantos','ellas','pudo','cualquier','antes','segun','ellos','haya','seguramente','quedo','estes','necesitas','estas','quienes','encontramos','mismo','0','sako','mejor','nuestros','toda','todas','todos','todosr','ahora','tienen','flickr','ademas','tipos','usando','debes','saben','algo','algunos','contra','contienen','puedas','hacerlo','dira','estan','east','gran','buena','otros','twittercom','imgurcom','redditcom','hollyscoopcom','empece','tengo','tenia','tengo','hizo','haber','tendra','muchas','cuantos','usar','simplemente','news','parte','decir','otras','otro','aquel','veces','vuelve','hacer','sabe','posible','muchas','facebookcom','nada','anos','intenta','basado','crees','queremos','sucede','sentimos','sigue','debido','revela','pena','limpiarlas','directamente','existe','consumidos','aportan','exitosa','debido','empezo','distintas');
   
      $string = preg_replace('/\s\s+/i', ' ', $string); // replace whitespace
      $string = trim($string); // trim the string
      $string = preg_replace('/[^a-zA-Z0-9 -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too…
      $string = strtolower($string); // make it lowercase
   
      preg_match_all('/\b.*?\b/i', $string, $matchWords);
      $matchWords = $matchWords[0];
      
      foreach ( $matchWords as $key=>$item ) {
          if ( $item == '' || in_array(strtolower($item), $stopWords) || strlen($item) <= 3 ) {
              unset($matchWords[$key]);
          }
      }   
      $wordCountArr = array();
      if ( is_array($matchWords) ) {
          foreach ( $matchWords as $key => $val ) {
              $val = strtolower($val);
              if ( isset($wordCountArr[$val]) ) {
                  $wordCountArr[$val]++;
              } else {
                  $wordCountArr[$val] = 1;
              }
          }
      }
      arsort($wordCountArr);
      $wordCountArr = array_slice($wordCountArr, 0, 10);
      return $wordCountArr;
}


   

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

 /*$file="file.xml";
$current = file_get_contents($file);

 $otros="";


  $contador=1;

for ($i=1; $i <19 ; $i++) { 
 

  $path = $i.".json";  
  $json = json_decode(file_get_contents($path), true); 

  if(count($json)>0){

 
  foreach ($json as   $value) {

    $result= array();
    $result[] = array(
          "titulo"=>$value["data"]["titulo"],
          "src"=>$value["data"]["src"],
          "desc"=>$value["data"]["desc"],
          "href"=>$value["data"]["href"],
          "html"=>$value["html"]
          );
    $desc=  str_replace("Genial.guru", " interesante.com.ar ", $value["data"]["desc"]);
    $html=  str_replace("Genial.guru", " interesante.com.ar ", $value["html"]);
    $removep=str_replace("\n", "", $html);
    $resultddd = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $removep);
    $htmlasfad = preg_replace('~>\s+<~', '><', $resultddd);
    $limpiado=str_replace("&nbsp;", " ", $htmlasfad);

    $titulo=$value["data"]["titulo"];
    $image="";
    $metasArray=array();
    $slug = \Str::slug($value["data"]["titulo"], '_');

    foreach ($value["metas"] as   $meta) {
      
      if($meta["property"]=="og:image"){
          $image=$meta["content"];
      }

      if($meta["property"]=="og:site_name"){
          $metasArraytemp=explode("—", $meta["content"]);
          $metasArraytempUno=explode(".", trim($metasArraytemp[1]));
   
          foreach ($metasArraytempUno as $metaLimpio) {
              if($metaLimpio){
                  $metasArray[]= trim($metaLimpio);       
              }
          }
      }
    }
    $cat=$metasArray[array_rand($metasArray,1)];
    $textolimpioFin=$this->remove_empty_tags_recursive(strip_tags(($limpiado),"<img><p>"));

    $palabraTags=array();
    
    foreach ($this->extractCommonWords(strip_tags($this->normaliza($textolimpioFin))) as $key => $keys) {
      $palabraTags[]=$key;
    }

    $otros=$otros.'<post>
                    <id>'.$contador.'</id>
                    <image>'.$image.'</image>
                    <titulo>'.$value["data"]["titulo"].'</titulo>
                    <desc>'.$desc.'</desc>
                    <cat>'.$cat.'</cat>
                    <slug>'.$slug.'</slug>
                    <tags>'.implode(",", $palabraTags).'</tags>
                   
                    <htmldata><![CDATA['.$textolimpioFin.']]></htmldata>
                  </post>';
    $contador++;

   }
  }
 }
 
$principio='<?xml version="1.0" encoding="UTF-8"?><document>';
$fin='</document>';
file_put_contents($file,  $principio.$otros.$fin);*/




         $user = $this->auth->user();
        $userRegistraion= new UserRegistration();
        $getRegistrationUser=$userRegistraion->getRegistrationUser($user->id);


        if($getRegistrationUser->count()){
            $registrationId=$getRegistrationUser[0]->USERIID;   
        }else{
            return redirect()->route('admin.voucher.registration.index')
            ->withError("Es necesario que el usuario este vinculado con un id");
        }

        $registrations = HeadRegistration::where("USERIID",$getRegistrationUser[0]->USERIID)->get();

        $arrayRegistrations=array();
        foreach ($registrations as $r) {

          if($r->registrations->count()==0 || !$r->PVMPRH_NROCTA){
             HeadRegistration::find($r->id)->delete();
          }
          if($r->registrations->count()!=0){
            $arrayRegistrations[]=$r;
          }
 
        }

 
        $CGMSBC_SUBCUE=0;

        foreach ($getRegistrationUser as  $value) {
           $CGMSBC_SUBCUE=$value->CGMSBC_SUBCUE;
        }

         $CgmsbcTranslation = Cgmsbc::pluck('CGMSBC_DESCRP', 'CGMSBC_SUBCUE');

        $PvmprhTranslation = Pvmprh::pluck('PVMPRH_NOMBRE', 'PVMPRH_NROCTA');

         $date=date('Y-m-d');
        $GrcforTranslation = Grcfor::pluck('GRCFOR_DESCRP', 'GRCFOR_CODFOR');

        return view('voucher::admin.registrations.index')
        ->with("Cgmsbc",$CgmsbcTranslation)
                ->with("Pvmprh",$PvmprhTranslation)
        ->with("date",$date)
        ->with("Grcfor",$GrcforTranslation)
        ->with("CGMSBC_SUBCUE",$CGMSBC_SUBCUE)
        ->with("registrations",$arrayRegistrations) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
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
        $headRegistration= new HeadRegistration();
        $headRegistration->CGMSBC_SUBCUE=$request->get("CGMSBC_SUBCUE");
 
        $headRegistration->USERIID=$registrationId;
        $headRegistration->save();



        $headerId=$headRegistration->id;


        $registrationModel=HeadRegistration::find($headerId);


        return redirect()
        ->route('admin.voucher.registration.edit',array("id"=>$headRegistration->id,"CGMSBC_SUBCUE=".$request->get("CGMSBC_SUBCUE")));
 
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
        $arrayEs["CGMSBC_SUBCUE"]=$HeadRegistration->CGMSBC_SUBCUE;
              

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
        $cgmsbc=$this->cgmsbc->findByAttributes(array("CGMSBC_SUBCUE"=>$HeadRegistration->CGMSBC_SUBCUE));
        $arrayEs["CGMSBC_CODDIM"]=$cgmsbc->CGMSBC_CODDIM;
        $result=$this->registration->create($arrayEs);
        $incremental = sprintf('%04d',$result->id);
        $resultTemp=Registration::find($result->id);
        $resultTemp->REGIST_NROITM=$result->id;
        $resultTemp->REGIST_ID=date('Ymd').$incremental;
         $resultTemp->save();
 
        return redirect()->route('admin.voucher.registration.edit',array("id"=>$headerId,"CGMSBC_SUBCUE=".$request->get("CGMSBC_SUBCUE")))

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
        $StmpdhTranslation = Stmpdh::where("STMPDH_DESCRP","<>","")->pluck('STMPDH_DESCRP', 'STMPDH_ARTCOD');
        $CgmsbcTranslation = Cgmsbc::pluck('CGMSBC_DESCRP', 'CGMSBC_SUBCUE');
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

        if(!$request->has("CGMSBC_SUBCUE")){
                  return redirect()->route('admin.voucher.registration.index')
            ->withError("Es necesario vincular estos vouchers con una película"); 
        } 

        $Pvmprh= new Pvmprh();
        $listPvmprh= array();
 
 
        $registration= HeadRegistration::find($id);

         $date=date('Y-m-d');
 
        return view('voucher::admin.registrations.edit', compact('registration'))
 
        ->with("REGIST_CABITM",$id)
        ->with("date",$date)
        ->with("registrationModel",$registration)
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

        return redirect()->route('admin.voucher.registration.edit',array($request->REGIST_CABITM,"CGMSBC_SUBCUE=".$request->CGMSBC_SUBCUE))
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
 
             $registrations->delete();

            return redirect()->route('admin.voucher.registration.index')
            ->withSuccess("Se han anulado los vouchers con éxito");
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
        ->route('admin.voucher.registration.edit',array("id"=>$request->get("header"),"CGMSBC_SUBCUE=".$request->get("CGMSBC_SUBCUE")))
            ->withSuccess("Se han creado el voucher con éxito");
    }

    public function searchProveedor(Request $request){
      $pvmprh= new Pvmprh();
      $searchByName=$pvmprh->searchByName($request->get("q"));
      return ["proveedores"=>$searchByName->toArray()];
    }

    public function searchCuenta(Request $request){
      $grcfor= new Grcfor();
      $searchByName=$grcfor->searchByName($request->get("q"));
       return ["comprobantes"=>$searchByName->toArray()];
    }

    public function searchProducto(Request $request){
      $stmpdh= new Stmpdh();
      $searchByName=$stmpdh->searchByName($request->get("q"));
       return ["productos"=>$searchByName->toArray()];
    }


    public function validateCuit(Request $request){
                  $pvmprh= new Pvmprh();

       $validateCuit=$pvmprh->validateCuit($request->get("cuit"));

            if($validateCuit->count()!=0){

               $nombreCuit="";
              foreach ($validateCuit as $value) {
                $nombreCuit=$value->PVMPRH_NOMBRE;
              }
                
            return response()->json(['response' => 1, 'message' => 'Este cuit ya existe y pertenece a '.$nombreCuit.', ingrese uno diferente']);
 
            }else{
              return response()->json(['response' => 2, 'message' => 'ok']);
            }
    }

    public function updateRegister($id, Request $request){
 
          $headerRegistration= new HeadRegistration();

            $pvmprhValue=$request->get("PVMPRH_NROCTA");



          if($request->has("temp_PVMPRH_NOMBRE")){
            $pvmprhValue=mt_rand(1000000000,9000000000);
            $pvmprh= new Pvmprh();
            $validateCuit=$pvmprh->validateCuit($request->get("temp_PVMPRH_NRODOC"));

            if($validateCuit->count()!=0){

               $nombreCuit="";
              foreach ($validateCuit as $value) {
                $nombreCuit=$value->PVMPRH_NOMBRE;
              }
               return redirect()
            ->route('admin.voucher.registration.edit',array("id"=>$id,"CGMSBC_SUBCUE=".$request->get("CGMSBC_SUBCUE")))
            ->withError("Este cuit ya existe y pertenece a ".$nombreCuit.", ingrese uno diferente");
            }

            $pvmprh->PVMPRH_NROCTA=$pvmprhValue;
            $pvmprh->PVMPRH_NOMBRE=$request->get("temp_PVMPRH_NOMBRE");
            $pvmprh->PVMPRH_NRODOC=$request->get("temp_PVMPRH_NRODOC");
            $pvmprh->new=1;
            $pvmprh->save();

         }


        $headRegistration=HeadRegistration::find($id);

        $marcador=1;
        if($headRegistration->PVMPRH_NROCTA!=$pvmprhValue){
          $marcador=0;
         }

        if($headRegistration->GRCFOR_CODFOR!=$request->get("GRCFOR_CODFOR")){
          $marcador=0;
 
        }

        if($headRegistration->REGIST_NROFOR!=$request->get("REGIST_NROFOR")){
          $marcador=0;
 
        }

 
        if($marcador==0){

          if($headerRegistration->getHeaderExist($pvmprhValue,$request->get("GRCFOR_CODFOR"),$request->get("REGIST_NROFOR"))->count()>0){

            return redirect()
              ->route('admin.voucher.registration.edit',array("id"=>$id,"CGMSBC_SUBCUE=".$request->get("CGMSBC_SUBCUE")))
              ->withError("Este registro esta repetido, revisar el proveedor, el tipo de comprobante o el número del comprobante");
          }


           $headRegistration->PVMPRH_NROCTA=$pvmprhValue;
          $headRegistration->REGIST_FECMOV=date("Ymd",strtotime($request->get("REGIST_FECMOV")));
          $headRegistration->GRCFOR_CODFOR=$request->get("GRCFOR_CODFOR");
          $headRegistration->REGIST_NROFOR=$request->get("REGIST_NROFOR");
          $headRegistration->save();
        }
         if($request->has("nuevo")){
                  return redirect()
                ->route('admin.voucher.registration.edit',array("id"=>$id,"CGMSBC_SUBCUE=".$request->get("CGMSBC_SUBCUE")."&nuevo=".$request->get("nuevo")))
                    ->withSuccess("Se ha guardado el voucher con éxito");
         }else{
                  return redirect()
                ->route('admin.voucher.registration.edit',array("id"=>$id,"CGMSBC_SUBCUE=".$request->get("CGMSBC_SUBCUE")))
                    ->withSuccess("Se ha guardado el voucher con éxito");
         }

    }
    


}
  