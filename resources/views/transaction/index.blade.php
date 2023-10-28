@extends("layouts.app")
@section("title", "Transaction")

@section("header-content")
<div class="card-header d-flex justify-content-between">
    <div class="col-md-12">
        <div class="header-title">
            <h4 class="card-title">Data Transaction</h4>
        </div>
    </div>
</div>
<div class="card-header d-flex justify-content-between">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 float-left">
        <div class="d-grid gap-2 ">
            <button type="button" class="btn btn-primary rounded-pill me-1" id="washCar">
                + Wash Car |
                <i class="icon">
                    <img src="{{ asset('assets/images') }}/icons/carwash-white.svg" alt=""
                        style="width: 20px; color: white">
                </i>
            </button>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 float-right">
        <div class="d-grid gap-2 ">
            <button type="button" class="btn btn-warning rounded-pill ms-1" id="scanQR">
                + Scan QR Code |
                <i class="icon">
                    <img src="{{ asset('assets/images') }}/icons/qrcode-scan-white.svg" alt=""
                        style="width: 20px; color: white">
                </i>
            </button>
        </div>
    </div>
</div>
@endsection

@section("content")
<p>The following is the transaction data that has been saved.</p>
<div class="table-responsive">
    <table id="datatable" class="table table-striped yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Plat</th>
                <th>Name</th>
                <th>Merk Car</th>
                <th>Total Price</th>
                <th>User In</th>
                <th>User Out</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection

@push("js")
@include("transaction.ajax")
@endpush

<!-- Modal  Transaction -->
<div class="modal fade" id="transaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="transactionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="actionTransaction">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <div class="alert alert-warning alert-dismissible fade show print-error-msg" role="alert"
                        style="display: none;">
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
                                <label for="type_car">Type Car : </label>
                                <select name="type_car" id="type_car"class="form-control" required="">
                                    <option selected disabled value="">-- Please Select Type Car --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="merk_car">Merk Car : </label>
                                <input required="" type="text" name="merk_car" id="merk_car" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="plat">Plat : </label>
                                <input required="" type="text" name="plat" id="plat" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="type_wash">Type Wash : </label>
                                <select name="type_wash" id="type_wash"class="form-control " required="">
                                    <option selected disabled value="">-- Please Select Type Wash --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="additional_discount">Additional Discount : </label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp.</span>
                                    <input required="" type="number" name="additional_discount" id="additional_discount"
                                        class="form-control" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="information">Information : </label>
                                <input required="" type="text" name="information" id="information" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-end">
                                <table>
                                    <tr>
                                        <td>Price</td>
                                        <td>:</td>
                                        <td class="price"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>:</td>
                                        <td class="discount"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount +</td>
                                        <td>:</td>
                                        <td class="additional_discount"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold fs-5 text-dark">Total Price</td>
                                        <td class="fw-bold fs-5 text-dark">:</td>
                                        <td class="fw-bold fs-5 text-dark total_price"></td>
                                    </tr>
                                </table>
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
{{-- End Modal  Transaction --}}

<!-- Modal Print -->
<div class="modal fade" id="print" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="printLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="actionPrint">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="print_id" class="form-control">
                    <div class="alert alert-warning alert-dismissible fade show print-error-msg" role="alert" style="display: none;">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Name : </label>
                                <input required="" type="text" name="name" id="print_name" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="plat">Plat : </label>
                                <input required="" type="text" name="plat" id="print_plat" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-end">
                                <table>
                                    <tr>
                                        <td>Price</td>
                                        <td>:</td>
                                        <td class="price"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>:</td>
                                        <td class="discount"></td>
                                    </tr>
                                    <tr>
                                        <td>Discount +</td>
                                        <td>:</td>
                                        <td class="additional_discount"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold fs-5 text-dark">Total Price</td>
                                        <td class="fw-bold fs-5 text-dark">:</td>
                                        <td class="fw-bold fs-5 text-dark total_price"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="printBtn">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Print --}}

<!-- Modal Scan -->
<div class="modal fade" id="scan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scanLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="alert alert-warning alert-dismissible fade show print-error-msg" role="alert" style="display: none;">
                    <ul></ul>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="video-container">
                            <video id="previewKamera" class="img-fluid"></video>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="type_car">Pilih Kamera : </label>
                            <select id="pilihKamera" name="type_car" id="type_car"class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Scan --}}