<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Posts</h1>
        <a href="{{ route('posts.create') }}"
            class="inline-flex items-center ">
            <x-primary-button>
            Create New Post
            </x-primary-button>
        </a>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6 ">
            @foreach ($posts as $post)
                <div
                    class=" rounded-lg overflow-hidden ring-2 hover:">

                    <div class="relative">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->image }}"
                            class="w-full h-48 object-cover">
                    </div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h2>
                        <p class="text-gray-600 mt-2">{{ Str::limit($post->description, 100) }}</p>
                        <div class="mt-4  flex justify-between items-center ">
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:text-blue-800">
                                <x-secondary-button>
    
                                    Edit
                                </x-secondary-button>
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit"
                                    class="text-red-600 hover:text-red-800">Delete</x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
