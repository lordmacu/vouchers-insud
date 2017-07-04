@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('voucher::registrations.title.create registration') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.voucher.registration.index') }}">{{ trans('voucher::registrations.title.registrations') }}</a></li>
        <li class="active">{{ trans('voucher::registrations.title.create registration') }}</li>
    </ol>
@stop

@section('styles')
    {!! Theme::script('js/vendor/ckeditor/ckeditor.js') !!}
@stop

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                 <div class="tab-content">
                    <form action="{{ route('admin.voucher.registration.update.individual',array('id'=>$registrationModel->id)) }}" id="formupdate" method="get"  >


                    <div class="row">
                        <div class="col-xs-12 col-sm-4  col-lg-4">
                            {!! Form::label("CGMSBC_SUBCUE", trans('voucher::registrations.form.CGMSBC_SUBCUE')) !!}
                            <input type="text"   class="form-control" disabled="disabled" value="{{ $registrationModel->cgmsbcs->CGMSBC_DESCRP }}">
                            <input type="hidden" name="CGMSBC_SUBCUE"  value="{!!  $registrationModel->cgmsbcs->CGMSBC_SUBCUE !!}"> 
                        </div>

                        <div class="col-xs-12 col-sm-6  col-lg-6">
                            {!! Form::label("PVMPRH_NROCTA", trans('voucher::registrations.form.PVMPRH_NROCTA')) !!}
                  


                            <div class="input-group" id="contenedor_proveedor_principal">
                                {!! Form::select("PVMPRH_NROCTA", $Pvmprh,$registrationModel->PVMPRH_NROCTA, ['placeholder' => trans('voucher::registrations.form.PVMPRH_NROCTA')]) !!}
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#modalDistribuidor" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </span>
                            </div> 
                            <div class="input-group  " style="display: none" id="contenedor_proveedor">

                              <input type="text" disabled="disabled" id="titleProveedor" class="form-control"  />

                                <span class="input-group-btn">
                                    <button class="btn btn-danger"  onclick="closeProveedor()" type="button"><i class="fa fa-close" aria-hidden="true"></i></button>
                                </span>
                            </div>

                {!! Form::hidden('temp_PVMPRH_NOMBRE', "",array("class"=>"form-control","id"=>"temp_PVMPRH_NOMBRE")); !!} 
                {!! Form::hidden('temp_PVMPRH_NRODOC', "",array("class"=>"form-control","id"=>"temp_PVMPRH_NRODOC")); !!}
                        </div>



                       
                    </div>
                    <div class="row">

                        <div class="col-xs-12 col-sm-4  col-lg-4">
                                
                            {!! Form::label("REGIST_FECMOV", trans('voucher::registrations.form.REGIST_FECMOV')) !!}
                            {!! Form::text('REGIST_FECMOV', $registrationModel->REGIST_FECMOV,array("class"=>"form-control datetimepicker")); !!} 
                        </div>
                        <div class="col-xs-12 col-sm-4  col-lg-4">
                            {!! Form::label("GRCFOR_MODFOR", trans('voucher::registrations.form.GRCFOR_MODFOR')) !!}
                            {!! Form::select("GRCFOR_CODFOR", $Grcfor,$registrationModel->GRCFOR_CODFOR, ['placeholder' => trans('voucher::registrations.form.GRCFOR_CODFOR'),"id"=>"GRCFOR_CODFOR"]) !!}
                        </div>

                        <div class="col-xs-12 col-sm-4  col-lg-4">
                            {!! Form::label("REGIST_NROFOR", trans('voucher::registrations.form.REGIST_NROFOR')) !!}
                            {!! Form::text('REGIST_NROFOR',$registrationModel->REGIST_NROFOR,array("class"=>"form-control","required"=>"true")); !!}
                        </div>
                        <div class="col-xs-12">
                        <br/>
                        @if(!$registrationModel->REGIST_NROFOR)
                            <input type="hidden" name="nuevo" value="1">
                                <button type="submit" class="btn btn-success pull-right">Guardar Voucher</button>
                        
                        <a href="{{ route('admin.voucher.registration.index') }}" class="btn btn-info">Atras</a>

                        @endif
                  


                
                        </div>
                    </div>

                      
                   </form>
                </div>
            </div>  
        </div>
    </div>

    @if($registrationModel->REGIST_NROFOR)

    
 <div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <div class="tab-content">


                <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#modalForm">
                  Agregar Item
                </button>

            <br/><br/>
                <table  class="table table-hover table-bordered ">
                    <thead>
                        <tr>
                            <th class="hidden-xs"> Código </th>
                            <th> Descripción </th>
                            <th> {{  trans('voucher::registrations.form.REGIST_CANTID') }}  </th>
                            <th> {{ trans('voucher::registrations.form.REGIST_IMPORT')}} </th>
                            <th> IVA </th>
                            <th>  </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php $iva = 0; ?>
                        <?php $cantidad = 0; ?>

                    @foreach($registration->registrations as $r)


                        <?php $total = $total+$r->REGIST_IMPORT; ?>
                        <?php $iva = $iva+$r->REGIST_IMPIVA;; ?>
                        <?php $cantidad = $cantidad+$r->REGIST_CANTID;; ?>
                        <tr>
                            <td class="hidden-xs"> {!! $r->STMPDH_ARTCOD !!}  </td>
                            <td> {!! $r->stmpdhs->STMPDH_DESCRP !!}  </td>
                            <td> {!! $r->REGIST_CANTID !!}</td>
                            <td> {!! $r->REGIST_IMPORT !!}</td>
                            <td> {!! $r->REGIST_IMPIVA !!}</td>


                            <td>
                            @if($r->REGIST_TRANSF=="N")
                                <a class="btn btn-warning btn-flat" href="{{ route('admin.voucher.registration.edit.individual', [$r->id]) }}"  ><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-flat" href="{{ route('admin.voucher.registration.destroyregistration', [$r->id,'CGMSBC_SUBCUE='.$registration->CGMSBC_SUBCUE,'header='.$REGIST_CABITM]) }}"  ><i class="fa fa-trash"></i></a>

                            @endif
                            </td>
                         </tr>
                    @endforeach
                    </tbody>
                    <thead>
                        <tr class="bg-info">
                                                    <th class="hidden-xs"></th>

                            <th> Subotal </th>
                            <th> {{ $cantidad }} </th>
                            <th> {{ $total }} </th>
                            <th> {{ $iva }} </th>
                            <th>  </th>

                        </tr>
                    </thead>
                    <thead>
                        <tr class="bg-warning">
                            <th class="hidden-xs">  </th>
                            <th></th>
                            <th></th>
                            <th> Total </th>
                            <th> {{ $total+$iva }} </th>
                            <th>  </th>

                        </tr>
                    </thead>
                </table>

             @if($registrationModel->REGIST_NROFOR)
                                     <a href="{{ route('admin.voucher.registration.index') }}" class="btn btn-info">Atras</a>

                            <button type="button" onclick="updateRegistration()" class="btn btn-success pull-right">Actualizar Voucher</button>
                        @endif
            </br>
            </br>
            </div>
        </div>
    </div>
</div>
    @endif



<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >Creación de item a voucher</h4>
      </div>
      <div class="modal-body">
         {!! Form::open(['route' => ['admin.voucher.registration.store'], 'method' => 'post','id'=>"registrationstore"]) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        @include('partials.form-tab-headers')
                        <div class="tab-content">
                            <?php $i = 0; ?>
                            @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                <?php $i++; ?>
                                <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                    @include('voucher::admin.registrations.partials.create-fields', ['lang' => $locale])
                                </div>
                            @endforeach

                            <div class="box-footer">
                                <button type="button" class="btn btn-danger pull-left btn-flat"  data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                                <button type="submit" class="btn btn-success btn-flat pull-right">Agregar</button>

                            </div>
                        </div>
                    </div> {{-- end nav-tabs-custom --}}
                </div>
            </div>
            {!! Form::close() !!}
      </div>
       
    </div>
  </div>
</div>

<div class="modal fade" style="z-index:1053" id="modalDistribuidor" tabindex="-1" role="dialog" aria-labelledby="modalDistribuidorLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalDistribuidorLabel">Creación de Proveedor</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-6">
                 <div class="form-group ">
                   {!! Form::label('PVMPRH_NOMBRE_modal', trans('voucher::pvmprhs.form.PVMPRH_NOMBRE')); !!}
                   {!! Form::text('PVMPRH_NOMBRE_modal',"",array("class"=>"form-control")) !!}
                </div>           
            </div>
            <div class="col-xs-6">

                <div class="form-group ">
                   {!! Form::label('PVMPRH_NRODOC_modal', trans('voucher::pvmprhs.form.PVMPRH_NRODOC')); !!}
                   {!! Form::text('PVMPRH_NRODOC_modal',"",array("class"=>"form-control")) !!}
                </div>
            </div> 
        </div>
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary"   onclick="saveProveedor()">Guardar</button>
      </div>
    </div>
  </div>
</div>



    @include('core::partials.delete-modal')

   
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
 

@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">

function updateRegistration(){
    console.log("aquiiii");
    $("#formupdate").submit();
}

function saveProveedor(){
        
         var PVMPRH_NOMBRE= $("#PVMPRH_NOMBRE_modal").val()
         var PVMPRH_NRODOC=$("#PVMPRH_NRODOC_modal").val()

        if(!validaCuit(PVMPRH_NRODOC)){
            alertify.error('Verifición de número de cuit erronea');
              $("#PVMPRH_NRODOC_modal").parent().addClass("bg-danger")


            return false;
        }else{
                          $("#PVMPRH_NRODOC_modal").parent().removeClass("bg-danger")

        }




          $("#temp_PVMPRH_NOMBRE").val(PVMPRH_NOMBRE)
         $("#temp_PVMPRH_NRODOC").val(PVMPRH_NRODOC)
         $("#titleProveedor").val(PVMPRH_NOMBRE)
         if(!!PVMPRH_NRODOC){
            $("#contenedor_proveedor").show()
            $("#contenedor_proveedor_principal").hide()

         }

         $("#modalDistribuidor").modal("hide");
    }


    function closeProveedor(){
   
          $("#temp_PVMPRH_NOMBRE").val("")
         $("#temp_PVMPRH_NRODOC").val("")

          $("#PVMPRH_NOMBRE_modal").val("")
         $("#PVMPRH_NRODOC_modal").val("")

         $("#contenedor_proveedor").hide()
         $("#contenedor_proveedor_principal").show()

    }


function validaCuit(sCUIT) 
{     
    var aMult = '5432765432'; 
    var aMult = aMult.split(''); 
     
    if (sCUIT && sCUIT.length == 11) 
    { 
        aCUIT = sCUIT.split(''); 
        var iResult = 0; 
        for(i = 0; i <= 9; i++) 
        { 
            iResult += aCUIT[i] * aMult[i]; 
        } 
        iResult = (iResult % 11); 
        iResult = 11 - iResult; 
         
        if (iResult == 11) iResult = 0; 
        if (iResult == 10) iResult = 9; 
         
        if (iResult == aCUIT[10]) 
        { 
            return true; 
        } 
    }     
    return false; 
} 

        $( document ).ready(function() {



            @if(app('request')->input('nuevo'))
                $("#modalForm").modal("show");
            @endif

        $("#REGIST_NROFOR").change(function (e){
            var valor=$("#REGIST_NROFOR").val().split("-");
           
            if(valor.length==1){
                $("#REGIST_NROFOR").val(zeroPad(valor[0],4)+"-"+zeroPad(0,8));
            }else{
                console.log();
                $("#REGIST_NROFOR").val(zeroPad(valor[0],4)+"-"+zeroPad(valor[1],8));

            }

        });

 

        $('#formupdate').on('submit', function() {
   
            if(!$("#CGMSBC_SUBCUE").val()){
              $("#CGMSBC_SUBCUE").parent().addClass("bg-danger")
              return false;
            }else{
              $("#CGMSBC_SUBCUE").parent().removeClass("bg-danger")
            }
          

           if(!$("#temp_PVMPRH_NOMBRE").val()){
                 if(!$("#PVMPRH_NROCTA").val() ){
                  $("#PVMPRH_NROCTA").parent().addClass("bg-danger")
                  return false;
                }else{
                  $("#PVMPRH_NROCTA").parent().removeClass("bg-danger")
                }
            } 

 
          
           if(!$("#GRCFOR_CODFOR").val()){
              $("#GRCFOR_CODFOR").parent().addClass("bg-danger")
              return false;
            }else{
              $("#GRCFOR_CODFOR").parent().removeClass("bg-danger")
            }
            
     
 

 


            return true;

        });


            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.voucher.registration.index') ?>" }
                ]
            });

            var cantidad=$("#REGIST_CANTID");
            var precio =$("#REGIST_IMPORT");
            var porcentajeInput=$("#porcentaje_iva");
            cantidad.change(function (){
                if(!precio.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)

                 }
            })


            precio.change(function (){
                if(!cantidad.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)
                 }
            })

            porcentajeInput.change(function (){
                if(!cantidad.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)
                 }

                if(!precio.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)
                 }
            })

            $("#REGIST_CANTID").ForceNumericOnly();
            $("#porcentaje_iva").ForceNumericOnly();
            $("#REGIST_IMPORT").ForceNumericOnly();
            $("#REGIST_NROFOR").ForceNumericOnly();

        });
    </script>
    <script>


function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}


        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });


        $('select').selectize({
            create: false,
            sortField: 'text'
        });


jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;

             // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 || 
                key == 109 || 
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};




    </script>
@stop
