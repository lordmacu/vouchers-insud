function validateCuit(val){

		var validateButton=$("#validarButton");
 		if(!validaCuit(val)){
            alertify.error('Verifición de número de cuit erronea');
              $("#PVMPRH_NRODOC_modal").parent().addClass("bg-danger")
              validateButton.attr('disabled','disabled');
            return false;
        }else{
              $("#PVMPRH_NRODOC_modal").parent().removeClass("bg-danger")
              validateButton.removeAttr('disabled');
        }

	$.ajax({
		data:{cuit:val},
		url:validationRegistration,
		success:function (data){
			
			if(data.response==1){
			 alertify.error(data.message);
              	$("#PVMPRH_NRODOC_modal").parent().addClass("bg-danger")
            	validateButton.attr('disabled','disabled');

			}else{
              $("#PVMPRH_NRODOC_modal").parent().removeClass("bg-danger")
              validateButton.removeAttr('disabled');

			}

		}
	})
} 

function updateRegistration(){
    console.log("aquiiii");
    $("#formupdate").submit();
}

function saveProveedor(){
        
         var PVMPRH_NOMBRE= $("#PVMPRH_NOMBRE_modal").val()
         var PVMPRH_NRODOC=$("#PVMPRH_NRODOC_modal").val()

        if(!validaCuit(PVMPRH_NRODOC)){
            alertify.error('Verifición de número de cuit erronea');
              $("#PVMPRH_NRODOC_modal").parent().addClass("bg-danger")


            return false;
        }else{
                          $("#PVMPRH_NRODOC_modal").parent().removeClass("bg-danger")

        }




          $("#temp_PVMPRH_NOMBRE").val(PVMPRH_NOMBRE)
         $("#temp_PVMPRH_NRODOC").val(PVMPRH_NRODOC)
         $("#titleProveedor").val(PVMPRH_NOMBRE)
         if(!!PVMPRH_NRODOC){
            $("#contenedor_proveedor").show()
            $("#contenedor_proveedor_principal").hide()

         }

         $("#modalDistribuidor").modal("hide");
    }


    function closeProveedor(){
   
          $("#temp_PVMPRH_NOMBRE").val("")
         $("#temp_PVMPRH_NRODOC").val("")

          $("#PVMPRH_NOMBRE_modal").val("")
         $("#PVMPRH_NRODOC_modal").val("")

         $("#contenedor_proveedor").hide()
         $("#contenedor_proveedor_principal").show()

    }


function validaCuit(sCUIT) 
{     
    var aMult = '5432765432'; 
    var aMult = aMult.split(''); 
     
    if (sCUIT && sCUIT.length == 11) 
    { 
        aCUIT = sCUIT.split(''); 
        var iResult = 0; 
        for(i = 0; i <= 9; i++) 
        { 
            iResult += aCUIT[i] * aMult[i]; 
        } 
        iResult = (iResult % 11); 
        iResult = 11 - iResult; 
         
        if (iResult == 11) iResult = 0; 
        if (iResult == 10) iResult = 9; 
         
        if (iResult == aCUIT[10]) 
        { 
            return true; 
        } 
    }     
    return false; 
} 

        $( document ).ready(function() {


        	$("#PVMPRH_NRODOC_modal").change(function (){
         		validateCuit($(this).val())
        	})

           if(nuevo){
                $("#modalForm").modal("show");
           
           }



$("#GRCFOR_CODFOR").selectize({
    valueField: 'GRCFOR_CODFOR',
    labelField: 'GRCFOR_DESCRP',
    searchField: 'GRCFOR_DESCRP',
    create: false,
    render: {
        option: function(item, escape) {
             return '<div>' +
                '<span class="title">' +
                    '<span class="name">'+item.GRCFOR_DESCRP+'</span>' +
                 '</span>' +
                 
            '</div>';
        }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: searchCuenta +"?q="+ encodeURIComponent(query),
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res.comprobantes.slice(0, 10));
            }
        });
    }
});



$('#STMPDH_ARTCOD').selectize({
    valueField: 'STMPDH_ARTCOD',
    labelField: 'STMPDH_DESCRP',
    searchField: 'STMPDH_DESCRP',
    create: false,
    render: {
        option: function(item, escape) {
             return '<div>' +
                '<span class="title">' +
                    '<span class="name">'+item.STMPDH_DESCRP+'</span>' +
                 '</span>' +
                 
            '</div>';
        }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: searchProducto +"?q="+ encodeURIComponent(query),
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res.productos.slice(0, 10));
            }
        });
    }
});

$('#PVMPRH_NROCTA').selectize({
    valueField: 'PVMPRH_NROCTA',
    labelField: 'PVMPRH_NOMBRE',
    searchField: 'PVMPRH_NOMBRE',
    create: false,
    render: {
        option: function(item, escape) {
             return '<div>' +
                '<span class="title">' +
                    '<span class="name">'+item.PVMPRH_NOMBRE+'</span>' +
                 '</span>' +
                 
            '</div>';
        }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: searchProveedor +"?q="+ encodeURIComponent(query),
            type: 'GET',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res.proveedores.slice(0, 10));
            }
        });
    }
});


        $("#REGIST_NROFOR").change(function (e){
            var valor=$("#REGIST_NROFOR").val().split("-");
           
            if(valor.length==1){
                $("#REGIST_NROFOR").val(zeroPad(valor[0],4)+"-"+zeroPad(0,8));
            }else{
                console.log();
                $("#REGIST_NROFOR").val(zeroPad(valor[0],4)+"-"+zeroPad(valor[1],8));

            }

        });

 

        $('#formupdate').on('submit', function() {
   
            if(!$("#CGMSBC_SUBCUE").val()){
              $("#CGMSBC_SUBCUE").parent().addClass("bg-danger")
              return false;
            }else{
              $("#CGMSBC_SUBCUE").parent().removeClass("bg-danger")
            }
          

           if(!$("#temp_PVMPRH_NOMBRE").val()){
                 if(!$("#PVMPRH_NROCTA").val() ){
                  $("#PVMPRH_NROCTA").parent().addClass("bg-danger")
                  return false;
                }else{
                  $("#PVMPRH_NROCTA").parent().removeClass("bg-danger")
                }
            } 

 
          
           if(!$("#GRCFOR_CODFOR").val()){
              $("#GRCFOR_CODFOR").parent().addClass("bg-danger")
              return false;
            }else{
              $("#GRCFOR_CODFOR").parent().removeClass("bg-danger")
            }
            
     
 

 


            return true;

        });


            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.voucher.registration.index') ?>" }
                ]
            });

            var cantidad=$("#REGIST_CANTID");
            var precio =$("#REGIST_IMPORT");
            var porcentajeInput=$("#porcentaje_iva");
            cantidad.change(function (){
                if(!precio.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)

                 }
            })


            precio.change(function (){
                if(!cantidad.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)
                 }
            })

            porcentajeInput.change(function (){
                if(!cantidad.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)
                 }

                if(!precio.val().length==0){
                    porcentaje=((cantidad.val()*precio.val())*porcentajeInput.val())/100;
                     $("#REGIST_IMPIVA").val(porcentaje)
                 }
            })

            $("#REGIST_CANTID").ForceNumericOnly();
            $("#porcentaje_iva").ForceNumericOnly();
            $("#REGIST_IMPORT").ForceNumericOnly();
            //$("#REGIST_NROFOR").ForceNumericOnly();

        });
     


function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}


        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });




jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;

             // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 || 
                key == 109 || 
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};




