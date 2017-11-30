// Some gobal vars
var spinner = '<div class="text-center"><i class="fa fa-spinner fa-cog fa-3x fa-fw"></i> <span class="sr-only">Cargando...</span></div>';
var ajaxError = '<i class="fa fa-warning text-warning"></i> Error al cargar los datos!';
var current_url;

// To make Pace works on Ajax calls
$(document).ajaxStart(function () {
    Pace.restart();
});

$(document).ajaxComplete(function (){
    // DataTable
    if ( ! $.fn.DataTable.isDataTable( '.data-table' ) ) {
        $('.data-table').DataTable({"language":{ "url":window.location.href+"public/dist/json/Spanish.json"}});
    }

    // Bootstrap switch
    $(".flip-switch").bootstrapSwitch({onText:"Activo",offText:"Inactivo",onColor:"primary",offColor:"default"});
    $(".flip-switch2").bootstrapSwitch({
        onText: "Diario",
        offText: "Mensual",
        onColor: "primary",
        offColor: "default"
    });

    // Bootstrap datetimepicker
    $(".form_datetime").datetimepicker({
        language: "es",
        todayBtn: true,
        todayHighlight: true,
        forceParse: 0,
        autoclose: true,
        startView: 2
    });

    // Bootstrap datepicker
    $(".form_date").datetimepicker({
        language: "es",
        todayBtn: true,
        todayHighlight: true,
        forceParse: 0,
        autoclose: true,
        startView: 2
    });
});


$('.ajax').click(function () {
    current_url = $(this);
    var header = '<h1> ' + current_url.data('title') + ' <small>' + current_url.data('sub') + '</small> </h1>'+
        '<ol class="breadcrumb">'+
        '<li><a href="' + window.location.href + '"><i class="fa fa-home"></i> Inicio</a></li>'+
        ((current_url.data('parent') != 0) ? '<li>' + current_url.data('parent') + '</li>' : '')+
        '<li class="active">' + current_url.data('title') + '</li>'+
        '</ol>';
    $.ajax({
        url: window.location.href + current_url.data('link'),
        success: function (result) {
            $('title').html('..:: '+ current_url.data('title') + ' | SIMCOT ::..');
            $('.content-header').html(header);
            $('.content').html(result);
        }
    })
});

// Open operational modal
$('#mDialog').on('show.bs.modal', function (event){
    var button = $(event.relatedTarget);
    var mFuncion = button.data('mfuncion');
    var mModel = button.data('mmodel');
    var mId = (button.data('mid')) ? button.data('mid') : 0;
    var mSize = (button.data('msize')) ? button.data('msize') : 'md';
    var mTitle = button.data('mtitle');
    var modal = $(this);

    if (mFuncion && mModel) {
        $.ajax({
            url: window.location.href + 'requested.php',
            type: 'POST',
            dataType: "JSON",
            data: {
                function: mFuncion,
                model: mModel,
                id: mId
            },
            beforeSend: function () {
                modal.find('.modal-dialog').attr('class', 'modal-dialog modal-' + mSize);
                modal.find('.modal-title').html('<h3 style="margin: 0">' + mTitle + '</h3>');
                modal.find('.modal-body').html(spinner);
            },
            success: function (data) {
                modal.find('.modal-body').html(data.mBody);
                modal.find('.modal-footer').html(data.mFooter);
            },
            error: function () {
                modal.find('.modal-body').html(ajaxError);
                modal.find('.modal-footer').html('');
            }
        });
    }
});

function submitForm(from, toDir, toElement, reload, checkForm){
    var form = $('#' + from);
    var emptyFields = false;

    if (checkForm) {
        form.serialize().split('&').forEach(function (v) {
            var field = v.split('=');
            if (field[0] !== 'q' && field[1] === '') {
                emptyFields = true;
            }
        });
    }

    if (!emptyFields) {
        $.ajax({
            url: window.location.href + toDir,
            type: 'POST',
            data: {
                form: form.serializeArray()
            },
            beforeSend: function () {
                waitingDialog.show();
            },
            success: function (data) {
                if (data != -1) {
                    if (!(toElement === ''))
                        $('#' + toElement).html(data);
                    $('#mDialog').modal('hide');
                    $.notify("Operación realizada exitosamente.", {
                        className: "success",
                        globalPosition: "right bottom"
                    });
                    if (reload)
                        current_url.click();
                } else {
                    $.notify("Ocurrio un error al guardar el registro.", {
                        className: "error",
                        globalPosition: "right bottom"
                    });
                }
                waitingDialog.hide();
            }
        });
    }

    return false;
}