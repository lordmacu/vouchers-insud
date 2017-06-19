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
                    <form action="{{ route('admin.voucher.registration.update.individual',array('id'=>$registrationModel->id)) }}" id="formupdate" method="get">


                    <div class="row">
                        <div class="col-xs-12 col-sm-4  col-lg-4">
                            {!! Form::label("CGMSBC_CODDIM", trans('voucher::registrations.form.CGMSBC_CODDIM')) !!}
                            {!! Form::select("CGMSBC_CODDIM", $Cgmsbc,$registrationModel->CGMSBC_CODDIM, ['placeholder' => trans('voucher::registrations.form.CGMSBC_CODDIM')]) !!}
                        </div>

                        <div class="col-xs-12 col-sm-4  col-lg-4">
                            {!! Form::label("PVMPRH_NROCTA", trans('voucher::registrations.form.PVMPRH_NROCTA')) !!}
                            {!! Form::select("PVMPRH_NROCTA", $Pvmprh,$registrationModel->PVMPRH_NROCTA, ['placeholder' => trans('voucher::registrations.form.PVMPRH_NROCTA')]) !!}
                        </div>

                       
                    </div>
                    <div class="row">

                        <div class="col-xs-12 col-sm-4  col-lg-4">

                            {!! Form::label("REGIST_FECMOV", trans('voucher::registrations.form.REGIST_FECMOV')) !!}
                            {!! Form::text('REGIST_FECMOV', $date,array("class"=>"form-control datetimepicker")); !!} 
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
                            <button type="submit" class="btn btn-default pull-left">Actualizar Voucher</button>
                        

                        </div>
                    </div>

                      
                   </form>
                </div>
            </div>  
        </div>
    </div>
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
                            <th> Comprobante </th>
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
                            <td> {!! $r->REGIST_NROFOR !!}</td>
                            <td> {!! $r->REGIST_CANTID !!}</td>
                            <td> {!! $r->REGIST_IMPORT !!}</td>
                            <td> {!! $r->REGIST_IMPIVA !!}</td>


                            <td>
                            @if($r->REGIST_TRANSF=="N")
                                <a class="btn btn-warning btn-flat" href="{{ route('admin.voucher.registration.edit.individual', [$r->id]) }}"  ><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-flat" href="{{ route('admin.voucher.registration.destroyregistration', [$r->id,'CGMSBC_CODDIM='.$CGMSBC_CODDIM,'header='.$REGIST_CABITM]) }}"  ><i class="fa fa-trash"></i></a>

                               


                            @endif
                            </td>
                         </tr>
                    @endforeach
                    </tbody>
                    <thead>
                        <tr class="bg-info">
                            <th> Subotal </th>
                            <th> {{ $cantidad }} </th>
                            <th> {{ $total }} </th>
                            <th> {{ $iva }} </th>
                            <th>  </th>

                        </tr>
                    </thead>
                    <thead>
                        <tr class="bg-warning">
                            <th>  </th>
                            <th></th>
                            <th> Total </th>
                            <th> {{ $total+$iva }} </th>
                            <th>  </th>

                        </tr>
                    </thead>
                </table>


              <div class="row">
                  
                <div class="col-xs-12">
                    <a type="button" href="{{ route('admin.voucher.registration.index') }}" class="btn btn-success pull-right"  >
                    Guardar
                    </a>
                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-method="GET"  data-action-verb="GET" data-action-target="{{ route('admin.voucher.registration.destroy', [$REGIST_CABITM]) }}"><i class="fa fa-trash"></i> Anular</button>
                </div>
              </div>

            </div>
        </div>
    </div>
  </div>

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
                                <button type="submit" class="btn btn-primary btn-flat">Agregar</button>
                                <button type="button" class="btn btn-danger pull-right btn-flat"  data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
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


        $( document ).ready(function() {
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
