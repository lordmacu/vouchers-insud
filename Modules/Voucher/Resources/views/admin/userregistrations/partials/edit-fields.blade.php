<div class="box-body">

	 <p>{!!$userRegistrationArray["first_name"] !!} {!!$userRegistrationArray["last_name"]!!}</p> 

	<div class="form-group ">
	   {!! Form::label('USERIID', trans('voucher::userregistrations.form.userId')); !!}
	   {!! Form::text('USERIID',$userRegistrationArray["registrationId"],array("class"=>"form-control")) !!}
	   {!! Form::hidden('user_id',$userRegistrationArray["id"]) !!}
	</div>

  
</div>
