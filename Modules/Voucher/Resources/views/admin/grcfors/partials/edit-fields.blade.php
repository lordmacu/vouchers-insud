<div class="box-body">
    <div class="form-group ">
	   {!! Form::label('GRCFOR_MODFOR', trans('voucher::grcfors.form.GRCFOR_MODFOR')); !!}
	   {!! Form::text('GRCFOR_MODFOR',$grcfor->GRCFOR_MODFOR,array("class"=>"form-control")) !!}
 	</div>

    <div class="form-group ">
	   {!! Form::label('GRCFOR_CODFOR', trans('voucher::grcfors.form.GRCFOR_CODFOR')); !!}
	   {!! Form::text('GRCFOR_CODFOR',$grcfor->GRCFOR_CODFOR,array("class"=>"form-control")) !!}
 	</div>

    <div class="form-group ">
	   {!! Form::label('GRCFOR_DESCRP', trans('voucher::grcfors.form.GRCFOR_DESCRP')); !!}
	   {!! Form::text('GRCFOR_DESCRP',$grcfor->GRCFOR_DESCRP,array("class"=>"form-control")) !!}
 	</div>
 
   
</div>
