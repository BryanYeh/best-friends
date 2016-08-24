<article class="post" data-postid="{{ $post->id }}">
    @markdown($post->body)
    <div class="info">
        Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
    </div>
    <div class="interaction">
        <a href="#"
           class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'}}</a>
        |
        <a href="#"
           class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You hate this post' : 'Hate' : 'Hate'}}</a>
        @if(Auth::user() == $post->user)
            |
            <a class="edit-link" href="#">Edit</a> |
            <a href="{{ route('post.delete',['post_id' => $post->id]) }}">Delete</a>
        @endif
    </div>
</article>