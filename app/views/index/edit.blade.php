@extends('main')

@section('content')

<div class="container" style="margin-top:20px;">
    <div class="red lighten-5 red-text">
        <ul class="center-align">
            <p style="margin:0">{{  $errors->create->first('title') }}</p>
            <p style="margin:0">{{ $errors->create->first('body') }}</p>

        </ul>

    </div>
    {{Form::open(array('url' => 'edit_action','class'=>'row'))}}
        {{ Form::hidden('id',$blog->id) }}
        <style>
        [type="radio"]:checked+label:after {
            background-color: #808080;
            border:red;
        }
        </style>

        <div class="valign-wrapper col s12 grey lighten-5 z-depth-1-half" style="min-height: 200px;padding-bottom: 20px;">
            <div class="center-align" style="width: 100%;">
                <div class="input-field col s12 m8 center center-block center-align">
                    <i class="mdi-action-account-circle prefix"></i>
                    {{ Form::text('title', Input::old('title',$blog->title), array('id' => 'title', 'class' => 'validate')) }}
                    {{ Form::label('title', "Title") }}
                </div>
                <div class="input-field col s12 m4 center center-block center-align">
                    <i class="mdi-action-bookmark-outline prefix"></i>
                    {{ Form::text('tag', Input::old('tag', $blog->tag), array('id' => 'tag', 'class' => 'validate')) }}
                    {{ Form::label('tag', "What's it all about?") }}
                </div>
                <div class="input-field col s12 center center-block center-align">
                    <span class="cus-blue-text" id="left"></span>
                    <textarea class="center-align" maxlength="500" name="body" id="body" class="materialize-textarea">{{Input::old('body', $blog->body)}}</textarea>
                </div>

                <div class="input-field col s6 center center-block center-align">
                    <p>
                        {{ Form::radio('color', '0', true, array('id' => 'none')); }}
                        {{ Form::label('none', "None") }}
                    </p>
                    <p>
                        {{ Form::radio('color', '1', Input::old('color', $blog->color==1), array('id' => 'red')); }}
                        {{ Form::label('red', "Red") }}
                    </p>
                    <p>
                        {{ Form::radio('color', '2', Input::old('color', $blog->color==2), array('id' => 'green')); }}
                        {{ Form::label('green', "green") }}
                    </p>
                    <p>
                        {{ Form::radio('color', '3', Input::old('color', $blog->color==3), array('id' => 'blue')); }}
                        {{ Form::label('blue', "blue") }}
                    </p>
                </div>

                <div class="input-field col s6 center center-block center-align">
                    <p class="flow-text center-align">
                        {{ Form::checkbox('private', '1', Input::old('private', $blog->private==1), array('id' => 'private')); }}
                        {{ Form::label('private', "Post Privately?") }}
                    </p>
                    <p class="flow-text center-align">
                        {{ Form::checkbox('random', '1', Input::old('random', $blog->random==1), array('id' => 'random')); }}
                        {{ Form::label('random', "Include in random find?") }}
                    </p>
                </div>

                <div class="input-field col s12 center center-block center-align">
                    {{ Form::submit('Submit',array('class' => 'btn btn-flat green white-text waves-light')) }}
                </div>

            </div>

        </div>
    </form>
</div>
@if(Auth::check())
    <div class="fixed-action-btn" style="bottom: 35px; right: 14px;">
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
{{ HTML::script('ck2/ckeditor.js') }}
<script>
    CKEDITOR.replace( 'body', {
        width : '100%',
        height: screen.height/2 + "px",
//        uiColor: '#2196F3',
        codeSnippet_theme : 'monokai_sublime'

    });
    var editor = CKEDITOR.instances["body"] ;
    editor.on( 'contentDom', function() {
        var editable = editor.editable();

        editable.attachListener( editor.document, 'keyup', function(e) {

            var str = CKEDITOR.instances.body.getData();
            str = str.length - 7;

            if(str < 0) {
            str = 0;

            }
            document.getElementById("left").innerHTML = 5000 - str + '<small> characters left</small>';

        } );
    } );




</script>

@stop