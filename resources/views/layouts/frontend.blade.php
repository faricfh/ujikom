<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>FShop</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('assets/frontend/img/logo-fshop-ico.ico') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    @yield('css')
</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="{{ route('cariproduk') }}" method="get">
                            <input type="text" name="produk" class="form-control typeahead" autocomplete="off">
                            <button type="submit" style="margin-top:unset;"><img src="{{ asset('assets/frontend/img/core-img/search.png') }}" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="/"><img src="{{ asset('assets/frontend/img/logo-fshop3.png') }}" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        @include('layouts.frontend.sidebar')

        <!-- Product Catagories Area Start -->
        @yield('content')
        @notifyCss
        @notifyJs
        <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        {{-- <div class="footer-logo mr-50"> --}}
                            <a href="index.html"><img src="{{ asset('assets/frontend/img/logo-fshop.jpg') }}" style="height: 100px"></a>
                            {{-- <h1 style="color:white">FShop</h1> --}}
                        {{-- </div> --}}
                        <p class="copywrite">+ Alamat: Jl Cibaduyut</p>
                        <p class="copywrite">+ Kontak: faricfathianhidayah@gmail.com</p>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{ url('/')}}">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/shop')}}">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/cart')}}">Cart</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @php
        $data =  Auth::guard('customer')->check();
        if($data == false){
            $a = 0;
        }else{
            $a = 1;
        }
    @endphp
        <input type="hidden" id="check_auth" value="{{ $a }}">
    @include('frontend.login')
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    {{-- <script src="{{ asset('assets/frontend/js/jquery/jquery-2.2.4.min.js') }}"></script> --}}
    <script src="{{ asset('assets/frontend/js/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- jQuery -->
    {{-- <script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script> --}}
    <!-- Popper js -->
    <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('assets/frontend/js/active.js') }}"></script>
    <script src="{{ asset('js/jmlh.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script>
        $(".close").click(function(){
            $('#alert').css('display','none');
        })
    </script>
    <script>
        $('#modal').on('hidden.bs.modal',function(){
            $('#formlogin').trigger('reset');
            $('#formregister').trigger('reset');
        })
    </script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#login').on('click',function(e){
            e.preventDefault();

            $('#modal2').show();
        });

        // register
        $('#btn-post2').click(function (e) {
            e.preventDefault();
            // $(this).hide();
            $.ajax({
                data: $('#formregister').serialize(),
                url: "{{ url('/customerregister') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#formregister').trigger('reset');
                    $('#formregister').css('display','none');
                    $('.button_register').css('display','none');
                    $('#formlogin').show();
                    $('#alertberhasil').append(
                        `
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Akun Berhasil Dibuat!
                            </div>
                        `
                    );
                },

                error: function (request, status, error) {
                    $('#error_nama').empty().show();
                    $('#error_email').empty().show();
                    $('#error_no_tlp').empty().show();
                    $('#error_alamat').empty().show();
                    $('#error_password').empty().show();
                    json = $.parseJSON(request.responseText);
                    $('#error_nama').html(json.errors.nama);
                    $('#error_email').html(json.errors.email);
                    $('#error_no_tlp').html(json.errors.no_tlp);
                    $('#error_alamat').html(json.errors.alamat);
                    $('#error_password').html(json.errors.password);
                }
            });
        });

        // chat
        $('#chat_first_screen').click(function(){
            $.ajax({
                data: $('#form_akun').serialize(),
                url: "{{ url('kirim_akun') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    $('#form_akun').trigger('reset');
                    $('#id_customer').val(data.success.id);
                    $('#fab_send').show();
                },

                error: function(request){
                    console.log(request.responseText);
                }
            })
        })

        var no = 0;
        $('#fab_send').click(function(){
            $.ajax({
                data: $('#form_pesan').serialize(),
                url: "{{ url('/kirim_pesan') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    $('#fab_send').show();
                    $('#form_pesan').trigger('reset');
                    no++
                    $('#pesan'+no+'').after('<span class="chat_msg_item chat_msg_item_user" id="pesan'+(no+1)+'">'+data+'</span>');
                }
            })
        })

        if (($(".is-visible").length == 0)) {
            $('.chat').css('display', 'none');
        }
    </script>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
    var path = "{{ route('search') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        },
        highlighter: function (item, data) {
            var parts = item.split('#'),
                html = '<div class="row">';
                html += '<div class="col-md-2">';
                html += '<img src="/assets/poto/'+data.img+'"/ height="44px;" width="65px;">';
                html += '</div>';
                html += '<div class="col-md-10 pl-0">';
                html += '<span>'+data.name+'</span>';
                // html += '<p class="m-0">'+data.desc+'</p>';
                html += '</div>';
                html += '</div>';

            return html;
        }
    });
</script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5e6cc407eec7650c331ffef1/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    @yield('js')

</body>

</html>
