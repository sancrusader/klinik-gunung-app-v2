<x-community.layout>
    <div class="bg-gray-800">
        <div
            class="w-full  p-4 bg-white border border-gray-200 shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-10">
            <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                <div class="p-4 mb-4 bg-white sm:p-6 dark:border-gray-700 dark:bg-gray-800  xl:mb-0">
                    <!-- Chat -->
                    <article class="mb-5 border-b border:gray-100 dark:border-gray-600">
                        <footer class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <p
                                    class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                    <img class="w-6 h-6 mr-2 rounded-full"
                                        src="/storage/{{ $topic->user->profile_photo_path }}"
                                        alt="Bonnie avatar">{{ $topic->user->name }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">
                                        {{ $topic->created_at->diffForHumans() }}</time></p>
                            </div>
                            @if ($topic->user_id === auth()->id())
                                <button id="dropdownComment2Button" data-dropdown-toggle="dropdownComment2"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white   focus:outline-none dark:bg-gray-800  dark:hover:text-gray-300 dark:focus:ring-gray-600"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                        </path>
                                    </svg>
                                    <span class="sr-only">Comment settings</span>
                                </button>
                                <!-- Dropdown menu -->

                                <div id="dropdownComment2"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-36 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownMenuIconHorizontalButton">

                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>


                                        <li>
                                            <a href="{{ route('community.delete', $topic->id) }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </footer>
                        <p class="mb-3 text-gray-900 dark:text-white font-semibold">{{ $topic->title }}</p>
                        <p class="mb-2 text-gray-900 dark:text-white">
                            {{ $topic->description }}
                        </p>
                    </article>

                    @foreach ($topic->comments as $comment)
                        <article class="pl-6 mb-5">
                            <footer class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <p
                                        class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                        <img class="w-6 h-6 mr-2 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"alt="Joseph avatar">{{ $comment->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                            datetime="2022-02-08" title="February 8th, 2022">
                                            {{ $comment->created_at->diffForHumans() }}</time>
                                    </p>
                                </div>
                                <button id="dropdownComment4Button" data-dropdown-toggle="dropdownComment4"
                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:ring-gray-600"
                                    type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                        </path>
                                    </svg>
                                    <span class="sr-only">Comment settings</span>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownComment4"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-36 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownMenuIconHorizontalButton">
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </footer>
                            <p class="mb-2 text-gray-900 dark:text-white">
                                {{ $comment->body }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <h2>Komentar</h2>
        @foreach ($topic->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">

                    @foreach ($comment->replies as $reply)
                        <div class="ml-4 mt-2">
                            <p>{{ $reply->body }}</p>
                            <p>Oleh: {{ $reply->user->name }}</p>
                        </div>
                    @endforeach

                    <form action="{{ route('community.storeReply', $comment->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="body">Balas</label>
                            <textarea name="body" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Balas</button>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- <form action="{{ route('community.storeComment', $topic->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="body">Komentar</label>
                <input type="text" value="{{ $topic->id }}" name="topic_id">
                <textarea name="body" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
        </form> --}}
    </div>
</x-community.layout>
