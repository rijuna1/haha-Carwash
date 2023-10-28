<script>
    $(function () {
        var table = $('.yajra-datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('user.index') }}",
           columns: [
               {data: 'DT_RowIndex' , name: 'id'},
               {data: 'name', name: 'name'},
               {data: 'username', name: 'username'},
               {data: 'role', name: 'role'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
       });
     }); 

    $('#addUser').click(function () {
        $('#saveBtn').val("create-user");
        $('#id').val('');
        $('#actionUser').trigger("reset");
        $('#userLabel').html("Create New User");
        $('#name').removeAttr("disabled");
        $('#username').removeAttr("disabled");
        $('#password').removeAttr("disabled");
        $('#password_confirmation').removeAttr("disabled");
        $('#role').removeAttr("disabled");
        resetErrorMsg();
        $('#user').modal('show');
    });

    $('body').on('click', '.editUser', function () {
      var user_id = $(this).data('id');
      $.get("{{ route('user.index') }}" +'/' + user_id +'/edit', function (data) {
        $('#userLabel').html("Edit User");
        $('#saveBtn').val("edit-user");
        $('#id').val(data.id);

        $('#name').removeAttr("disabled");
        $('#username').attr("disabled", "disabled");
        $('#password').attr("disabled", "disabled");
        $('#password_confirmation').attr("disabled", "disabled");
        $('#role').removeAttr("disabled");

        $('#name').val(data.name);
        $('#username').val(data.username);
        $('#role').val(data.role);
        resetErrorMsg();
        $('#user').modal('show');
      })
    });

    $('body').on('click', '.resetUser', function () {
      var user_id = $(this).data('id');
      $.get("{{ route('user.index') }}" +'/' + user_id +'/edit', function (data) {
        $('#userLabel').html("Reset Password");
        $('#saveBtn').val("reset-user");
        $('#id').val(data.id);

        $('#name').attr("disabled", "disabled");
        $('#username').attr("disabled", "disabled");
        $('#password').removeAttr("disabled");
        $('#password_confirmation').removeAttr("disabled");
        $('#role').attr("disabled", "disabled");

        $('#name').val(data.name);
        $('#username').val(data.username);
        $('#role').val(data.role);
        resetErrorMsg();
        $('#user').modal('show');
      })
    });

    $("#actionUser").on("submit", function(e) {
        e.preventDefault()
        $('#saveBtn').html('Sending...');
        $.ajax({
            url: "{{ route('user.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success:function(response) {
                $("#user").modal("hide")
                $('.yajra-datatable').DataTable().ajax.reload()
                Swal.fire(
                '',
                response.message,
                'success'
                )
                $('#actionUser').trigger("reset");
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
    })

    $('body').on('click', '.deleteUser', function () {
        var user_id = $(this).data("id");
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
                    url: "{{ route('user.store') }}"+'/'+ user_id,
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