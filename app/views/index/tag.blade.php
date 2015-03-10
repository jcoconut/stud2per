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

            <div class="col s12 m10">
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
                            <div class="row">
                                <h6 style="margin-bottom:0px;" class="flow-text">{{$blog->title}} &nbsp;<small><sub><em>{{$blog->tag}}</em></sub></small></h6>
                                <small class="left"><em>By: You</em></small>
                                <small class="right"><em>{{ $blog->created_at }}</em></small>
                                <div class="clearfix divider"></div>
                                <p class="" style="word-wrap:break-word;">{{$blog->body}}</p>
                            </div>
                        </div>

                    </div>

                    @endforeach
                    {{ $blogs->links('pagination::simple') }}
                @else

                <div class="valign-wrapper col s12 grey lighten-5 z-depth-1-half" style="min-height: 500px">
                    <div class="container">
                        <div class="row center">
                            <h4 class="center-align red-text flow-text">Woops! Sorry!</h4>
                            <p class="flow-text">We haven't found anything having that tag :(</p>
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
    <a class="btn-floating btn-large red">
      <i class="large mdi-editor-mode-edit"></i>
    </a>
    <ul>
      <li><a href="{{ URL::to('create') }}" class="btn-floating red"><i class="large mdi-editor-insert-chart"></i></a></li>
      <li><a class="btn-floating yellow darken-1"><i class="large mdi-editor-format-quote"></i></a></li>
      <li><a class="btn-floating green"><i class="large mdi-editor-publish"></i></a></li>
      <li><a class="btn-floating blue"><i class="large mdi-editor-attach-file"></i></a></li>
    </ul>
  </div>
<script src="ck/ckeditor2.js"></script>
@stop