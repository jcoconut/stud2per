@extends('main')

@section('content')

<div class="valign-wrapper" style="min-height: 720px;">
    <div class="row" style="width: 100%;">
        <div class="center col m6 offset-m3">
            <h4><i class="mdi-action-face-unlock blue-text"></i></h4>
            <h4>Start your part one</h4>
            <div class="row">
                <div class="col s12 m6">
                    <div class="row">
                        <div class="s4 col valign-wrapper">
                            <i class="mdi-action-list blue-text text-darken-2 medium"></i>
                        </div>
                        <div class="s8 col">
                            <h4>Moments</h4>
                            <p>Share those precious moments!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="s4 col valign-wrapper">
                            <i class="mdi-action-view-headline blue-text text-darken-2 medium"></i>
                        </div>
                        <div class="s8 col">
                            <h4>Thoughts</h4>
                            <p>Make all those thoughts count and let the world know </p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="s4 col valign-wrapper">
                            <i class="mdi-action-visibility blue-text text-darken-2 medium"></i>
                        </div>
                        <div class="s8 col">
                            <h4>Anything</h4>
                            <p>Anything! may masabi lang</p>
                        </div>

                    </div>

                </div>

                <div class="col s12 m6 z-depth-1-half">
                    @if(Session::has('success'))
                        <div class="green lighten-5 green-text">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <div class="red lighten-5 red-text">
                    <ul>
                        <p style="margin:0"><?php echo $errors->register->first('name'); ?></p>
                        <p style="margin:0"><?php echo $errors->register->first('email'); ?></p>
                        <p style="margin:0"><?php echo $errors->register->first('username'); ?></p>
                        <p style="margin:0"><?php echo $errors->register->first('password'); ?></p>

                    </ul>

                    </div>

                    {{Form::open(array('url' => 'register_action','id' => 'reg_form'))}}
                        <div class="input-field col s12 center center-block center-align">
                            <input name="name" id="name" type="text" value = "{{Input::old('name')}}" class="validate">
                            <label for="name">Name</label>
                        </div>
                        <div class="input-field col s12 center center-block center-align">
                            <input name="email" id="email" type="email" value = "{{Input::old('email')}}" class="validate">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s12 center center-block center-align">
                            <input name="username" id="username" value = "{{Input::old('username')}}" type="text" class="validate">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s12 center center-block center-align">
                            <input name="password" id="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                        <div id="loader_area">
                        <button id="remove_click" class="btn waves-effect waves-light green" type="submit" name="action">
                            Register
                            <i class="mdi-content-send right"></i>
                        </button>
                        </div>
                    {{Form::close()}}
                    {{--<div class="row">--}}
                        {{--<p class="center-align">Login with</p>--}}
                            {{--<button class="col s12 m6 waves-effect btn-flat blue darken-2 white-text">Facebook</button>--}}

                            {{--<button class="col s12 m6 waves-effect btn-flat red darken-1 white-text">Google</button>--}}

                    {{--</div>--}}
                    <div class="row">
                        <div class="center-align center-block">
                            <p>Have an account already? <a class="btn-flat blue-text modal-trigger" href="#login_modal">Sign In</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    <button type="submit" class="left green-text waves-effect btn-flat">
                        <i class="left green-text mdi-navigation-arrow-forward"></i> Login
                    </button>
                </div>
            </div>

        {{ Form::close() }}
    </div>

</div>
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
            $("#reg_form").submit();
            var elem = "<div class='progress'><div class='indeterminate'></div></div>";
            $("#loader_area").after(elem);

        });
    </script>

@stop