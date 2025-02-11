
<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" value="{{ old('title', $post->title) }}" required autofocus />
                </div>
                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" class="block mt-1 w-full" rows="5" required>{{ old('description', $post->description) }}</textarea>
                </div>
                <div>
                    <x-input-label for="image" value="Image" />
                    <input type="file" id="image" name="image" class="block mt-1 w-full" />
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-32 object-cover mt-4">
                    @endif
                </div>
                <div>
                    <x-input-label for="url" value="URL" />
                    <x-text-input id="url" name="url" type="url" class="block mt-1 w-full" value="{{ old('url', $post->url) }}" required />
                </div>
                <div class="mt-4">
                    <x-primary-button>Update Post</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
