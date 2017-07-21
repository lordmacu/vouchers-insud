<div class="box-body">
 
    
  
    <div class="row">
   
      <div class="col-xs-12 col-sm-6  col-lg-6">
        <div class="form-group">
          {!! Form::label("STMPDH_ARTCOD", "Producto") !!}
          {!! Form::select("STMPDH_ARTCOD",[],"", ['placeholder' => trans('voucher::registrations.form.STMPDH_ARTCOD')]) !!}
        </div>
      	
       </div>
      <div class="col-xs-12 col-sm-6  col-lg-6">
        <div class="form-group">
          {!! Form::label("porcentaje_iva", "Porcentaje Iva") !!}
          
           <select id="porcentaje_iva" class="form-control">
                <option>0</option>
                <option>10.5</option>
                <option>21</option>
                <option>27</option>
             </select>

        </div>
        
       </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-4  col-lg-4">
        <div class="form-group">
          {!! Form::label("REGIST_CANTID", trans('voucher::registrations.form.REGIST_CANTID')) !!}
          {!! Form::text('REGIST_CANTID', 0,array("class"=>"form-control","required"=>"true")); !!}
        </div>
         

       </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
        <div class="form-group">
          {!! Form::label("REGIST_IMPORT", "Precio Unitario") !!}
          {!! Form::text('REGIST_IMPORT',0,array("class"=>"form-control","required"=>"true")); !!}
        </div>
         
      </div>
      <div class="col-xs-12 col-sm-4  col-lg-4">
        <div class="form-group">
          {!! Form::label("REGIST_IMPIVA", "Iva Total") !!}
          {!! Form::text('REGIST_IMPIVA', 0,array("class"=>"form-control","readonly"=>true)); !!}
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="form-group">
                {!! Form::label("comentario_individual_voucher", "Comentario Comprobante") !!}
        <textarea class="form-control" placeholder="Ingresar Comentario" name="comentario_individual_voucher" id="comentario_individual_voucher"></textarea>
        </div>

      </div>
 
    </div>
     {!! Form::hidden('REGIST_USERIID',$registrationId) !!}
     {!! Form::hidden('REGIST_CABITM',$REGIST_CABITM) !!}
     {!! Form::hidden('CGMSBC_SUBCUE',$registration->CGMSBC_SUBCUE) !!}



     <script>
      var REGIST_USERUID="{{$registrationId}}";
      var REGIST_CABITM="{{$REGIST_CABITM}}";
      var CGMSBC_SUBCUE="{{$registration->CGMSBC_SUBCUE}}";

     </script>
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