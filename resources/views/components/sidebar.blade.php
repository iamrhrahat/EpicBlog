<aside class="w-full md:w-1/3 flex flex-col items-center px-3">

    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <h3 class="text-xl font-semibold mb-3">All Categories

        </h3>
        @foreach ($categories as $category)
        <a href="{{ route('by-category', ['category' => $category]) }}"
           class="text-semibold block py-3 pl-4 rounded {{ (request('category') && request('category')?->slug == $category->slug)
           ? 'bg-green-600 text-white' : '' }}">
            {{ $category->title }} ({{ $category->total }})
        </a>
    @endforeach

    </div>


    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <p class="text-xl font-semibold pb-5">
            {{ \App\Models\TextWidget::getTitle('about-us-sidebar')}}
        </p>
        {!! \App\Models\TextWidget::getContent('about-us-sidebar') !!}
        <a href="{{route('about-us')}}" class="w-full bg-green-800 text-white font-bold text-sm uppercase rounded hover:bg-green-700 flex items-center justify-center px-2 py-3 mt-4">
            Get to know us
        </a>
    </div>



</aside>
