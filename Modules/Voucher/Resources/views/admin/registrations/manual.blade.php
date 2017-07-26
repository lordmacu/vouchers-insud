@extends('layouts.master')

@section('content-header')
    <h1>
        Manual de Vouchers
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('voucher::registrations.title.registrations') }}</li>
    </ol>
@stop

@section('content')
  
   <div class="box box-primary">
    <div class="box-body">
   


      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Creación de voucher
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <p>
          Para crear un voucher primero hay que oprimir en el boton azul superior derecho, allì se presenta un formulario en donde se completa los campos de proveedor, metodo de pago, fecha de ticket tipo de comprobante y número de comprobante.

        </p>
        
        <p>
          <b>Campos Autocompletados:</b> Los campos de proveedor cuentan con la funcionalidad de autocompletar mientras se va escribiendo, asi que solo se tiene que ingresar una palabra para que se filtre el resultado indicado.
        </p>

        
        <p>
           <b>Número de comprobante:</b> este tiene que tener un formato 0000-00000000, se tiene que ingresar los primeros 4 digitos y después un guion y despues los 8 números faltantes.
        </p>
        <h4>Video Explicativo</h4>
        <video width="100%" controls>
         <source src="{{asset('/manuales/creacion-voucher.mp4')}}" type="video/mp4">
        </video>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Creación de Comprobante voucher
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <p>
         Después de crear el voucher se despliega una nueva ventana, al principio si no se ha cargado ningún item, aparecerá la ventana emergente de creación de item de voucher, si hay uno o mas voucher creados con anterioridad, el paso para crear un item es oprimir en el botón naranja "Agregar Item" debajo de los detalles del voucher y aparecerá la ventana de creación de item.
        </p>
        
        <p>
          La ventana de creación de item, tiene los campos de producto, porcentaje iva, cantidad, precio unitario, iva total y comentario del item.
        </p>

        
        <p>
           El total de iva se calcula sobre la cantidad de productos a registrar multiplicada por el precio unitario, ej: 2 productos con precio 200 y 21 de iva (21*400)/100 = 84
        </p>
        <p>
           En el comprobante se puede crear un comentario para clarificar el registro del producto.
        </p>
        <p>
           Para agregar el comprobante se tiene que oprimir el boton de agregar, la ventana de creacion desaparecerá y el comprobante se agregará a la lista de comprobantes
        </p>
        <h4>Video Explicativo</h4>
        <video width="100%" controls>
         <source src="{{asset('/manuales/creacion-item.mp4')}}" type="video/mp4">
        </video>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Edición de comprobante voucher
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <p>
         Para editar un comprobante se tiene que oprimir el boton naranja con el icono de editar por cada item.
        </p>
        
        <p>
          En la ventana de edición del comprobante se puede hacer la modificación de todos lo valores previamente agregados al comprobante.
        </p>

        
        <p>
           Para guardar se tiene que oprimir el boton de actualizar de lo contrario el botón de atras para volver a la vista general del voucher
        </p>
      
        <h4>Video Explicativo</h4>
        <video width="100%" controls>
         <source src="{{asset('/manuales/edicion-item-voucher.mp4')}}" type="video/mp4">
        </video>
      </div>
    </div>

    
  </div>


  <div class="panel panel-default">
 <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Edición de comprobante voucher
        </a>
      </h4>
    </div>

  <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        <p>
         En el formulario de creacion y modificacion del voucher puede que el proveedor no exista, en este caso en el lado derecho de la lista desplegable de proveedores hay un boton verde con un signo de mas, al oprimir aparecerá una ventana donde se podrá crear un nuevo proveedor, 
        </p>
        
        <p>
          En la ventana de creación del proveedor solo hay dos campos, una para el nombre del proveedor y otro para agregar el cuit.
        </p>

        
        <p>
           Si el cuit ingresado no es correcto apararecerá un mensaje de error, despues de que el sistema valide que el cuit no sea alla ingresado previamente y que sea valido se podrá guardar y una ves guardado se puede seguir completando la creación del voucher.
        </p>
      
        <h4>Video Explicativo</h4>
        <video width="100%" controls>
         <source src="{{asset('/manuales/creacion-proveedor-nuevo.mp4')}}" type="video/mp4">
        </video>
      </div>
    </div>
    
  </div>



  <div class="panel panel-default">
 <div class="panel-heading" role="tab" id="headingFive">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Edición de Voucher
        </a>
      </h4>
    </div>

  <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
        <p>
        En la ventana de <a href="{{route('admin.voucher.registration.index')}}">creación de vouchers</a> cada voucher tiene un boton con el icono lápiz y al oprimir en el se abre la ventana de edición donse podrá modificar todos los parametros del voucher.
        </p>
        
        <p>
          Para guardar el voucher hay dos opciones: la primera se puede guardar el voucher y regresar a la lista de vouchers, o guardar el voucher para poder crear uno nuevo.
        </p>
      
        <h4>Video Explicativo</h4>
        <video width="100%" controls>
         <source src="{{asset('/manuales/edicion-voucher.mp4')}}" type="video/mp4">
        </video>
      </div>
    </div>
    
  </div>

</div>

    </div>
  </div>
@stop

 
@section('scripts')
 
@stop
