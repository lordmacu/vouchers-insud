@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('voucher::registrations.title.edit registration') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.voucher.registration.edit',array($registration->REGIST_CABITM,'CGMSBC_SUBCUE='.$registration->CGMSBC_SUBCUE))}}">{{ trans('voucher::registrations.title.registrations') }}</a></li>
        <li class="active">{{ trans('voucher::registrations.title.edit registration') }}</li>
    </ol>
@stop

@section('styles')
    {!! Theme::script('js/vendor/ckeditor/ckeditor.js') !!}
@stop

@section('content')

  
    {!! Form::open(['route' => ['admin.voucher.registration.update',$registration->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('voucher::admin.registrations.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
 
<a class="btn btn-info pull-left btn-flat" href="{{ route('admin.voucher.registration.edit',array($registration->REGIST_CABITM,'CGMSBC_SUBCUE='.$registration->CGMSBC_SUBCUE))}}">Atras</a>

                        <button type="submit" class="btn btn-success btn-flat pull-right">{{ trans('core::core.button.update') }}</button>
                        
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
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
    </script>
@stop
