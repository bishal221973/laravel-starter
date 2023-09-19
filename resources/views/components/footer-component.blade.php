<div class="container-fluid footer">
    <div class="row">
        <div class="col-xl-2 col-lg-1 col-md-12"></div>
        <div class="col-xl-8 col-lg-10 col-md-12 py-5">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <div class="d-flex align-items-center gap-4">
                        <i class="fa-solid fa-location-dot text-info fa-2x mr-4"></i>
                        <div class="d-block">
                            <h3 class="text-white m-0">Find us</h3>
                            <span class="text-secondary">{{settings()->get('org_address', $default = null)}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 footer-callus">
                    <div class="d-flex align-items-center gap-4">
                        <i class="fa-solid fa-phone text-info fa-2x mr-4"></i>
                        <div class="d-block">
                            <h3 class="text-white m-0">Call us</h3>
                            <span class="text-secondary">{{settings()->get('org_contact', $default = null)}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 footer-mailus">
                    <div class="d-flex align-items-center gap-4">
                        <i class="fa-solid fa-envelope text-info fa-2x mr-4"></i>
                        <div class="d-block">
                            <h3 class="text-white m-0">Mail us</h3>
                            <span class="text-secondary">{{settings()->get('org_email', $default = null)}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row pt-5">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <h1 class="fw-bold text-white text-uppercase">Flight <span class="text-danger">MOJO</span></h1>
                    <label class="pb-3 text-white signika letter-space1">Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Accusamus iure repellat saepe ad amet,
                        beatae repellendus dolor consequuntur sapiente reprehenderit.</label>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <h4 class="fw-bold text-white text-uppercase">Contact us</h4>
                    <label class="text-white"><b>EMAIL :</b><span> bishalcodeslaravel@gmail.com</span></label><br>
                    <label class="text-white"><b>Phone :</b><span> 9814668499</span></label><br>
                    <label class="text-white"><b>Address :</b><span> Dhangadhi, Motichok</span></label><br>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <h4 class="fw-bold text-white text-uppercase">Contact us</h4>
                    <label class="text-white"><b>EMAIL :</b><span> bishalcodeslaravel@gmail.com</span></label><br>
                    <label class="text-white"><b>Phone :</b><span> 9814668499</span></label><br>
                    <label class="text-white"><b>Address :</b><span> Dhangadhi, Motichok</span></label><br>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-1 col-md-12"></div>
        <div class="col-12 sub-footer">
            <div class="row">
                <div class="col-xl-2">
                </div>
                <div class="col-xl-8">
                    <label class="text-secondary" style="font-size: 15px">Design and developed by <a href="#">Bishal Chaudhary</a> &nbsp;<i class="fa-solid fa-heart text-danger"></i></label>
                </div>
                <div class="col-xl-2">

                </div>
            </div>
        </div>

    </div>
</div>
