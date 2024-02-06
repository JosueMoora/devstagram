    @if ($posts->count())
        <section class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach ($posts as $post)
                <div
                    class="bg-white dark:bg-[#1a202c] border dark:border-none border-gray-200 dark:border-gray-800 rounded-lg shadow-md">
                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                        <img class="w-full h-80 object-cover rounded-t-lg" src="{{ asset('uploads/' . $post->image) }}"
                            alt="{{ $post->title }}">
                        <div class="p-5">
                            @if(Route::currentRouteName() !== 'posts.index')
                            <p class="text-gray-800 dark:text-gray-300 font-bold text-lg">
                                {{ $post->user->username }}
                            </p>
                            @endif
                            <p class="text-gray-800 dark:text-gray-300 text-lg font-bold">
                                {{ $post->title }}
                            </p>
                            <span class="font-normal text-sm">
                                {{ $post->description }}
                            </span>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>
        <section class="mt-10">
            {{ $posts->links('pagination::tailwind') }}
        </section>
    @else
        <p class="text-gray-600 uppercase text-sm font-bold text-center ">No hay publicaciones, sigue a otros usuarios,
            para ver sus publicaciones</p>
    @endif