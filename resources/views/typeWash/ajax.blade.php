<script>
    $(function () {
        var table = $('.yajra-datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('type-wash.index') }}",
           columns: [
               {data: 'DT_RowIndex' , name: 'id'},
               {data: 'type_wash', name: 'type_wash'},
               {data: 'discount', name: 'discount'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
       });
     }); 

    $('#addTypeWash').click(function () {
        $('#saveBtn').val("create-type-wash");
        $('#id').val('');
        $('#actiontypeWash').trigger("reset");
        $('#typeCarLabel').html("Create New Type Wash");
        resetErrorMsg();
        $('#typeWash').modal('show');
    });

    $('body').on('click', '.editTypeWash', function () {
      var typeWash_id = $(this).data('id');
      $.get("{{ route('type-wash.index') }}" +'/' + typeWash_id +'/edit', function (data) {
        $('#typeWashLabel').html("Edit Type Wash");
        $('#saveBtn').val("create-type-wash");
        $('#id').val(data.id);

        $('#type_wash').val(data.type_wash);
        $('#discount').val(data.discount);
        resetErrorMsg();
        $('#typeWash').modal('show');
      })
    });

     $("#actiontypeWash").on("submit", function(e) {
        e.preventDefault()
        $('#saveBtn').html('Sending...');
        $.ajax({
            url: "{{ route('type-wash.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success:function(response) {
                $("#typeWash").modal("hide")
                $('.yajra-datatable').DataTable().ajax.reload()
                Swal.fire(
                '',
                response.message,
                'success'
                )
                $('#actiontypeWash').trigger("reset");
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

    $('body').on('click', '.deleteTypeWash', function () {
        var typeWash_id = $(this).data("id");
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
                    url: "{{ route('type-wash.store') }}"+'/'+ typeWash_id,
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