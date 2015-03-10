@extends('main')

@section('content')
<style>
/*#rot:hover #form{*/
/*transform: rotateY(180deg);*/
/*}*/
#rot.hover #form, #rot.flip #form {
	transform: rotateY(180deg);
}
#form{
transition: 0.6s;
	transform-style: preserve-3d;

	position: relative;
}
#front, #back{
    backface-visibility: hidden;

    position: absolute;
    top: 0;
    left: 0;
}
#front {
	z-index: 2;
	/* for firefox 31 */
	transform: rotateY(0deg);
}

/* back, initially hidden pane */
#back {
	transform: rotateY(180deg);
}
</style>
<div class="valign-dwrapper" style="min-height: 720px;">
    <div class="row" style="width: 100%;">
        <div class="center col s12 m6 offset-m3">
            <h4><i class="mdi-action-face-unlock blue-text"></i></h4>
            <h4>Profile</h4>
            @if(Session::has('invalid'))
            <div class="red lighten-5 red-text">
                <ul>
                    <p style="margin:0">{{ Session::get('invalid') }}</p>
                </ul>
            </div>
            @elseif(Session::has('success'))
            <div class="green lighten-5 green-text">
                <ul>
                    <p style="margin:0">{{ Session::get('success') }}</p>
                </ul>
            </div>
            @endif
            <div class="red lighten-5 red-text">
                <ul>
                    <p style="margin:0">{{ $errors->profile->first('name') }}</p>
                    <p style="margin:0">{{ $errors->profile->first('email') }}</p>
                    <p style="margin:0">{{ $errors->profile->first('username') }}</p>
                    <p style="margin:0">{{ $errors->profile->first('password') }}</p>
                    <p style="margin:0">{{ $errors->profile->first('new_password') }}</p>
                </ul>
            </div>
        </div>
    </div>

    <div id="rot" ontouchstart="this.classList.toggle('hover');" class="container row" style="perspective: 1000">

        {{ Form::open(array('url' => 'profile_action', 'class'=>'col s12 m6 offset-m3', 'id'=>'form')) }}
        <div id="front" class="center z-depth-1-half">

                <div class="input-field col s12 center center-block center-align">
                    <input name="name" id="name" type="text" value = "{{Input::old('name', Auth::user()->name)}}" class="validate">
                    <label for="name">Name</label>
                </div>
                <div class="input-field col s12 center center-block center-align">
                    <input name="email" id="email" type="email" value = "{{Input::old('email', Auth::user()->email)}}" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12 center center-block center-align">
                    <input name="username" id="username" value = "{{Input::old('username', Auth::user()->username)}}" type="text" class="validate">
                    <label for="username">Username</label>
                </div>
                <div class="input-field col s12 center center-block center-align">
                    <input name="password" id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
                <button class="btn waves-effect waves-light green" type="submit" name="action">
                    Save
                    <i class="mdi-content-send right"></i>
                </button>



            <div class="row">
                <a onclick="document.querySelector('#rot').classList.toggle('hover');" class="btn-flat blue-text">Change Password</a>
            </div>
        </div>

        <div id="back" class="z-depth-1-half">
            <p class="flow-text center-align">Fillup the fields if you wish to change your password</p>

            <div class="input-field col s12 center center-block center-align">
                <input name="new_password" id="new_password" type="password" class="validate">
                <label for="new_password">Password</label>
            </div>
            <div class="input-field col s12 center center-block center-align">
                <input name="new_password_confirmation" id="new_password_confirmation" type="password" class="validate">
                <label for="new_password_confirmation">Confirm Password</label>
            </div>
            <a onclick="document.querySelector('#rot').classList.toggle('hover');" class="btn-flat blue-text">Continue</a>
        </div>
        {{Form::close()}}

    </div>

</div>
@if(Auth::check())
    <div class="fixed-action-btn" style="bottom: 35px; right: 14px;">
        <a class="btn-floating btn-large teal">
          <i class="large mdi-editor-mode-edit"></i>
        </a>
        <ul>
          <li><a href="{{ URL::to('create') }}" class="btn-floating green"><i class="large mdi-content-add"></i></a></li>
          <li><a class="btn-floating yellow darken-1"><i class="large mdi-action-search"></i></a></li>
          <li><a href="{{ URL::to('logout') }}" class="btn-floating red"><i class="large mdi-editor-publish"></i></a></li>
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
    </script>

@stop