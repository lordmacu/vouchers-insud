function validateCuit(val) {

    var validateButton = $("#validarButton");
    if (!validaCuit(val)) {
        alertify.error('Verifición de número de cuit erronea');
        $("#PVMPRH_NRODOC_modal").parent().addClass("bg-danger")
        validateButton.attr('disabled', 'disabled');
        return false;
    } else {
        $("#PVMPRH_NRODOC_modal").parent().removeClass("bg-danger")
        validateButton.removeAttr('disabled');
    }

    $.ajax({
        data: {
            cuit: val
        },
        url: validationRegistration,
        success: function(data) {

            if (data.response == 1) {
                alertify.error(data.message);
                $("#PVMPRH_NRODOC_modal").parent().addClass("bg-danger")
                validateButton.attr('disabled', 'disabled');

            } else {
                $("#PVMPRH_NRODOC_modal").parent().removeClass("bg-danger")
                validateButton.removeAttr('disabled');

            }

        }
    })
}


function deleteVoucher(datainput) {



    $.ajax({
        data: {
            CGMSBC_SUBCUE: $(datainput).data("subcue"),
            header: $(datainput).data("cabitm")
        },
        url: urlAssets + "/" + $(datainput).data("id") + "/delete",
        success: function(data) {
            $("#tr_id_" + $(datainput).data("id")).remove();

            alertify.success("Se ha eliminado el voucher con éxito");
            $("#cantidad_th").html(data.cantidad);
            $("#total_th").html(data.totales);
            $("#iva_th").html(data.iva);
            $("#total_iva_th").html((data.totales + data.iva).toFixed(2));

        }
    })
}

function updatenewRegistration() {
    $("#nuevosubmit").val(1);
    updateRegistration();

}

function updateRegistration() {
    $("#formupdate").submit();
}

function saveProveedor() {

    var PVMPRH_NOMBRE = $("#PVMPRH_NOMBRE_modal").val()
    var PVMPRH_NRODOC = $("#PVMPRH_NRODOC_modal").val()

    if (!validaCuit(PVMPRH_NRODOC)) {
        alertify.error('Verifición de número de cuit erronea');
        $("#PVMPRH_NRODOC_modal").parent().addClass("bg-danger")


        return false;
    } else {
        $("#PVMPRH_NRODOC_modal").parent().removeClass("bg-danger")

    }




    $("#temp_PVMPRH_NOMBRE").val(PVMPRH_NOMBRE)
    $("#temp_PVMPRH_NRODOC").val(PVMPRH_NRODOC)
    $("#titleProveedor").val(PVMPRH_NOMBRE)
    if (!!PVMPRH_NRODOC) {
        $("#contenedor_proveedor").show()
        $("#contenedor_proveedor_principal").hide()

    }

    $("#modalDistribuidor").modal("hide");
}


function closeProveedor() {

    $("#temp_PVMPRH_NOMBRE").val("")
    $("#temp_PVMPRH_NRODOC").val("")

    $("#PVMPRH_NOMBRE_modal").val("")
    $("#PVMPRH_NRODOC_modal").val("")

    $("#contenedor_proveedor").hide()
    $("#contenedor_proveedor_principal").show()

}



function validaCuit(sCUIT) {
    var aMult = '5432765432';
    var aMult = aMult.split('');

    if (sCUIT && sCUIT.length == 11) {
        aCUIT = sCUIT.split('');
        var iResult = 0;
        for (i = 0; i <= 9; i++) {
            iResult += aCUIT[i] * aMult[i];
        }
        iResult = (iResult % 11);
        iResult = 11 - iResult;

        if (iResult == 11) iResult = 0;
        if (iResult == 10) iResult = 9;

        if (iResult == aCUIT[10]) {
            return true;
        }
    }
    return false;
}

$(document).ready(function() {
            $('.datetimepicker').datetimepicker({
                format: 'YYYYMMDD',
                format: 'YYYY-MM-DD'
            });



    $('#registrationstore').on('submit', function() {

        if (!$("#STMPDH_ARTCOD").val()) {
            $("#STMPDH_ARTCOD").parent().addClass("bg-danger")
            return false;
        } else {
            $("#STMPDH_ARTCOD").parent().removeClass("bg-danger")
        }




        if (!$("#porcentaje_iva").val()) {
            $("#porcentaje_iva").parent().addClass("bg-danger")
            return false;
        } else {
            $("#porcentaje_iva").parent().removeClass("bg-danger")
        }



        if (!$("#REGIST_CANTID").val() || $("#REGIST_CANTID").val() == 0) {
            $("#REGIST_CANTID").parent().addClass("bg-danger")
            return false;
        } else {
            $("#REGIST_CANTID").parent().removeClass("bg-danger")
        }




        if (!$("#REGIST_IMPORT").val() || $("#REGIST_IMPORT").val() == 0) {
            $("#REGIST_IMPORT").parent().addClass("bg-danger")
            return false;
        } else {
            $("#REGIST_IMPORT").parent().removeClass("bg-danger")
        }

        sendItemVoucher($("#STMPDH_ARTCOD").val(), $("#porcentaje_iva").val(), $("#REGIST_CANTID").val(), $("#REGIST_IMPORT").val(), $("#REGIST_IMPIVA").val());

        return false;

    });

    function round(value, exp) {
        if (typeof exp === 'undefined' || +exp === 0)
            return Math.round(value);

        value = +value;
        exp = +exp;

        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
            return NaN;

        // Shift
        value = value.toString().split('e');
        value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }

    function sendItemVoucher(STMPDH_ARTCOD, porcentaje_iva, REGIST_CANTID, REGIST_IMPORT, REGIST_IMPIVA) {
        $.ajax({
            data: {
                STMPDH_ARTCOD: STMPDH_ARTCOD,
                porcentaje_iva: porcentaje_iva,
                REGIST_CANTID: REGIST_CANTID,
                REGIST_IMPORT: REGIST_IMPORT,
                REGIST_USERIID: REGIST_USERUID,
                REGIST_CABITM: REGIST_CABITM,
                CGMSBC_SUBCUE: CGMSBC_SUBCUE,
                REGIST_IMPIVA: REGIST_IMPIVA
            },
            url: insertItemVoucher,
            success: function(data) {

                $("#tableRegistrations tbody").append('<tr id="tr_id_' + data.id.id + '"><td class="hidden-xs"> ' + STMPDH_ARTCOD + '  </td><td> ' + data.producto[0].STMPDH_DESCRP + '  </td><td> ' + REGIST_CANTID + ' </td><td>' + round(REGIST_IMPORT, 2) + '</td><td> ' + round(REGIST_IMPORT * REGIST_CANTID, 2) + '</td><td> ' + round(REGIST_IMPIVA, 2) + ' </td><td><a class="btn btn-warning btn-flat" href="' + urlAssets + '/' + data.id.id + '/editindividual"><i class="fa fa-edit"></i></a> <button type="button" class="btn btn-danger btn-flat" data-cabitm="' + REGIST_CABITM + '" data-subcue="' + CGMSBC_SUBCUE + '" data-id="' + data.id.id + '" onclick="deleteVoucher(this)"><i class="fa fa-trash"></i></button></td></tr>');
                $("#modalForm").modal("hide");
                alertify.success("Se ha creado el voucher con exito");
                $("#cantidad_th").html(data.cantidad);
                $("#total_th").html(data.total);
                $("#iva_th").html(data.iva);
                $("#total_iva_th").html((data.total + data.iva).toFixed(2));

                $("#REGIST_CANTID").val(0);
                $("#REGIST_IMPORT").val(0);
                $("#REGIST_IMPIVA").val(0);

            }
        })
    }

    $("#PVMPRH_NRODOC_modal").change(function() {
        validateCuit($(this).val())
    })

    if (nuevo) {
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
                    '<span class="name">' + item.GRCFOR_DESCRP + '</span>' +
                    '</span>' +

                    '</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: searchCuenta + "?q=" + encodeURIComponent(query),
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


    $('.selectize').selectize();

    $('#STMPDH_ARTCOD').selectize({
        valueField: 'STMPDH_ARTCOD',
        labelField: 'STMPDH_DESCRP',
        searchField: 'STMPDH_DESCRP',
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>' +
                    '<span class="title">' +
                    '<span class="name">' + item.STMPDH_DESCRP + '</span>' +
                    '</span>' +

                    '</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: searchProducto + "?q=" + encodeURIComponent(query),
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
                    '<span class="name">' + item.PVMPRH_NOMBRE + '</span>' +
                    '</span>' +

                    '</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: searchProveedor + "?q=" + encodeURIComponent(query),
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


    $(document).ready(function() {



        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    });




    $("#REGIST_NROFOR").change(function(e) {
        var valor = $("#REGIST_NROFOR").val().split("-");

        if (valor.length == 1) {
            $("#REGIST_NROFOR").val(zeroPad(valor[0], 4) + "-" + zeroPad(0, 8));
        } else {
            $("#REGIST_NROFOR").val(zeroPad(valor[0], 4) + "-" + zeroPad(valor[1], 8));

        }

    });



    $('#formupdate').on('submit', function() {

        if (!$("#CGMSBC_SUBCUE").val()) {
            $("#CGMSBC_SUBCUE").parent().addClass("bg-danger")
            return false;
        } else {
            $("#CGMSBC_SUBCUE").parent().removeClass("bg-danger")
        }


        if (!$("#temp_PVMPRH_NOMBRE").val()) {
            if (!$("#PVMPRH_NROCTA").val()) {
                $("#PVMPRH_NROCTA").parent().addClass("bg-danger")
                return false;
            } else {
                $("#PVMPRH_NROCTA").parent().removeClass("bg-danger")
            }
        }



        if (!$("#GRCFOR_CODFOR").val()) {
            $("#GRCFOR_CODFOR").parent().addClass("bg-danger")
            return false;
        } else {
            $("#GRCFOR_CODFOR").parent().removeClass("bg-danger")
        }



        if (!$("#payment_method").val()) {
            $("#payment_method").parent().addClass("bg-danger")
            return false;
        } else {
            $("#payment_method").parent().removeClass("bg-danger")
        }
        return true;

    });


    $(document).keypressAction({
        actions: [{
            key: 'b',
            route: "<?= route('admin.voucher.registration.index') ?>"
        }]
    });

    var cantidad = $("#REGIST_CANTID");
    var precio = $("#REGIST_IMPORT");
    var porcentajeInput = $("#porcentaje_iva");
    cantidad.change(function() {
        if (!precio.val().length == 0) {
            porcentaje = ((cantidad.val() * precio.val()) * porcentajeInput.val()) / 100;
            $("#REGIST_IMPIVA").val(porcentaje)

        }
    })


    precio.change(function() {
        if (!cantidad.val().length == 0) {
            porcentaje = ((cantidad.val() * precio.val()) * porcentajeInput.val()) / 100;
            $("#REGIST_IMPIVA").val(porcentaje)
        }
    })

    porcentajeInput.change(function() {
        if (!cantidad.val().length == 0) {
            porcentaje = ((cantidad.val() * precio.val()) * porcentajeInput.val()) / 100;
            $("#REGIST_IMPIVA").val(porcentaje)
        }

        if (!precio.val().length == 0) {
            porcentaje = ((cantidad.val() * precio.val()) * porcentajeInput.val()) / 100;
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




jQuery.fn.ForceNumericOnly =
    function() {
        return this.each(function() {
            $(this).keydown(function(e) {
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