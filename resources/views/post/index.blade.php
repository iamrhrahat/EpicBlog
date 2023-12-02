   <?php
   /** @var $posts \Illuminate\Pagination\LengthAwarePaginator */
   ?>
   <!-- Posts Section -->
   <x-app-layout :meta-title="'The RahatBlog - Posts by Category '.$category->title" meta-description="Rahat's Personal Blog about world" meta-keyword="Personal Blog, blog">
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

@foreach ($posts as $post)
        <x-post-item :post="$post"></x-post-item>
@endforeach

        {{$posts->onEachSide(1)->links()}}

    <!-- Pagination -->


</section>
<!-- Sidebar Section -->
<x-sidebar/>
</x-app-layout>
