<!DOCTYPE html>
<html>
<head>
    <title>Part 1</title>
    <!--Import materialize.css-->
    {{ HTML::style('materialize/css/materialize.min.css') }}
    {{ HTML::style('animate.css') }}
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <style>
        .parallax-container {
            min-height: 380px;
            line-height: 0;
            height: auto;
            color: rgba(255,255,255,.9);
        }
        .parallax-container .section {
            width: 100%;
        }

        @media only screen and (max-width : 992px) {
            .parallax-container .section {
                position: absolute;
                top: 40%;
            }
            #index-banner .section {
                top: 10%;
            }
        }

        @media only screen and (max-width : 600px) {
            #index-banner .section {
                top: 0;
            }
        }
        .icon-block {
            padding: 0 15px;
        }

        footer.page-footer {
            margin: 0;
        }

        .input-field .prefix.active {
            color: #000;
        }


    </style>
</head>

<body class="">



<nav class="grey lighten-4 blue-text z-depth-1-half">
    <div class="nav-wrapper">
        <a class="animated bounce flow-text blue-text" href="{{ URL::to('') }}" class="blue-text">&nbsp;<i class="mdi-action-face-unlock"></i> TheBloggingJay</a>
        <a href="#" data-activates="login-side" class="black-text button-collapse"><i class="mdi-navigation-menu"></i></a>
        @if(Auth::check())
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="green-text" href="{{ URL::to('random') }}">Random</a></li>
                <li><a class="red-text dropdown-button" href="#!" data-activates="dropdown1">
                    {{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i>
                </a></li>
            </ul>
            <ul id="dropdown1" class="dropdown-content">
              <li><a class="blue-text waves-effect" href="{{ URL::to('mypart') }}">MyPart</a></li>
              <li><a class="grey-text waves-effect" href="{{ URL::to('profile') }}">Profile</a></li>
              <li class="divider"></li>
              <li><a class="red-text waves-effect waves-red" href="{{ URL::to('logout') }}">Logout</a></li>
            </ul>
        @else
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="green-text waves-effect modal-trigger" href="#login_modal">Log In</a></li>
            </ul>
        @endif

        <ul id="login-side" class="dropdown-contesnt side-nav">

            @if(Auth::check())
                <li><a class="grey-text" href="{{ URL::to('profile') }}">Profile</a></li>
                <li class="divider"></li>
                <li><a class="red-text" href="{{ URL::to('logout') }}">Logout</a></li>

            @else
                <li><a class="green-text waves-effect modal-trigger" href="#login_modal">Login</a></li>

            @endif


        </ul>
    </div>
</nav>


@yield('content')



<footer id="wrapper" class="page-footer blue lighten-5 black-text">
    <div id="header" class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="blue-text">Hunger Games</h5>
                <p class="blue-text text-lighten-1">This is a project made just for practice and is made by JCO. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquam distinctio modi repellendus veniam. A aliquam aut dolor doloremque, eos eum incidunt inventore ipsam, iste non quia repellendus sapiente ullam?</p>


            </div>
            <div class="col l3 s12">
                <h5 class="blue-text">Affiliates</h5>
                <ul>
                    <li><a class="blue-text" href="#!">Russel Baoy</a></li>
                    <li><a class="blue-text" href="#!">Studio 2</a></li>
                    <li><a class="blue-text" href="#!">Studio 1</a></li>
                    <li><a class="blue-text" href="#!">Klab</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="blue-text">Contact Us</h5>
                <ul>
                    <li><a class="blue-text" href="#!">Link 1</a></li>
                    <li><a class="blue-text" href="#!">Link 2</a></li>
                    <li><a class="blue-text" href="#!">Link 3</a></li>
                    <li><a class="blue-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container black-text">
            Made by <a class="red-text text-lighten-3" href="http://materializecss.com">J.CO</a>
        </div>
    </div>
</footer>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
{{ HTML::script('materialize/js/materialize.min.js') }}
<script>
    (function($){
        $(function(){

            $('.button-collapse').sideNav();
            $('.parallax').parallax();
            $(".dropdown-button").dropdown();
            $('.slider').slider({
                full_width: true,
                interval: 2000 });

        }); // end of document ready
    })(jQuery); // end of jQuery name space
</script>
@yield('extra')
</body>
</html>