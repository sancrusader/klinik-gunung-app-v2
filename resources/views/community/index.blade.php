    <x-dashboard.dashboard-layout>
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <div class="px-4 pt-6">
                    <h1
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        Komunitas Klinik Gunung</h1>
                    <hr>
                    @foreach ($topics as $topic)
                        <div class="card mb-3">
                            <div class="card-body">
                                <p>{{ $topic->user->name }}</p>

                                <h4>{{ $topic->title }}</h4>
                                <p>{{ $topic->description }}</p>
                                <a href="{{ route('community.show', $topic->id) }}" class="btn btn-secondary">Lihat
                                    Diskusi</a>
                                @if ($topic->user_id === auth()->id())
                                    <a href="{{ route('community.delete', $topic->id) }}" class="btn btn-secondary"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus topik ini?');">Hapus</a>
                                @endif
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
                <div class="container">

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

                </div>
    </x-dashboard.dashboard-layout>
