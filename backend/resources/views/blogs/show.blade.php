<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
<h1> {{ $blog['title'] }} </h1>
<div> {{ $blog['body'] }} </div>

<p>ユーザー: {{ $blog['user_name'] }}</p>
<h2>コメント</h2>
@foreach ($comments as $comment)
    <hr>
    <p>{{ $comment['user_name'] }} ({{ $comment['created_at'] }})</p>
    <p> {{ $comment['body'] }} </p>
@endforeach
