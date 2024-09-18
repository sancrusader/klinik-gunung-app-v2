<x-community.layout>
    <form action="{{ route('community.storeTopic') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Judul Topik</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat
            Topik</button>
    </form>
    <div class="w-full h-screen flex flex-col bg-white p-4">
        <div class="flex items-center mb-4">
            <button onclick="window.history.back()"
                class="ml-0 w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-100">
                <!-- Back Button Icon -->
                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="ml-4 text-lg font-semibold">New Post</h1>
        </div>

        <div class="flex space-x-4s">
            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                <!-- Placeholder for Profile Icon -->
                <img class="w-12 h-12 rounded-full" src="{{ Auth::user()->getProfilePhotoUrl() }}" alt="User Avatar">
            </div>
            <form action="{{ route('community.storeTopic') }}" class="w-full" method="POST">
                <textarea class="ml-4 w-full h-24 text-lg border-none outline-none placeholder-gray-500 resize-none flex-grow"
                    placeholder="What's happening?"></textarea>
                <div id="imageContainer" class="relative hidden">
                    <img id="imagePreview" src="#" alt="Image Preview" style=" width: 450px;"
                        class="rounded-lg" />
                    <button type="button" id="removeImage"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="flex space-x-4 mb-4">
                    <label for="fileInput" class="text-blue-500 hover:bg-blue-100 p-2 rounded-full cursor-pointer">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.5 1.25C18.9142 1.25 19.25 1.58579 19.25 2V4.75H22C22.4142 4.75 22.75 5.08579 22.75 5.5C22.75 5.91421 22.4142 6.25 22 6.25H19.25V9C19.25 9.41421 18.9142 9.75 18.5 9.75C18.0858 9.75 17.75 9.41421 17.75 9V6.25H15C14.5858 6.25 14.25 5.91421 14.25 5.5C14.25 5.08579 14.5858 4.75 15 4.75H17.75V2C17.75 1.58579 18.0858 1.25 18.5 1.25Z"
                                fill="#000000" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 1.25L11.9426 1.25C9.63423 1.24999 7.82519 1.24998 6.41371 1.43975C4.96897 1.63399 3.82895 2.03933 2.93414 2.93414C2.03933 3.82895 1.63399 4.96897 1.43975 6.41371C1.24998 7.82519 1.24999 9.63423 1.25 11.9426V12.0574C1.24999 14.3658 1.24998 16.1748 1.43975 17.5863C1.63399 19.031 2.03933 20.1711 2.93414 21.0659C3.82895 21.9607 4.96897 22.366 6.41371 22.5603C7.82519 22.75 9.63423 22.75 11.9426 22.75H12.0574C14.3658 22.75 16.1748 22.75 17.5863 22.5603C19.031 22.366 20.1711 21.9607 21.0659 21.0659C21.9607 20.1711 22.366 19.031 22.5603 17.5863C22.75 16.1748 22.75 14.3658 22.75 12.0574V12C22.75 11.5858 22.4142 11.25 22 11.25C21.5858 11.25 21.25 11.5858 21.25 12C21.25 14.3782 21.2484 16.0864 21.0736 17.3864C21.0667 17.4377 21.0596 17.4882 21.0522 17.5378L18.2782 15.0412C16.9788 13.8718 15.0437 13.7553 13.6134 14.7605L13.3152 14.9701C12.8182 15.3193 12.1421 15.2608 11.7125 14.8313L7.42282 10.5415C6.28741 9.40612 4.46613 9.34547 3.25771 10.4028L2.75098 10.8462C2.75552 9.05395 2.78124 7.69302 2.92637 6.61358C3.09825 5.33517 3.42514 4.56445 3.9948 3.9948C4.56445 3.42514 5.33517 3.09825 6.61358 2.92637C7.91356 2.75159 9.62177 2.75 12 2.75C12.4142 2.75 12.75 2.41421 12.75 2C12.75 1.58579 12.4142 1.25 12 1.25ZM2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.2487 19.7617 20.4479 19.4814 20.6096 19.1404C20.5707 19.1166 20.5334 19.089 20.4983 19.0574L17.2747 16.1562C16.4951 15.4545 15.334 15.3846 14.4758 15.9877L14.1776 16.1973C13.0843 16.9657 11.5968 16.8369 10.6519 15.8919L6.36216 11.6022C5.78515 11.0252 4.85958 10.9944 4.24546 11.5317L2.75038 12.8399C2.75296 14.7884 2.77289 16.2448 2.92637 17.3864Z"
                                fill="#000000" />
                        </svg>
                    </label>
                    <input id="fileInput" type="file" class="hidden">
                </div>
        </div>

        <div class="mt-auto flex items-center justify-between border-t border-gray-300 pt-4">
            <span class="text-gray-400 text-sm">Siapa pun bisa membalas & mengutip</span>
            <button class="bg-blue-500 text-white rounded-full px-4 py-2">Kirim</button>
        </div>
        </form>
    </div>
    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('imagePreview');
                    const container = document.getElementById('imageContainer');
                    img.src = e.target.result;
                    container.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('removeImage').addEventListener('click', function() {
            document.getElementById('fileInput').value = ''; // Clear the file input
            document.getElementById('imagePreview').src = '#'; // Clear the image source
            document.getElementById('imageContainer').classList.add('hidden'); // Hide the image container
        });
    </script>
</x-community.layout>
