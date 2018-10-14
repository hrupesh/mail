@extends('master')
@section('title')
{{ Auth()->user()->First_Name }}
@endsection
@section('content')
<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&#x274E;</button>
            <h4 class="modal-title">Edit your post </h4>
          </div>
          <form action="{{ route('edit') }}" method="post" >
          <div class="modal-body">
                <div class="form-group">
                    <label for="post-edit-body">Edit Post</label>
                    <textarea class="form-control" id="editedbody" name="editedbody" rows="5" ></textarea>
                </div>
                    </div>
                <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-default" id="modal-save" >Save</button>
            <input type="hidden" value="{{ Session::token()  }}" name="_token">
            <input type="hidden" name="p_id" id="p_id">
            <input type="hidden" name="post_ID" id="post_ID">
                </form>
                </div>
                    </div>
             
        
      </div>
    </div>
    
  </div>
  <form action"#" >
      <input type="hidden" name="p_id" id="p_id">
      <input type="hidden" name="post_ID" id="post_ID">
  </form>
    <div class="container row">
        <div class="well col-md-6 col-md-offset-10" ><h4 style="padding-left: 100px;">Welcome {{ Auth::user()->First_Name }}</h4></div>
    </div>
    <section class="row new-post active">
        <div class="col-md-6 col-md-offset-3">
            <header><h2><i>So , What you upto ..... </i></h2></header>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group {{$errors->has('post') ? 'has-error' : ''}}">
                    <textarea class="textarea form-control" name="post" id="post" rows="5" placeholder="Type Here..........." ></textarea>
                </div>

                @include('includes.message')

                <button type="submit" class="btn btn-danger btn-lg btn-block">Post</button>
                <input type="hidden" value="{{ Session::token()  }}" name="_token">
            </form>
        </div>
    </section>
    @if(count($posts)>0)
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Friends are saying these :-</h3></header>
            @foreach($posts as $post)
            <article class="post" data-postid="{{ $post->id }}"> 
                <div class="hidden">
                    {{ $dp = $post->user->pic }}
                </div>
                    <table>
               <th><img style="height:80px;width:80px;" class="img-circle image-responsive" src="{{ URL::to('/storage/'.$dp) }}" >
               </th>
               <th style="padding-left:15px;">
               <h2 style="font: 400 50px/1.3 'Oleo Script', Helvetica, sans-serif;
                            color: #1a1a1a;
                            text-shadow: 4px 4px 0px rgba(0,0,0,0.15);">
                            {{ $post->user->First_Name }}
               </th>
                        </h2></table>
                <div class="info" style="font: 400 25px/1.3 'Lobster Two', Helvetica, sans-serif;
                                        color: #f44545;
                                        text-shadow: 2px 2px 2px #ededed, 4px 4px 0px rgba(255, 255, 255, 0.5);">
                                        {{ $post->post }} 
                </div>
                <div class="info"> {{ $post->created_at }} </div>
                <div class="interaction">
                    <p id="text"></p>
                    <a href="{{ route('post.like',['$p_id' => $post->id]) }}" class="glyphicon glyphicon-thumbs-up" >{{ $post->likes()->pluck('like') }}</a>   |
                    <a href="{{ route('post.dislike',['$p_id' => $post->id]) }}" class="glyphicon glyphicon-thumbs-down" >{{ $post->likes()->pluck('dislike') }}</a>   |
                    @if(Auth::user() == $post->user)
                    <a href="#" class="edit glyphicon glyphicon-pencil"></a>   |
                    <a href="{{ route('post.delete',['$post_id' => $post->id]) }}" class="glyphicon glyphicon-trash"></a>
                    @endif
                </div>
            </article>
            @endforeach
            {{ $posts->links() }}
        </div>
    </section>
    @else
    <div class="container">
        <div class="well">
            <h3>Sorry your friends have not posted anything yet </h3>
        </div>
    </div>
    @endif
    
      <script>
                
        $(document).ready(function(){
            $(".post").find('.interaction').find('.edit').click(function(event){
                event.preventDefault();
                var postBody = event.target.parentNode.parentNode.childNodes[5].textContent;
                postId = event.target.parentNode.parentNode.dataset['postid'];
                $('#editedbody').val(postBody);
                $('#p_id').val(postId);
                $("#myModal").modal();
            });
        });

          /*  $(".post").find(".interaction").find(".like").click(function(event){
                postID = event.target.parentNode.parentNode.dataset['postid'];
                window.alert(postID);
                $("#text").val(postID);
                
            });*/
        
       /* BalloonEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );*/
        </script>
@endsection