<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Create New Post</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <!-- Title -->
                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" required autofocus />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" class="block mt-1 w-full" rows="5" required></textarea>
                </div>

                <!-- Image Upload -->
                <div>
                    <x-input-label for="image" value="Image" />
                    <input type="file" id="image" name="image" class="block mt-1 w-full" onchange="previewImage(event)" />
                </div>

                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <x-input-label value="Image Preview" />
                    <img id="preview" src="#" alt="Image Preview" class="w-full h-64 object-cover rounded-lg mt-2" />
                </div>

                <!-- URL -->
                <div>
                    <x-input-label for="url" value="URL" />
                    <x-text-input id="url" name="url" type="url" class="block mt-1 w-full" required />
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <x-primary-button>Save Post</x-primary-button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
              
                const preview = document.getElementById('preview');
                preview.src = e.target.result;

               
                document.getElementById('imagePreview').classList.remove('hidden');
            };

            if (file) {
                reader.readAsDataURL(file); 
            }
        }
    </script>
</x-app-layout>
