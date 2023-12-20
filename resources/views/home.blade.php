<x-app-layout meta-description="Rahat's Personal Blog about world" meta-keyword="Personal Blog, blog">
    <div class="container max-w-3xl mx-auto p-6">
        <div class="flex flex-wrap -mx-4">
        <!-- Latest Post (2/3 width) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <h2 class="text-lg sm:text-xl ml-4 font-bold text-green-500 uppercase pb-1 border-b-2 border-green-500 mb-3">
                Latest Post
            </h2>
            <x-post-item :post="$latestPost"/>
        </div>

        <!-- Popular 3 posts (1/3 width) -->
        <div class="w-full md:w-1/3 px-4 mb-4">
            <h2 class="text-lg sm:text-xl font-bold text-green-500 uppercase pb-1 border-b-2 border-green-500 mb-3">
                Popular Posts
            </h2>
            @foreach($popularPosts as $post)
            <div class="flex grid grid-cols-4 gap-2 mb-4">
                <a href="#" class="p-2">
                    <img src="{{$post->getThumbnail()}}" class="h-32 w-full  pr-6" alt="{{$post->title}}"/>
                </a>
                <div class="col-span-3 pt-4">
                    <a href="#">
                        <h3 class="font-bold uppercase whitespace-nowrap truncate">{{$post->title}}</h3>
                    </a>
                    <div class="flex gap-4 mb-2">
                        @foreach ($post->categories as $category)


                        <a href="#" class="bg-green-500 text-green p-1 rounded text-xs font-semibold uppercase">
                            {{$category->title}}
                        </a>
                        @endforeach
                    </div>
                    <div class="flex gap-4 mb-2">
                            <a href="#" class="bg-green-500 text-white p-1 rounded text-xs font-bold uppercase">

                            </a>
                    </div>
                    <div class="text-xs">
                        {{$post->shortBody(10)}}
                    </div>
                    <a href="#" class="text-xs font-bold uppercase text-gray-800 hover:text-black">Continue
                        Reading <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach -->
        </div>
    </div>
        <!-- Recommended posts -->
        <div class="col-span-3 md:col-span-1 mb-8">
            <h2 class="text-lg sm:text-xl font-bold text-green-500 uppercase pb-1 border-b-2 border-green-500 mb-3">
                Recommended Posts
            </h2>
            <!-- Content for recommended posts goes here -->
        </div>

        <!-- Latest Categories -->
        <div class="col-span-3 md:col-span-1">
            <h2 class="text-lg sm:text-xl font-bold text-green-500 uppercase pb-1 border-b-2 border-green-500 mb-3">
                Latest Category
            </h2>
            <!-- Content for latest categories goes here -->
        </div>
    </div>


</x-app-layout>
