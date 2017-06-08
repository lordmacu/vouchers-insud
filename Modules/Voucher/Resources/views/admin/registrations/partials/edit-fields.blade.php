<div class="box-body">


    <div class="row">
      <div class="col-xs-12 col-sm-4  col-lg-4">
    		{!! Form::label("PVMPRH_NROCTA", trans('voucher::registrations.form.PVMPRH_NROCTA')) !!}
          {!! Form::select("PVMPRH_NROCTA", $Pvmprh,$registration->PVMPRH_NROCTA, ['placeholder' => trans('voucher::registrations.form.PVMPRH_NROCTA')]) !!}
      </div>

      <div class="col-xs-12 col-sm-4  col-lg-4">
         
     {!! Form::label("REGIST_FECMOV", trans('voucher::registrations.form.REGIST_FECMOV')) !!}
          {!! Form::text('REGIST_FECMOV', $registration->REGIST_FECMOV,array("class"=>"form-control datetimepicker")); !!}

      </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
  		{!! Form::label("GRCFOR_MODFOR", trans('voucher::registrations.form.GRCFOR_MODFOR')) !!}
          {!! Form::select("GRCFOR_CODFOR", $Grcfor,$registration->GRCFOR_CODFOR, ['placeholder' => trans('voucher::registrations.form.GRCFOR_CODFOR')]) !!}
      </div>



       
     

    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-4  col-lg-4">
        {!! Form::label("REGIST_NROFOR", trans('voucher::registrations.form.REGIST_NROFOR')) !!}
        {!! Form::text('REGIST_NROFOR',$registration->REGIST_NROFOR ,array("class"=>"form-control")); !!}
      </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
      	{!! Form::label("STMPDH_ARTCOD", "Producto") !!}
          {!! Form::select("STMPDH_ARTCOD", $Stmpdh,$registration->STMPDH_ARTCOD, ['placeholder' => trans('voucher::registrations.form.STMPDH_ARTCOD')]) !!}
       </div>
      
    
      
     </div>
     <div class="row">
       <div class="col-xs-12 col-sm-4  col-lg-4">
             
         {!! Form::label("REGIST_CANTID", trans('voucher::registrations.form.REGIST_CANTID')) !!}
        {!! Form::text('REGIST_CANTID', $registration->REGIST_CANTID,array("class"=>"form-control")); !!}
       </div>
       <div class="col-xs-12 col-sm-4  col-lg-4">
         {!! Form::label("REGIST_IMPORT", trans('voucher::registrations.form.REGIST_IMPORT')) !!}
        {!! Form::text('REGIST_IMPORT', $registration->REGIST_IMPORT,array("class"=>"form-control")); !!}
       </div>
        <div class="col-xs-12 col-sm-4  col-lg-4">
       {!! Form::label("REGIST_IMPIVA", trans('voucher::registrations.form.REGIST_IMPIVA')) !!}
        {!! Form::text('REGIST_IMPIVA', $registration->REGIST_IMPIVA,array("class"=>"form-control")); !!}
      </div>
     </div>
  

     {!! Form::hidden('REGIST_USERUID',$registrationId) !!}
     {!! Form::hidden('REGIST_CABITM',$registration->REGIST_CABITM) !!}
     {!! Form::hidden('CGMSBC_CODDIM',$registration->CGMSBC_CODDIM) !!}



 </div>
