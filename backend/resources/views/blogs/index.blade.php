
<h1>Blogs</h1>
<ul>
    @foreach ($blogs as $blog)
        <li class="m-5"> 
            <a href={{ route('blogs.show', $blog['id'] ) }}> {{ $blog['title'] }}</a>
            {{ $blog['user_name'] }}
            {{ $blog['comments_count'] }} 件のコメント
            <small> {{ $blog['created_at'] }} </small>
            <small> {{ $blog['updated_at'] }} </small>
        </li>
    @endforeach
</ul>