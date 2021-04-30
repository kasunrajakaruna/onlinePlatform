<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{'images/favicon.ico'}}">

    <!-- App title -->
    <title>E Support</title>

    <!-- App CSS -->
    <link href="{{'css/style.css'}}" rel="stylesheet" type="text/css"/>

    <script src="{{'js/jquery.min.js'}}"></script>
    <!-- Modernizr js -->
    <script src="{{'js/modernizr.min.js'}}"></script>

</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="#" class="logo">
                <i class="zmdi zmdi-portable-wifi icon-c-logo"></i>
                <span>E Support</span></a>
        </div>


        <nav class="navbar navbar-custom" style="background-color:purple">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="zmdi zmdi-menu"></i>
                    </button>
                </li>
            </ul>

            <ul class="nav navbar-nav pull-right" style="padding-top:20px">

                @if(!Auth::user())
                    <button class="btn btn-purple btn-addonc padding-top-10" data-toggle="modal"
                            data-target="#login_modal">Login
                    </button>
                @else
                    
                    <li class="nav-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user"
                           data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                           Hi {{ Auth::user()->name  }}
                            <img src="{{'images/default-user.png'}}" alt="user" class="img-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown "
                             aria-labelledby="Preview">

                            <a href="{{ URL::Route('logout') }}" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-power"></i> <span>Logout</span>
                            </a>

                        </div>
                    </li>
                @endif

            </ul>

        </nav>

    </div>

    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="login modal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="login_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group {{ ($errors->has('createddate')) ? ' has-error' : '' }}">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control datepicker" id="email" name="email" required>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="form-group {{ ($errors->has('createddate')) ? ' has-error' : '' }}">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-purple">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>

                    @if(!Auth::user())
                        <li class="has_sub">
                            <a href="{{ URL::route('dashboard') }}" class="waves-effect active" style="background-color:mediumpurple"><i
                                    class="zmdi zmdi-view-dashboard"></i><span> Home </span> </a>
                        </li>
                    @endif

                    @if(Auth::user())
                        <li class="has_sub">
                            <a href="{{ URL::route('ticket_list') }}" class="waves-effect"><i
                                    class="zmdi zmdi-view-web"></i><span> Ticket Manager </span> </a>
                        </li>
                        @if(Auth::user()->role == 'admin')
                            <li class="has_sub">
                                <a href="{{ URL::route('user_list') }}" class="waves-effect"><i
                                        class="zmdi zmdi-accounts-outline"></i><span> Support Agents Manager </span> </a>
                            </li>
                        @endif
                    @endif

                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                @yield('content')

            </div> <!-- container -->

        </div> <!-- content -->


    </div>
    <!-- End content-page -->


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <footer class="footer text-right">
        2021 © E Support - KasunR
    </footer>


</div>
<!-- END wrapper -->


<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{'js/bootstrap.min.js'}}"></script>
<script src="{{'js/jquery.blockUI.js'}}"></script>
<script src="{{'js/jquery.nicescroll.js'}}"></script>


<!-- App js -->
<script src="{{'js/jquery.core.js'}}"></script><script src="{{'js/jquery.app.js'}}"></script>

<!-- Page specific js -->
{{--<script src="{{'pages/jquery.dashboard.js'}}"></script>--}}

<script type="text/javascript">


    $('#login_form').on('submit', function (event) {
        event.preventDefault();

        var loginform = new FormData(this);
        $('.form-group').removeClass('has-error');

        $.ajax({
            headers: {'X-CSRF-Token': $(this).find('input[name="_token"]').val()},
            url: '{{ route('login') }}',
            data: loginform,
            dataType: 'json',
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                if (data.code !== 200) {
                    alert('Please Try again');
                } else {
                    window.location.href = "{{ route('ticket_list')}}";
                }
            },
            error: function (error) {
                alert('error');
                {{--btn.button('reset');--}}
                {{--setNotify(2, "{{ Helpers::setGlobalVariable('sys_request_error_message')  }}");--}}
            }
        });

        return false;
    });


</script>

</body>

</html>
