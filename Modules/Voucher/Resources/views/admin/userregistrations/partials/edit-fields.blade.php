<div class="box-body">

	 <p>{!!$userRegistrationArray["first_name"] !!} {!!$userRegistrationArray["last_name"]!!}</p> 

	<div class="form-group ">
	   {!! Form::label('USERIID', trans('voucher::userregistrations.form.userId')); !!}
	   {!! Form::text('USERIID',$userRegistrationArray["registrationId"],array("class"=>"form-control")) !!}
	   {!! Form::hidden('user_id',$userRegistrationArray["id"]) !!}
	</div>

<div class="form-group ">
	   {!! Form::label('CGMSBC_DESCRP', "Películas"); !!}
      {!! Form::select('CGMSBC_SUBCUE', $Cgmsbc, $userRegistrationArray["CGMSBC_SUBCUE"], ['class' => 'form-control']) !!}

	</div>


  
</div>
