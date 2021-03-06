@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('voucher::registrations.title.registrations') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('voucher::registrations.title.registrations') }}</li>
    </ol>
@stop

@section('content')


 
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
            <div class="col-xs-12" style="margin-bottom: 10px">
              
               <a class="btn btn-warning" href="{{route('admin.voucher.registration.manual')}}">Manual de Uso <i class="fa fa-question-circle" aria-hidden="true"></i></a>
              @if(app('request')->input('old')==1)
                           <a class="btn btn-default" href="{{route('admin.voucher.registration.index')}}">Voucher activos <i class="fa fa-check" aria-hidden="true"></i></a>

              @else
                    <a class="btn btn-default" href="{{route('admin.voucher.registration.index',array("old"=>true))}}">Voucher Rendidos <i class="fa fa-archive" aria-hidden="true"></i></a>

              @endif

                <div class="btn-group pull-right" >
                   
                @if($CGMSBC_SUBCUE=="0")
                    <a type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('voucher::registrations.button.create registration') }}
                    </a>
                @else
                    <a type="button" class="btn btn-primary " href="{{ route('admin.voucher.registration.create') }}?CGMSBC_SUBCUE={{$CGMSBC_SUBCUE}}" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('voucher::registrations.button.create registration') }}
                    </a>
                @endif 

                </div>
                            </div>

                   </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th data-sortable="true">Proveedor</th>
                                <th data-sortable="true">Película</th>
                               <th data-sortable="false">Total</th>
                               <th data-sortable="false">Total + iva</th>

                                 <th data-sortable="false">{{ trans('core::core.table.created at') }}</th>

                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($registrations)):
                            $totalIva=0;
                             ?>
                            <?php foreach ($registrations as $registration): ?>

                              @if($registration->registrations->count()!=0 || $registration->PVMPRH_NROCTA)
                            <tr>

                                 @if($registration->pvmprhs)<td>{{  $registration->pvmprhs->PVMPRH_NOMBRE}}</td> @else <td></td>@endif
                                 <td>{{ $registration->cgmsbcs->CGMSBC_DESCRP}}</td>
                                 <td>${{ $registration->registrationsSum(2)}}</td>
                                 <?php
                                 $totalIva=$registration->registrationsSum(1)+$totalIva;
                                  ?>
                                 <td>${{ $registration->registrationsSum(1)}}</td>
                                 <td>
                                  @if($registration->status==1)
                                    <a href="{{ route('admin.voucher.registration.edit', [$registration->id,'CGMSBC_SUBCUE=']) }}{{ $registration->CGMSBC_SUBCUE }}">
                                        {{ $registration->created_at }}

                                        
                                     </a>
                                     @else
                                      {{ $registration->created_at }}
                                     @endif
                                </td>
                                <td>
                                @if($registration->status==1)
                                    <div class="btn-group">
                                        <a href="{{ route('admin.voucher.registration.edit', [$registration->id,'CGMSBC_SUBCUE=']) }}{{ $registration->CGMSBC_SUBCUE }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.voucher.registration.destroy', [$registration->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            
                        </table>
                        <!-- /.box-body -->
                        @if(app('request')->input('old')!=1)
                        <b>Suma de Total + Iva = ${{$totalIva}}</b>
                        @endif
                    </div>
                </div>
                <!-- /.box -->
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="{{ route('admin.voucher.registration.create') }}" id="formcreacion" method="GET">
        
   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12 col-sm-4  col-lg-4">
                {!! Form::label("CGMSBC_SUBCUE", trans('voucher::registrations.form.CGMSBC_SUBCUE')) !!}
                {!! Form::select("CGMSBC_SUBCUE", $Cgmsbc,"", ['placeholder' => trans('voucher::registrations.form.CGMSBC_SUBCUE')]) !!}
            </div>

        

           
        </div>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Siguiente</button>
      </div>
       </form>
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
        <dt><code>c</code></dt>
        <dd>{{ trans('voucher::registrations.title.create registration') }}</dd>
    </dl>
@stop

@section('scripts')


         <script src="{{ URL::asset('js/jspdf.js') }}" type="text/javascript"></script>
         <script src="{{ URL::asset('js/from_html.js') }}" type="text/javascript"></script>
         <script src="{{ URL::asset('js/split_text_to_size.js') }}" type="text/javascript"></script>
         <script src="{{ URL::asset('js/standard_fonts_metrics.js') }}" type="text/javascript"></script>

 


    <script type="text/javascript">
   
  @if(Request::has('new'))
   @if($CGMSBC_SUBCUE=="0")
    $("#myModal").modal("show")

   @else
    window.location="{{ route('admin.voucher.registration.create') }}?CGMSBC_SUBCUE={{$CGMSBC_SUBCUE}}";

   @endif


  @endif

 


function demoFromHTML() {
var doc = new jsPDF("landscape", "mm", "a4");
doc.setFontSize(22);
doc.text(20, 20, 'Example');
doc.output('dataurlnewwindow', {})

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
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.voucher.registration.create') ?>" }
                ]
            });



        $('#formcreacion').on('submit', function() {
   
            if(!$("#CGMSBC_SUBCUE").val()){
              $("#CGMSBC_SUBCUE").parent().addClass("bg-danger")
              return false;
            }else{
              $("#CGMSBC_SUBCUE").parent().removeClass("bg-danger")
            }
            return true;

        });

        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                } 
            });
        });



        $('select').selectize({
            create: true,
            sortField: 'text'
        });
    </script>
@stop
