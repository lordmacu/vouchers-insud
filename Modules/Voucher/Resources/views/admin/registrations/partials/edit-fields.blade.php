<div class="box-body">


    
    <div class="row">
      
      <div class="col-xs-12 col-sm-6  col-lg-6">
      	{!! Form::label("STMPDH_ARTCOD", "Producto") !!}
          {!! Form::select("STMPDH_ARTCOD", $Stmpdh,$registration->STMPDH_ARTCOD, ['placeholder' => trans('voucher::registrations.form.STMPDH_ARTCOD')]) !!}
       </div>
            <div class="col-xs-12 col-sm-6  col-lg-6">
        {!! Form::label("porcentaje_iva", "Porcentaje Iva") !!}
         <input type="text" id="porcentaje_iva" class="form-control" value="21">
       </div>
    
      
     </div>
     <div class="row">
       <div class="col-xs-12 col-sm-4  col-lg-4">
             
         {!! Form::label("REGIST_CANTID", trans('voucher::registrations.form.REGIST_CANTID')) !!}
        {!! Form::text('REGIST_CANTID', $registration->REGIST_CANTID,array("class"=>"form-control","required"=>"true")); !!}
       </div>
       <div class="col-xs-12 col-sm-4  col-lg-4">
         {!! Form::label("REGIST_IMPORT", trans('voucher::registrations.form.REGIST_IMPORT')) !!}
        {!! Form::text('REGIST_IMPORT', $registration->REGIST_IMPORT,array("class"=>"form-control","required"=>"true")); !!}
       </div>
        <div class="col-xs-12 col-sm-4  col-lg-4">
       {!! Form::label("REGIST_IMPIVA", trans('voucher::registrations.form.REGIST_IMPIVA')) !!}
        {!! Form::text('REGIST_IMPIVA', $registration->REGIST_IMPIVA,array("class"=>"form-control","readonly"=>true,"required"=>"true")); !!}
      </div>
     </div>
  

     {!! Form::hidden('REGIST_USERUID',$registrationId) !!}
     {!! Form::hidden('REGIST_CABITM',$registration->REGIST_CABITM) !!}
     {!! Form::hidden('CGMSBC_CODDIM',$registration->CGMSBC_CODDIM) !!}



 </div>


<script>
  
$('#registrationstore').on('submit', function() {
   
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