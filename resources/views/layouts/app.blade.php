@include("layouts.header")
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="row">                  
                <div class="col-lg-12">
                    <div class="card   rounded">
                        @yield("header-content")
                        <div class="card-body">
                            @yield("content")
                        </div>
                    </div>
                </div>                                    
            </div>
        </div>
      <!-- Footer Section Start -->
@include("layouts.footer")