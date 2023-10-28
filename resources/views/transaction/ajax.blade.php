<script>
$(function () {
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('transaction.index') }}",
        columns: [
            {data: 'DT_RowIndex' , name: 'id'},
            {data: 'plat', name: 'plat'},
            {data: 'name', name: 'name'},
            {data: 'merk_car', name: 'merk_car'},
            {data: 'total_price', name: 'total_price'},
            {data: 'user_in', name: 'user_in'},
            {data: 'user_out', name: 'user_out'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
}); 

$('#washCar').click(function () {
    $('#saveBtn').val("add-wash-car");
    $('#id').val('');
    $('#actionTransaction').trigger("reset");
    $('#transactionLabel').html("Add Wash Car");
    resetErrorMsg();

    $('.price').text("Rp " + parseInt('0').toLocaleString());
    $('.discount').text("Rp " + parseInt('0').toLocaleString());
    $('.additional_discount').text("Rp " + parseInt('0').toLocaleString());
    $('.total_price').text("Rp " + parseInt('0').toLocaleString());

    $('#transaction').modal('show');
});

$('body').on('click', '.editTransaction', function () {
    var transaction_id = $(this).data('id');
    $.get("{{ route('transaction.index') }}" +'/' + transaction_id +'/edit', function (data) {
        $('#transactionLabel').html("Edit Transaction");
        $('#saveBtn').val("edit-transaction");
        $('#id').val(data.id);

        $('#name').val(data.name);
        $('#type_car').val(data.type_car);
        $('#merk_car').val(data.merk_car);
        $('#plat').val(data.plat);
        $('#type_wash').val(data.type_wash);
        $('#information').val(data.information);
        $('#additional_discount').val(data.additional_discount);
        resetErrorMsg();

        var price = $('#type_car').find(':selected').data("price")
        var discount = price * ($('#type_wash').find(':selected').data("discount") ? $('#type_wash').find(':selected').data("discount") : 0) / 100
        var additional_discount = $('#additional_discount').val()
        var total_price = price - discount - additional_discount

        $('.price').text("Rp " + parseInt(price).toLocaleString());
        $('.discount').text("Rp " + parseInt(discount).toLocaleString());
        $('.additional_discount').text("Rp " + parseInt(additional_discount).toLocaleString());
        $('.total_price').text("Rp " + parseInt(total_price).toLocaleString());

        $('#transaction').modal('show');
    })
});

$("#actionTransaction").on("submit", function(e) {
    e.preventDefault()
    $('#saveBtn').html('Sending...');
    if($('#saveBtn').val() == "scan-transaction"){
        resultScanner(  $('#id').val() )
        $('#transaction').modal('hide');
    }else{
        $.ajax({
            url: "{{ route('transaction.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success:function(response) {
                $("#transaction").modal("hide")
                $('.yajra-datatable').DataTable().ajax.reload()
                Swal.fire(
                '',
                response.message,
                'success'
                )
                $('#actionTransaction').trigger("reset");
                $('#saveBtn').html('Save');
                printTransaction(response.data.id);
            },
            error: function(err) {
                if (err.status == 422) {
                    printErrorMsg(err.responseJSON.errors)
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Not allowed!'
                    })
                }
                $('#saveBtn').html('Save');
            }  
        })
    }
});

$('body').on('click', '.deleteTransaction', function () {
    var transaction_id = $(this).data("id");
    Swal.fire({
        title: 'Are You sure want to delete !',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('transaction.store') }}"+'/'+ transaction_id,
                method: "DELETE",
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
                success: function(response) {
                    Swal.fire(
                        'Delete',
                        response.message,
                        'success'
                    )

                    $('.yajra-datatable').DataTable().ajax.reload()
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Not allowed!'
                    })
                } 
            })
        }
    })
});

function printErrorMsg(msg) {
  $(".print-error-msg").find("ul").html('');
  $(".print-error-msg").css('display', 'block');
  $.each(msg, function(key, value) {
    $(".print-error-msg").find("ul").append('<li style="font-size : 11px";>'+value+'</li>')
  });
}

function resetErrorMsg(){
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'none');
}

$(document).ready(function(){
    $.get("{{ route('type-car.get-type-car') }}", function (data) {
        var select = $('#type_car');
        $.each(data, function (id, car) {
            select.append($('<option>',{
                value : id,
                text : car.type_car,
                'data-price' : car.price
            }))
        })
    })

    $.get("{{ route('type-wash.get-type-wash') }}", function (data) {
        var select = $('#type_wash');
        $.each(data, function (id, wash) {
            select.append($('<option>',{
                value : id,
                text : wash.type_wash,
                'data-discount' : wash.discount
            }))
        })
    })
})

$('#type_car').on('change', function () {
    var price = $('#type_car').find(':selected').data("price")
    var discount = price * ($('#type_wash').find(':selected').data("discount") ? $('#type_wash').find(':selected').data("discount") : 0) / 100
    var additional_discount = $('#additional_discount').val()
    var total_price = price - discount - additional_discount

    $('.price').text("Rp " + parseInt(price).toLocaleString());
    $('.discount').text("Rp " + parseInt(discount).toLocaleString());
    $('.additional_discount').text("Rp " + parseInt(additional_discount).toLocaleString());
    $('.total_price').text("Rp " + parseInt(total_price).toLocaleString());
});

$('#type_wash').on('change', function () {
    var price = $('#type_car').find(':selected').data("price")
    var discount = price * ($('#type_wash').find(':selected').data("discount") ? $('#type_wash').find(':selected').data("discount") : 0) / 100
    var additional_discount = $('#additional_discount').val()
    var total_price = price - discount - additional_discount


    $('.price').text("Rp " + parseInt(price).toLocaleString());
    $('.discount').text("Rp " + parseInt(discount).toLocaleString());
    $('.additional_discount').text("Rp " + parseInt(additional_discount).toLocaleString());
    $('.total_price').text("Rp " + parseInt(total_price).toLocaleString());
});

$('#additional_discount').on('change', function () {
    var price = $('#type_car').find(':selected').data("price")
    var discount = price * ($('#type_wash').find(':selected').data("discount") ? $('#type_wash').find(':selected').data("discount") : 0) / 100
    var additional_discount = $('#additional_discount').val()
    var total_price = price - discount - additional_discount

    $('.price').text("Rp " + parseInt(price).toLocaleString());
    $('.discount').text("Rp " + parseInt(discount).toLocaleString());
    $('.additional_discount').text("Rp " + parseInt(additional_discount).toLocaleString());
    $('.total_price').text("Rp " + parseInt(total_price).toLocaleString());
});

$('body').on('click', '.printTransaction', function () {
    var print_id = $(this).data('id');
    printTransaction(print_id);
});

function printTransaction(id){
    $.get("{{ route('transaction.index') }}" +'/' + id +'/edit', function (data) {
        $('#printLabel').html("Print Transaction");
        $('#printBtn').val("print-transaction");
        $('#print_id').val(data.id);

        $('#print_name').val(data.name);
        $('#print_plat').val(data.plat);
        resetErrorMsg();

        $('.price').text("Rp " + parseInt(data.price).toLocaleString());
        $('.discount').text("Rp " + parseInt(data.discount).toLocaleString());
        $('.additional_discount').text("Rp " + parseInt(data.additional_discount).toLocaleString());
        $('.total_price').text("Rp " + parseInt(data.total_price).toLocaleString());

        $('#print').modal('show');
    })
}

$("#actionPrint").on("submit", function(e) {
    e.preventDefault();
    var print_id =$('#print_id').val();
    console.log(print_id);
    window.open("{{ route('transaction.index') }}" +'/print/' + print_id, "_blank")
    $('#print').modal('hide');
});

$('#scanQR').click(function () {
    $('#scanLabel').html("Scan QR");
    $('#scan').modal('show');

    let selectedDeviceId = null;
    const codeReader = new ZXing.BrowserMultiFormatReader();
    const sourceSelect = $("#pilihKamera");

    $(document).on('change','#pilihKamera',function(){
        selectedDeviceId = $(this).val();
        if(codeReader){
            codeReader.reset()
            initScanner()
        }
    })

    function initScanner() {
        codeReader
        .listVideoInputDevices()
        .then(videoInputDevices => {
            videoInputDevices.forEach(device =>
                console.log(`${device.label}, ${device.deviceId}`)
            );
    
            if(videoInputDevices.length > 0){
                
                if(selectedDeviceId == null){
                    if(videoInputDevices.length > 1){
                        selectedDeviceId = videoInputDevices[1].deviceId
                    } else {
                        selectedDeviceId = videoInputDevices[0].deviceId
                    }
                }
                
                
                if (videoInputDevices.length >= 1) {
                    sourceSelect.html('');
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        if(element.deviceId == selectedDeviceId){
                            sourceOption.selected = 'selected';
                        }
                        sourceSelect.append(sourceOption)
                    })
            
                }
    
                codeReader
                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                    .then(result => {
                            viewScanner(result.text)
                            codeReader.reset()
                            $('#scan').modal('hide');
                    })
                    .catch(err => console.error(err));
                
            } else {
                alert("Camera not found!")
            }
        })
        .catch(err => console.error(err));
    }

    if (navigator.mediaDevices) {
        initScanner()
    } else {
        alert('Cannot access camera.');
    }
});

function viewScanner(text){
    $.get("{{ route('transaction.scan') }}" +'/' + text, function (data) {
        $('#transactionLabel').html("View Scanner");
        $('#saveBtn').val("scan-transaction");

        $('#name').attr("disabled", "disabled");
        $('#type_car').attr("disabled", "disabled");
        $('#merk_car').attr("disabled", "disabled");
        $('#plat').attr("disabled", "disabled");
        $('#type_wash').attr("disabled", "disabled");
        $('#information').attr("disabled", "disabled");
        $('#additional_discount').attr("disabled", "disabled");
        
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#type_car').val(data.type_car);
        $('#merk_car').val(data.merk_car);
        $('#plat').val(data.plat);
        $('#type_wash').val(data.type_wash);
        $('#information').val(data.information);
        $('#additional_discount').val(data.additional_discount);
        resetErrorMsg();

        var price = $('#type_car').find(':selected').data("price")
        var discount = price * ($('#type_wash').find(':selected').data("discount") ? $('#type_wash').find(':selected').data("discount") : 0) / 100
        var additional_discount = $('#additional_discount').val()
        var total_price = price - discount - additional_discount

        $('.price').text("Rp " + parseInt(price).toLocaleString());
        $('.discount').text("Rp " + parseInt(discount).toLocaleString());
        $('.additional_discount').text("Rp " + parseInt(additional_discount).toLocaleString());
        $('.total_price').text("Rp " + parseInt(total_price).toLocaleString());

        $('#transaction').modal('show');
    })
}

function resultScanner(id){
    var dataToSend = {
        id : id,
        "_token": $("meta[name='csrf-token']").attr("content")
    };

    $.post("{{route('transaction.scan')}}", dataToSend)
    .done(function(response){
        if(response.message){
            Swal.fire(
                '',
                response.message,
                'success'
            )
        }else{
            Swal.fire(
                '',
                response.error,
                'error'
            )
        }

        $('.yajra-datatable').DataTable().ajax.reload()
        
    })
    .fail(function(error){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Not allowed!'
        })
    })
}

</script>