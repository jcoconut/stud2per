@extends('main')

@section('content')

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br><br>
            <h1 class="header center blue-text text-lighten-2">Story of your life</h1>
            <div class="row center">
                <h5 class="header col s12 light">Share your thoughts and precious moments</h5>
            </div>
            <div class="row center" id="loader_area">
                @if(Auth::check())
                <a id="remove_click" href="{{ URL::to('mypart') }}" class="btn-large waves-effect waves-light blue lighten-1">Go to My Page</a>
                @else
                <a id="remove_click" href="{{ URL::to('register') }}" class="btn-large waves-effect waves-light green lighten-1">Get Started</a>
                @endif
            </div>
            <br><br>

        </div>
    </div>
    <div class="parallax"><img src="{{ asset('images/background1.jpg') }}" alt="Unsplashed background img 2"></div>
</div>


<div class="row white" style="margin-bottom: 0">
    <div class=" container">
    <div class="col s12 m4">
        <div class="center ">
            <h3><i class="red-text mdi-action-accessibility"></i></h3>
            <h3>Text</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequuntur distinctio doloremque dolorum, est id illo iure nemo nisi, numquam odit, placeat quidem ratione reprehenderit similique sunt unde. Quod, ratione?</p>
        </div>
    </div>
    <div class="col s12 m4">
        <div class="center">
            <h3><i class="mdi-editor-insert-emoticon grey-text"></i></h3>
            <h3>Text</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequuntur distinctio doloremque dolorum, est id illo iure nemo nisi, numquam odit, placeat quidem ratione reprehenderit similique sunt unde. Quod, ratione?</p>
        </div>
    </div>
    <div class="col s12 m4">
        <div class="center">
            <h3><i class="green-text mdi-action-help"></i></h3>
            <h3>Text</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequuntur distinctio doloremque dolorum, est id illo iure nemo nisi, numquam odit, placeat quidem ratione reprehenderit similique sunt unde. Quod, ratione?</p>
        </div>
    </div>
    </div>
</div>

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">A great tool to manage your daily life</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{ asset('images/background3.jpg') }}" alt="Unsplashed background img 2"></div>
</div>

<div class="row white" style="margin-bottom: 0;">
    <div class="container">
        <div class="s12 m6 col">
            <div class="center">
                <i class="mdi-editor-format-list-numbered green-text medium"></i>
                <h5>Make Memories</h5>
                <img class="responsive-img" src="http://placekitten.com/g/300/299">
            </div>
        </div>
        <div class="s12 m6 col">
            <div class="center">
                <i class="mdi-editor-format-list-bulleted red-text medium"></i>
                <h5>Add Parts</h5>
                <img class="responsive-img" src="http://placekitten.com/g/300/300">
            </div>
        </div>
    </div>
</div>

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 blue-text text-lighten-4">A sentence to show something a sentence to show something</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{ asset('images/peap.jpg') }}" alt="Unsplashed background img 3"></div>
</div>


<!-- Modal Login-->
<div id="login_modal" class="modal">
    <div class="modal-content">

        {{ Form::open(array('url' => 'login_action')) }}
            <div class="row">

                @if(Session::has('invalid'))
                <div class="col s12 m6 offset-m3">
                    <div class="red lighten-5 red-text">
                        <p class="center-align">{{ Session::get('invalid') }}</p>
                    </div>
                </div>
                @endif

                <div class="input-field col s12 m6 offset-m3">
                    <input name="email" id="email" type="text" value = "{{Input::old('email')}}" class="validate">
                    <label for="name">Email</label>
                </div>
                <div class="input-field col s12 m6 offset-m3">
                    <input name="password" id="Password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
                <div class="row input-field col s12 m6 offset-m3">

                    <a class="right block red-text waves-effect btn-flat modal-close">
                        <i class="left red-text mdi-navigation-close"></i> Cancel
                    </a>
                    <button type="submit" class="left green-text waves-grey waves-effect btn-flat">
                        <i class="left green-text mdi-navigation-arrow-forward"></i> Login
                    </button>
                </div>
            </div>

        {{ Form::close() }}
    </div>

</div>
@if(Auth::check())
    <div class="animated bounce fixed-action-btn" style="bottom: 35px; right: 14px;">
        <a class="btn-floating btn-large teal">
          <i class="large mdi-editor-mode-edit"></i>
        </a>
        <ul>
          <li><a href="{{ URL::to('create') }}" class="btn-floating green"><i class="large mdi-content-add-circle"></i></a></li>
          <li><a class="btn-floating yellow darken-1"><i class="large mdi-editor-format-quote"></i></a></li>
          <li><a class="btn-floating red"><i class="large mdi-editor-publish"></i></a></li>
          <li><a class="btn-floating blue"><i class="large mdi-editor-attach-file"></i></a></li>
        </ul>
    </div>
@endif

@stop

@section('extra')
    <script>
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
        });
        @if(Session::has('invalid'))
            $(document).ready(function(){
                $('#login_modal').openModal();
            });
        @endif
        $("#remove_click").click(function(){
            $(this).remove();
            var elem = "<div class='progress'><div class='indeterminate'></div></div>";
            $("#loader_area").after(elem);

        });
    </script>

@stop