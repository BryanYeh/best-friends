@extends('layouts.master')

@section('content')


    <div class="col-md-6 col-md-offset-3">
        @include('includes.message-block')
    </div>

   <section = "row new-post">
      <div class="col-md-6 col-md-offset-3">
         <header>
            <h3>What do you have to say?</h3>
         </header>
         <form action="{{ route('post.create') }}" method="post">
            <div class="form-group">
              <textarea class="form-control" name="body" id="body" rows="5" placeholder="Your Post"></textarea>
            </div>
            {{ csrf_field() }}
            <button type="submit" name="submit" class="btn btn-primary">Create Post</button>
         </form>
      </div>
   </section>

   <section class="row posts">
      <div class="col-md-6 col-md-offset-3">
         <header>
            <h3>Whatever people say...</h3>
         </header>
         @foreach($posts as $post)
            <article class="post" data-postid="{{ $post->id }}">
                @markdown($post->body)
               <div class="info">
                  Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
               </div>
               <div class="interaction">
                  <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a> |
                  <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You hate this post' : 'Hate' : 'Hate'}}</a>
                  @if(Auth::user() == $post->user)
                  |
                  <a class="edit-link" href="#">Edit</a> |
                  <a href="{{ route('post.delete',['post_id' => $post->id]) }}">Delete</a>
                  @endif
               </div>
            </article>
         @endforeach

      </div>
   </section>

   <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title" id="">Edit Post</h4>
         </div>
         <div class="modal-body">
            <form>
               <div class="form-group">
                 <label for="post-body"></label>
                 <textarea name="post-body" id="post-body" rows="8" class="form-control"></textarea>
               </div>
            </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary" id="modal-save">Save Changes</button>
         </div>
       </div>
     </div>
   </div>

   <script>
      var token = '{{ csrf_token() }}';
      var urlEdit = '{{ route('edit') }}';
      var urlLike = '{{ route('like') }}';
   </script>
@endsection
