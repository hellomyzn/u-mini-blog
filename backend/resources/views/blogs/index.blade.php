<x-app-layout>
    <h1>Blogs</h1>

    <ul>
        @foreach ($blogs as $blog)
            <li class="m-5"> 
                {{ $blog['title'] }} 
                {{ $blog['user_name'] }}
            </li>
        @endforeach
    </ul>
</x-app-layout>