@extends("layouts.app")
@section("title", "Type Wash")

@section("header-content")
    <div class="card-header d-flex justify-content-between">
        <div class="col-md-10">
            <div class="header-title">
                <h4 class="card-title">Data Type Wash</h4>
            </div>
        </div>
        <div class="col-md-2 float-right">
            <button type="button" class="btn btn-primary rounded-pill" id="addTypeWash">
                Add Type Wash
            </button>
        </div>
    </div>
@endsection

@section("content")
    <p>The following is the type wash data that has been saved.</p>
    <div class="table-responsive">
       <table id="datatable" class="table table-striped yajra-datatable">
          <thead>
             <tr>
                <th>No</th>
                <th>Type Wash</th>
                <th>Discount</th>
                <th>Action</th>
             </tr>
          </thead>
          <tbody>
             
          </tbody>
       </table>
    </div>
@endsection

@push("js")
    @include("typeWash.ajax")
@endpush

<!-- Modal Type Wash -->
<div class="modal fade" id="typeWash" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="typeWashLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="typeWashLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="actiontypeWash">
            @csrf
            <div class="modal-body">
                <input  type="hidden" name="id" id="id" class="form-control">
                <div class="alert alert-warning alert-dismissible fade show print-error-msg" role="alert" style="display: none;">
                    <ul></ul>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="type_wash">Type Wash : </label>
                            <input required="" type="text" name="type_wash" id="type_wash" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="discount">Discount : </label>
                            <div class="input-group mb-3">
                                <input required="" type="number" name="discount" id="discount" class="form-control">
                                <span class="input-group-text">%</span>
                            </div>
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
  {{-- End Modal Type Wash --}}