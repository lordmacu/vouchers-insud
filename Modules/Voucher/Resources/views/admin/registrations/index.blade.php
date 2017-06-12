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
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('voucher::registrations.button.create registration') }}
                    </a>
                </div>
                
                   </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th data-sortable="false">{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="true">Pelicula</th>

                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($registrations)): ?>
                            <?php foreach ($registrations as $registration): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.voucher.registration.edit', [$registration->id,'CGMSBC_CODDIM=']) }}{{ $registration->CGMSBC_CODDIM }}">
                                        {{ $registration->created_at }}
                                        
                                     </a>
                                </td>
                                <td>{{ $registration->cgmsbcs->CGMSBC_DESCRP }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.voucher.registration.edit', [$registration->id,'CGMSBC_CODDIM=']) }}{{ $registration->CGMSBC_CODDIM }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.voucher.registration.destroy', [$registration->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                                                <th>Pelicula</th>

                                <th>{{ trans('core::core.table.actions') }}</th>

                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="{{ route('admin.voucher.registration.create') }}" method="GET">
        
   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12 col-sm-4  col-lg-4">
                {!! Form::label("CGMSBC_CODDIM", trans('voucher::registrations.form.CGMSBC_CODDIM')) !!}
                {!! Form::select("CGMSBC_CODDIM", $Cgmsbc,"", ['placeholder' => trans('voucher::registrations.form.CGMSBC_CODDIM')]) !!}
            </div>

            <div class="col-xs-12 col-sm-4  col-lg-4">
                {!! Form::label("PVMPRH_NROCTA", trans('voucher::registrations.form.PVMPRH_NROCTA')) !!}
                {!! Form::select("PVMPRH_NROCTA", $Pvmprh,"", ['placeholder' => trans('voucher::registrations.form.PVMPRH_NROCTA')]) !!}
            </div>

           
        </div>
        <div class="row">
        
            <div class="col-xs-12 col-sm-4  col-lg-4">

                {!! Form::label("REGIST_FECMOV", trans('voucher::registrations.form.REGIST_FECMOV')) !!}
                {!! Form::text('REGIST_FECMOV', $date,array("class"=>"form-control datetimepicker")); !!} 
            </div>
            <div class="col-xs-12 col-sm-4  col-lg-4">
                {!! Form::label("GRCFOR_MODFOR", trans('voucher::registrations.form.GRCFOR_MODFOR')) !!}
                {!! Form::select("GRCFOR_CODFOR", $Grcfor,"", ['placeholder' => trans('voucher::registrations.form.GRCFOR_CODFOR')]) !!}
            </div>

            <div class="col-xs-12 col-sm-4  col-lg-4">
                {!! Form::label("REGIST_NROFOR", trans('voucher::registrations.form.REGIST_NROFOR')) !!}
                {!! Form::text('REGIST_NROFOR',"",array("class"=>"form-control","required"=>"true")); !!}
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.voucher.registration.create') ?>" }
                ]
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
