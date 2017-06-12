<div class="box-body">
 
    
  
    <div class="row">
   
      <div class="col-xs-12 col-sm-6  col-lg-6">
      	{!! Form::label("STMPDH_ARTCOD", "Producto") !!}
          {!! Form::select("STMPDH_ARTCOD", $Stmpdh,"", ['placeholder' => trans('voucher::registrations.form.STMPDH_ARTCOD')]) !!}
       </div>
      <div class="col-xs-12 col-sm-6  col-lg-6">
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