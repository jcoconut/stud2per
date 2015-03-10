@extends('main')

@section('content')

<div class="container" style="margin-top:20px;">
    <div class="red lighten-5 red-text">
        <ul class="center-align">
            <p style="margin:0"><?php echo $errors->create->first('title'); ?></p>
            <p style="margin:0"><?php echo $errors->create->first('body'); ?></p>

        </ul>

    </div>
    {{Form::open(array('url' => 'create_action','class'=>'row', 'id' => 'create_form'))}}

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
                    {{ Form::text('title', Input::old('title'), array('id' => 'title', 'class' => 'validate')) }}
                    {{ Form::label('title', "Title") }}
                </div>
                <div class="input-field col s12 m4 center center-block center-align">
                    <i class="mdi-action-bookmark-outline prefix"></i>
                    {{ Form::text('tag', Input::old('tag'), array('id' => 'tag', 'class' => 'validate')) }}
                    {{ Form::label('tag', "What's it all about?") }}


                </div>
                <div class="input-field col s12 center center-block center-align">
                    <span class="cus-blue-text" id="left"></span>
                    {{--{{ Form::text('body', Input::old('body'), array('id' => 'body', 'class' => 'center-align')) }}--}}
                    <textarea class="center-align" maxlength="500" name="body" id="body" class="materialize-textarea">{{Input::old('body')}}</textarea>
                </div>

                <div class="input-field col s6 center center-block center-align">
                    <p>
                        {{ Form::radio('color', '0', true, array('id' => 'none')); }}
                        {{ Form::label('none', "None") }}
                    </p>
                    <p>
                        {{ Form::radio('color', '1', false, array('id' => 'red')); }}
                        {{ Form::label('red', "Red") }}
                    </p>
                    <p>
                        {{ Form::radio('color', '2', false, array('id' => 'green')); }}
                        {{ Form::label('green', "green") }}
                    </p>
                    <p>
                        {{ Form::radio('color', '3', false, array('id' => 'blue')); }}
                        {{ Form::label('blue', "blue") }}
                    </p>
                </div>

                <div class="input-field col s6 center center-block center-align">
                    <p class="flow-text center-align">
                        {{ Form::checkbox('private', '1', false, array('id' => 'private')); }}
                        {{ Form::label('private', "Post Privately?") }}
                    </p>
                    <p class="flow-text center-align">
                        {{ Form::checkbox('random', '1', true, array('id' => 'random')); }}
                        {{ Form::label('random', "Include in random find?") }}
                    </p>
                </div>

                <div id="loader_area" class="input-field col s12 center center-block center-align">
                    {{ Form::submit('Submit',array('class' => 'btn btn-flat green white-text waves-light', 'id' => 'remove_click')) }}
                </div>

            </div>

        </div>
    </form>
</div>
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

@section('extra')
<script>
$("#remove_click").click(function(){
    $(this).remove();
    $("#create_form").submit();
    var elem = "<div class='progress'><div class='indeterminate'></div></div>";
    $("#loader_area").after(elem);

});
</script>
        @stop