                        @if (session('success'))
                            <div class="mb-4 text-green-600">
                                {{ session('success') }}
                            </div>
                            <p class="mb-4"><a href="{{ route('verification.resend') }}"
                                    class="text-blue-500 hover:underline">klik di sini untuk mengirim ulang</a>.</p>
                        @endif
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-2 rounded mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
