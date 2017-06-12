<div class="box-body">
  <div class="row">
    <div class="col-xs-12 col-sm-4  col-lg-4">
        {!! Form::label("PVMPRH_NROCTA", trans('voucher::registrations.form.PVMPRH_NROCTA')) !!}
          {!! Form::select("PVMPRH_NROCTA", $Pvmprh,"", ['placeholder' => trans('voucher::registrations.form.PVMPRH_NROCTA')]) !!}
      </div>

      <div class="col-xs-12 col-sm-4  col-lg-4">
 
        {!! Form::label("REGIST_FECMOV", trans('voucher::registrations.form.REGIST_FECMOV')) !!}
        {!! Form::text('REGIST_FECMOV', $date,array("class"=>"form-control datetimepicker")); !!} 
      </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
      {!! Form::label("GRCFOR_MODFOR", trans('voucher::registrations.form.GRCFOR_MODFOR')) !!}
          {!! Form::select("GRCFOR_CODFOR", $Grcfor,"", ['placeholder' => trans('voucher::registrations.form.GRCFOR_CODFOR')]) !!}
      </div>
  </div>
    
  
    <div class="row">
      <div class="col-xs-12 col-sm-4  col-lg-4">

         {!! Form::label("REGIST_NROFOR", trans('voucher::registrations.form.REGIST_NROFOR')) !!}
        {!! Form::text('REGIST_NROFOR',"",array("class"=>"form-control","required"=>"true")); !!}
      </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
      	{!! Form::label("STMPDH_ARTCOD", "Producto") !!}
          {!! Form::select("STMPDH_ARTCOD", $Stmpdh,"", ['placeholder' => trans('voucher::registrations.form.STMPDH_ARTCOD')]) !!}
       </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
        {!! Form::label("porcentaje_iva", "Porcentaje Iva") !!}
        {!! Form::text('porcentaje_iva',21,array("class"=>"form-control","required"=>"true")); !!}
       </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-4  col-lg-4">
     
         {!! Form::label("REGIST_CANTID", trans('voucher::registrations.form.REGIST_CANTID')) !!}
        {!! Form::text('REGIST_CANTID', 0,array("class"=>"form-control","required"=>"true")); !!}

       </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
         {!! Form::label("REGIST_IMPORT", trans('voucher::registrations.form.REGIST_IMPORT')) !!}
        {!! Form::text('REGIST_IMPORT',0,array("class"=>"form-control","required"=>"true")); !!}
      </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
        {!! Form::label("REGIST_IMPIVA", trans('voucher::registrations.form.REGIST_IMPIVA')) !!}
        {!! Form::text('REGIST_IMPIVA', 0,array("class"=>"form-control","readonly"=>true)); !!}
      </div>
    </div>
     {!! Form::hidden('REGIST_USERIID',$registrationId) !!}
     {!! Form::hidden('REGIST_CABITM',$REGIST_CABITM) !!}
     {!! Form::hidden('CGMSBC_CODDIM',$CGMSBC_CODDIM) !!}



 </div>



<script>
  
$('form').on('submit', function() {
   
    if(!$("#PVMPRH_NROCTA").val()){
      $("#PVMPRH_NROCTA").parent().addClass("bg-danger")
      return false;
    }else{
      $("#PVMPRH_NROCTA").parent().removeClass("bg-danger")
    }


    if(!$("#REGIST_FECMOV").val()){
      $("#REGIST_FECMOV").parent().addClass("bg-danger")
      return false;
    }else{
      $("#REGIST_FECMOV").parent().removeClass("bg-danger")
    }
 
    if($("#GRCFOR_CODFOR").val()===""){
          console.log("aqui");

      $("#GRCFOR_CODFOR").parent().addClass("bg-danger")
      return false;
    }else{
      $("#GRCFOR_CODFOR").parent().removeClass("bg-danger")
    }

        if(!$("#REGIST_NROFOR").val()){
      $("#REGIST_NROFOR").parent().addClass("bg-danger")
      return false;
    }else{
      $("#REGIST_NROFOR").parent().removeClass("bg-danger")
    }



    if(!$("#STMPDH_ARTCOD").val()){
      $("#STMPDH_ARTCOD").parent().addClass("bg-danger")
      return false;
    }else{
      $("#STMPDH_ARTCOD").parent().removeClass("bg-danger")
    }

    if(!$("#porcentaje_iva").val() ){
      $("#porcentaje_iva").parent().addClass("bg-danger")
      return false;
    }else{
      $("#porcentaje_iva").parent().removeClass("bg-danger")
    }



    if(!$("#REGIST_CANTID").val()  || $("#REGIST_CANTID").val() == 0 ){
      $("#REGIST_CANTID").parent().addClass("bg-danger")
      return false;
    }else{
      $("#REGIST_CANTID").parent().removeClass("bg-danger")
    }

    if(!$("#REGIST_IMPORT").val()  || $("#REGIST_IMPORT").val() == 0 ){
      $("#REGIST_IMPORT").parent().addClass("bg-danger")
      return false;
    }else{
      $("#REGIST_IMPORT").parent().removeClass("bg-danger")
    }

return true;

});

</script>