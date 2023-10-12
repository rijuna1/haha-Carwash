<script>
    $(function () {
        var table = $('.yajra-datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('type-car.index') }}",
           columns: [
               {data: 'DT_RowIndex' , name: 'id'},
               {data: 'type_car', name: 'type_car'},
               {data: 'price', name: 'price'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
       });
     }); 

    $('#addTypeCar').click(function () {
        $('#saveBtn').val("create-type-car");
        $('#id').val('');
        $('#actiontypeCar').trigger("reset");
        $('#typeCarLabel').html("Create New Type Car");
        resetErrorMsg();
        $('#typeCar').modal('show');
    });

    $('body').on('click', '.editTypeCar', function () {
      var typeCar_id = $(this).data('id');
      $.get("{{ route('type-car.index') }}" +'/' + typeCar_id +'/edit', function (data) {
        $('#typeCarLabel').html("Edit User");
        $('#saveBtn').val("create-type-car");
        $('#id').val(data.id);

        $('#type_car').val(data.type_car);
        $('#price').val(data.price);
        resetErrorMsg();
        $('#typeCar').modal('show');
      })
    });

     $("#actiontypeCar").on("submit", function(e) {
        e.preventDefault()
        $('#saveBtn').html('Sending...');
        $.ajax({
            url: "{{ route('type-car.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success:function(response) {
                $("#typeCar").modal("hide")
                $('.yajra-datatable').DataTable().ajax.reload()
                Swal.fire(
                '',
                response.message,
                'success'
                )
                $('#actiontypeCar').trigger("reset");
                $('#saveBtn').html('Save');
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
    });

    $('body').on('click', '.deleteTypeCar', function () {
        var typeCar_id = $(this).data("id");
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
                    url: "{{ route('type-car.store') }}"+'/'+ typeCar_id,
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



// create-error-validation
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
</script>