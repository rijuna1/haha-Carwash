@extends("layouts.app")
@section("title", "User")

@section("header-content")
    <div class="card-header d-flex justify-content-between">
        <div class="col-md-10">
            <div class="header-title">
                <h4 class="card-title">Data User</h4>
            </div>
        </div>
        <div class="col-md-2 float-right">
            <button type="button" class="btn btn-primary rounded-pill" id="addUser">
                Add User
            </button>
        </div>
    </div>
@endsection

@section("content")
    <p>The following is the user data that has been saved.</p>
    <div class="table-responsive">
       <table id="datatable" class="table table-striped yajra-datatable">
          <thead>
             <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
             </tr>
          </thead>
          <tbody>
             
          </tbody>
       </table>
    </div>
@endsection

@push("js")
    @include("user.ajax")
@endpush

<!-- Modal User -->
<div class="modal fade" id="user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="actionUser">
            @csrf
            <div class="modal-body">
                <input  type="hidden" name="id" id="id" class="form-control">
                <div class="alert alert-warning alert-dismissible fade show print-error-msg" role="alert" style="display: none;">
                    <ul></ul>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Name : </label>
                            <input required="" type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="username">Username : </label>
                            <input required="" type="text" name="username" id="username" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="password">Password : </label>
                            <input required="" type="password" name="password" id="password" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation : </label>
                            <input required="" type="password" name="password_confirmation" id="password_confirmation" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="role">Role :</label>
                            <select name="role" id="role"  class="form-select" aria-label="Default select example"  required>
                                <option selected disabled value="">-- Please Select Role --</option>
                                <option value = "Admin">Admin</option>
                                <option value = "Pegawai">Pegawai</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>
  {{-- End Modal User --}}