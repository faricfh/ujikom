<div class="modal fadein" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">

                        <!-- MATERIAL DESIGN ICONIC FONT -->
                        <link rel="stylesheet" href="{{ asset('assets/frontend/login/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">

                        <!-- STYLE CSS -->
                        <link rel="stylesheet" href="{{ asset('assets/frontend/login/css/style.css') }}">
                    </head>

                    <body>
                        <div class="inner">
                            <div class="image-holder">
                                <img src="{{ asset('assets/frontend/login/images/registration-form-1.jpg') }}" alt="">
                            </div>
                            <div>
                            <form id="formlogin" style="width:155%">
                                <h3>Login Form</h3>
                                <div class="form-wrapper">
                                    <input type="text" placeholder="Email Address" class="form-control-template">
                                    <i class="zmdi zmdi-email"></i>
                                </div>
                                <div class="form-wrapper">
                                    <input type="password" placeholder="Password" class="form-control-template">
                                    <i class="zmdi zmdi-lock"></i>
                                </div>
                                <a id="create_account">create account</a>
                            </form>
                            <form id="formregister" style="display:none; width:120%;">
                                <i class="zmdi zmdi-arrow-left" style="height:30px; width:50px;" id="backformlogin">  Back</i>
                                <h3>Registration Form</h3>
                                <div class="form-wrapper">
                                    <input type="text" placeholder="Username" class="form-control-template">
                                    <i class="zmdi zmdi-account"></i>
                                </div>
                                <div class="form-wrapper">
                                    <input type="text" placeholder="Email Address" class="form-control-template">
                                    <i class="zmdi zmdi-email"></i>
                                </div>
                                <div class="form-wrapper">
                                    <input type="password" placeholder="Password" class="form-control-template">
                                    <i class="zmdi zmdi-lock"></i>
                                </div>
                                <div class="form-wrapper">
                                    <input type="password" placeholder="Confirm Password" class="form-control-template">
                                    <i class="zmdi zmdi-lock"></i>
                                </div>
                            </form>
                            <button id="btn-post">
                                <i class="zmdi zmdi-arrow-right"></i>
                            </button>
                            </div>
                        </div>

                    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
                </html>
            </div>
        </div>
    </div>
</div>
