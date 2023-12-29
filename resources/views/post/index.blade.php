
   <!-- Posts Section -->
   <x-app-layout :meta-title="'The RahatBlog - Posts by Category '.$category->title"
    meta-description="Rahat's Personal Blog about world' . $category->title" meta-keyword="Personal Blog, blog">

  <div class="container mx-auto flex flex-wrap py-6">

      <!-- Posts Section -->
      <section class="w-full md:w-2/3  px-3">
          <div class=" flex flex-col items-center">
              @foreach($posts as $post)
                  <x-post-item :post="$post"/>
              @endforeach
          </div>
          {{ $posts->links() }}
      </section>

      <!-- Sidebar Section -->
      <x-sidebar />

  </div>
</x-app-layout>
