@extends('main')

@section('content')
<style>
    #content img{
        max-width: 100%;
        height:auto;
        /*margin-left: auto;*/
        /*margin-right: auto;*/
        /*display: block;*/
    }
</style>

<div class="container" style="margin-top:20px;min-height:400px;">

        <div class="row">

            <div class="col m10 s12">
                @if(Session::has('success'))
                <p class="green-text green lighten-5 center-align">{{ Session::get('success') }}</p>
                @endif

                @if(count($blogs)>0)
                    @foreach($blogs as $blog)
                    <div class="">
                        <div class="card-panel
                        @if($blog->color==1)red-text red
                        @elseif($blog->color==2)green-text green
                        @elseif($blog->color==3)blue-text blue
                        @else
                        black-text white
                        @endif
                        lighten-5" id="content">
                            <div class="" style="word-break: break-word;">
                                <div class="left">
                                    <h6 style="margin-bottom:0px;" class="left-align flow-text">{{$blog->title}} &nbsp;<small><sub><em>{{$blog->tag}}</em></sub></small></h6>
                                    <small class="left-align"><em>By: {{ $blog->name }}</em></small>
                                </div>
                                <div class="right-align">
                                    <div class="row">
                                        <br>
                                        <small class="right"><em>{{ $blog->created_at }}</em></small>
                                        <br>

                                        <span class="right-align"><a href="{{ URL::to("edit/$blog->id") }}"><i class="grey-text mdi-editor-mode-edit"></i></a></span>
                                        <span class="right-align"><a class="modal-trigger" href="#delete_modal_{{ $blog->id }}"><i class="red-text mdi-action-delete"></i></a></span>
                                    </div>
                                </div>




                                <div class="clearfix divider"></div>
                                <p class="">{{$blog->body}}</p>
                            </div>
                        </div>

                    </div>

                    @endforeach
                    {{ $blogs->links('pagination::simple') }}
                @else

                <div class="valign-wrapper col s12 grey lighten-5 z-depth-1-half" style="min-height: 500px">
                    <div class="container">
                        <div class="row center">
                            <h4 class="center-align flow-text">You have no posts yet</h4>
                            <p class="green-text flow-text">Make your <a href="{{ URL::to('create') }}" class="btn-">first</a> post now!</p>
                        </div>
                    </div>
                </div>

                @endif
             </div>
            <div class="col s12 m2">
                @if(count($top)>0)
                <span class="flow-text center-align">Trends</span>
                <ul class="yellow lighten-5 z-depth-1-half card-panel">
                    @foreach($top as $tag)
                        <li><a href="{{ URL::to("tag/$tag->tag") }}"> {{ $tag->tag }} </a></li>
                    @endforeach
                </ul>
                @else
                <p class="center-align">No Trending!</p>
                @endif
            </div>
        </div>

</div>
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
<script src="ck/ckeditor2.js"></script>

@if(count($blogs)>0)
    @foreach($blogs as $blog)
        <div id="delete_modal_{{ $blog->id }}" class="modal">
            <div class="modal-content">
                <p class="flow-text center-align">Delete this part?</p>
                <div class="row">
                    <div class="row input-field col s12 m6 offset-m3">
                        <a class="right-align block red-text waves-effect btn-flat modal-close">
                            <i class="left red-text mdi-navigation-close"></i> Wait! No!
                        </a>
                        <a href="{{ URL::to("delete_action/$blog->id") }}" type="submit" class="left-align green-text waves-effect btn-flat">
                            <i class="left green-text mdi-navigation-arrow-forward"></i> Yes,Delete it!
                        </a>
                    </div>
                </div>

            </div>

        </div>
    @endforeach
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