@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('voucher::rendicions.title.rendicions') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('voucher::rendicions.title.rendicions') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="javascript:void(0)" onclick="generateRendition()" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('voucher::rendicions.button.create rendicion') }}
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
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th  >Ruta de rendición</th>
                               <!-- <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($rendicions)): ?>
                            <?php foreach ($rendicions as $rendicion): ?>
                            <tr>
                                <td>
                                     {{ $rendicion->created_at }}
                                </td>
                                <td>
                                    <a href="{{ asset($rendicion->url) }}" target="_blank">
                                        {{ asset($rendicion->url) }}
                                    </a>
                                </td>
                               <!-- <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.voucher.rendicion.edit', [$rendicion->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.voucher.rendicion.destroy', [$rendicion->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>-->
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('core::core.table.created at') }}</th>
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
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('voucher::rendicions.title.create rendicion') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">

    var urlAssets="{{asset('')}}";

    function generateRendition(){

            alertify.set({ labels: { ok: "Aceptar", cancel: "Cancelar" } });
            alertify.confirm("¿Estas seguro que quieres hacer esta rendición?", function (e) {
               if (e) {
                 $.ajax({
                        url:"{{ route('admin.voucher.rendicion.create') }}",
                        success:function (data){
                            if(data==0){
                    alertify.error('No hay mas rendiciones para hacer en el momento');
                            }else{
                    alertify.success('Se ha creado la rendición');
                                window.open(urlAssets+"/"+data);
                                setTimeout(function () {
                                    window.location='';

                                }, 7000);
                            }
 
                        }
                    });
                } 
            });
    }

        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.voucher.rendicion.create') ?>" }
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
    </script>
@stop
