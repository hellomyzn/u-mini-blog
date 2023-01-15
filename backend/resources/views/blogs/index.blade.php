<x-app-layout>
    <h1>Blogs</h1>

    <ul>
        @foreach ($blogs as $item)
            <li class="m-5"> {{ $item->title }} </li>
        @endforeach
    </ul>
</x-app-layout>