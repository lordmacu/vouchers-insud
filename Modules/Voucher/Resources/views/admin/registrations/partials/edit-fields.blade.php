<div class="box-body">


    
    <div class="row">
      
      <div class="col-xs-12 col-sm-6  col-lg-6">
        <div class="form-group">
          {!! Form::label("STMPDH_ARTCOD", "Producto") !!}
          {!! Form::select("STMPDH_ARTCOD", $Stmpdh,$registration->STMPDH_ARTCOD, ['placeholder' => trans('voucher::registrations.form.STMPDH_ARTCOD')]) !!}
        </div>
          
       </div>
        <div class="col-xs-12 col-sm-6  col-lg-6">
          <div class="form-group">
            {!! Form::label("porcentaje_iva", "Porcentaje Iva") !!} 


             <select id="porcentaje_iva">
                <option value="0" @if(($registration->REGIST_IMPIVA*100)/($registration->REGIST_IMPORT*$registration->REGIST_CANTID) == 0) selected @endif>0</option>
                <option value="10.5" @if(($registration->REGIST_IMPIVA*100)/($registration->REGIST_IMPORT*$registration->REGIST_CANTID) == 10.5) selected @endif>10.5</option>
                <option value="21" @if(($registration->REGIST_IMPIVA*100)/($registration->REGIST_IMPORT*$registration->REGIST_CANTID) == 21) selected @endif>21</option>
                <option value="27" @if(($registration->REGIST_IMPIVA*100)/($registration->REGIST_IMPORT*$registration->REGIST_CANTID) == 27) selected @endif>27</option>
             </select>
           
          </div>            
        </div>
      
     </div>
     <div class="row">
       <div class="col-xs-12 col-sm-4  col-lg-4">
          <div class="form-group">
            {!! Form::label("REGIST_CANTID", trans('voucher::registrations.form.REGIST_CANTID')) !!}
            {!! Form::text('REGIST_CANTID', $registration->REGIST_CANTID,array("class"=>"form-control","required"=>"true")); !!}
          </div>
         
       </div>
       <div class="col-xs-12 col-sm-4  col-lg-4">
        <div class="form-group">
          {!! Form::label("REGIST_IMPORT", trans('voucher::registrations.form.REGIST_IMPORT')) !!}
        {!! Form::text('REGIST_IMPORT', $registration->REGIST_IMPORT,array("class"=>"form-control","required"=>"true")); !!}
        </div>
         
       </div>
        <div class="col-xs-12 col-sm-4  col-lg-4">
          <div class="form-group">
            {!! Form::label("REGIST_IMPIVA", trans('voucher::registrations.form.REGIST_IMPIVA')) !!}
          {!! Form::text('REGIST_IMPIVA', $registration->REGIST_IMPIVA,array("class"=>"form-control","readonly"=>true,"required"=>"true")); !!}
          </div>
       
      </div>
     </div>
  
      <div class="row">
        <div class="col-xs-12">
          <div class="form-group">
          {!! Form::label("comentario_individual_voucher", "Comentario Comprobante") !!}
          <textarea class="form-control" placeholder="Ingresar Comentario" name="comentario_individual_voucher" id="comentario_individual_voucher">{{$registration->comentario_individual_voucher}}</textarea>
          </div>
        </div>
      </div>
     {!! Form::hidden('REGIST_USERUID',$registrationId) !!}
     {!! Form::hidden('REGIST_CABITM',$registration->REGIST_CABITM) !!}
     {!! Form::hidden('CGMSBC_SUBCUE',$registration->CGMSBC_SUBCUE) !!}


 </div>
 