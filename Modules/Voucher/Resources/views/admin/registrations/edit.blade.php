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


<style>
    
    .selectize-dropdown{
        z-index: 5000
    }
</style>
<script>
    
    var urlAssets="{{route('admin.voucher.registration.index')}}";
    var validationRegistration="{{route('admin.voucher.registration.validateCuit')}}"
    var searchProveedor="{{route('admin.voucher.registration.searchProveedor')}}"
    var searchCuenta="{{route('admin.voucher.registration.searchCuenta')}}"
    var searchProducto="{{route('admin.voucher.registration.searchProducto')}}"
    var insertItemVoucher="{{route('admin.voucher.registration.insertItemVoucher')}}"
    var nuevo=false;

     @if(app('request')->input('nuevo'))
                nuevo=true;
            @endif
</script>
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
                                {!! Form::select("PVMPRH_NROCTA", $pvmprhs,$registrationModel->PVMPRH_NROCTA, ['placeholder' => trans('voucher::registrations.form.PVMPRH_NROCTA')]) !!}
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
                            {!! Form::select("GRCFOR_CODFOR", $grcfors,$registrationModel->GRCFOR_CODFOR, ['placeholder' => trans('voucher::registrations.form.GRCFOR_CODFOR'),"id"=>"GRCFOR_CODFOR"]) !!}
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
                <table  class="table table-hover table-bordered " id="tableRegistrations">
                    <thead>
                        <tr>
                            <th class="hidden-xs"> Código </th>
                            <th> Descripción </th>
                            <th> {{  trans('voucher::registrations.form.REGIST_CANTID') }}  </th>
                            <th> Valor Unitario </th>
                            <th> Valor Total </th>
                            <th> IVA </th>
                            <th>  </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php $totalUnitario = 0; ?>
                        <?php $iva = 0; ?>
                        <?php $cantidad = 0; ?>

                    @foreach($registration->registrations as $r)


                        <?php $total = $total+$r->REGIST_IMPORT*$r->REGIST_CANTID ; ?>
                        <?php $totalUnitario = $totalUnitario+$r->REGIST_IMPORT; ?>
                        <?php $iva = $iva+$r->REGIST_IMPIVA;; ?>
                        <?php $cantidad = $cantidad+$r->REGIST_CANTID;; ?>
                        <tr id="tr_id_{{$r->id}}">
                            <td class="hidden-xs"> {!! $r->STMPDH_ARTCOD !!}  </td>
                            <td> {!! $r->stmpdhs->STMPDH_DESCRP !!}  </td>
                            <td> {!! $r->REGIST_CANTID !!}</td>
                            <td> {!! $r->REGIST_IMPORT !!}</td>
                            <td> {!! $r->REGIST_IMPORT*$r->REGIST_CANTID  !!}</td>
                            <td> {!! $r->REGIST_IMPIVA !!}</td>


                            <td>
                            @if($r->REGIST_TRANSF=="N")
                                <a class="btn btn-warning btn-flat" href="{{ route('admin.voucher.registration.edit.individual', [$r->id]) }}"  ><i class="fa fa-edit"></i></a>   
                                <button   type="button" class="btn btn-danger btn-flat" data-cabitm="{{$REGIST_CABITM}}" data-subcue="{{$registration->CGMSBC_SUBCUE}}" data-id="{{$r->id}}" onclick="deleteVoucher(this)"  ><i class="fa fa-trash"></i></button>

                            @endif 
                            </td> 
                         </tr>
                    @endforeach
                    </tbody>
                    <thead>
                        <tr class="bg-info">
                                                    <th class="hidden-xs"></th>
 
                            <th> Subotal </th>
                            <th id="cantidad_th"> {{ $cantidad }} </th>
                                                                                <th class="hidden-xs"></th>

                            <th id="total_th"> {{ $total }} </th>
                             <th id="iva_th"> {{ $iva }} </th>
                            <th>  </th>

                        </tr>
                    </thead>
                    <thead>
                        <tr class="bg-warning">
                            <th class="hidden-xs">  </th>
                            <th></th>
                            <th></th>
                            <th> Total + Iva </th>
                            <th id="total_iva_th"> {{ $total+$iva }} </th>
                            <th>  </th>
                            <th class="hidden-xs">  </th>
                        </tr>
                    </thead>
                </table>

                @if($registrationModel->REGIST_NROFOR)
                    <a href="{{ route('admin.voucher.registration.index') }}" class="btn btn-info">Atras</a>

                    <button type="button" onclick="updateRegistration()" class="btn btn-success pull-right">Guardar Voucher</button>
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
        <button type="button" class="btn btn-primary" id="validarButton" disabled="disabled"  onclick="saveProveedor()">Guardar</button>
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

         <script src="{{ URL::asset('js/voucher.js') }}" type="text/javascript"></script>

 

@stop
