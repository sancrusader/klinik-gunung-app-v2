<x-layout>
    <x-slot:title>Register</x-slot:title>
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-10">
                    <form action="{{ route('register') }}" method="POST"
                        class="flex flex-col w-full h-full pb-6 text-center rounded-3xl">
                        <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Sign Up</h3>
                        <p class="mb-4 text-grey-700">Create Your Account</p>
                        @csrf

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

                        {{-- Name --}}
                        <label for="name" class="mb-2 text-sm text-start text-grey-900">Full Name</label>
                        <input type="text" id="name" name="name"
                            class="flex border items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
                            placeholder="Full Name" required>

                        {{-- Email --}}
                        <label for="email" class="mb-2 text-sm text-start text-grey-900">Email</label>
                        <input id="email" type="email" placeholder="mail@example.com"
                            class="flex border items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
                            required name="email" />


                        {{-- Password --}}
                        <label for="password" class="mb-2 text-sm text-start text-grey-900">Password</label>
                        <input id="password" type="password" placeholder="Enter a password"
                            class="flex border items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
                            required name="password" />

                        <label for="password" class="mb-2 text-sm text-start text-grey-900">Confirm Password</label>
                        <input id="password" type="password" name="password_confirmation"
                            placeholder="Enter a password"
                            class="flex border items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
                            required />
                        <div id="passwordRequirements" class="text-left" style="display: none">
                            <ul>
                                <li id="minLength"><i
                                        class="fas fa-times 
                                        text-red-500"></i>
                                    Minimum 8 characters</li>
                                <li id="uppercase"><i
                                        class="fas fa-times 
                                        text-red-500"></i>
                                    At
                                    least one uppercase letter</li>
                                <li id="lowercase"><i
                                        class="fas fa-times
                                         text-red-500"></i>
                                    At
                                    least one lowercase letter</li>
                                <li id="symbol"><i
                                        class="fas fa-times
                                         text-red-500"></i>
                                    At
                                    least one symbol (@$!%*?&)</li>
                            </ul>
                        </div>

                        <input type="hidden" name="role" value="pendaki">
                        <div class="flex flex-row justify-between mb-8">
                            <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                <input type="checkbox" checked value="" class="sr-only peer">
                                <div
                                    class="w-5 h-5 bg-white border-2 rounded-sm border-grey-500 peer peer-checked:border-0 peer-checked:bg-purple-blue-500">
                                    <img class=""
                                        src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/icons/check.png"
                                        alt="tick">
                                </div>
                                <span class="ml-3 text-sm font-normal text-grey-900">Keep me logged in</span>
                            </label>
                            <a href="/forgot-password" class="mr-4 text-sm font-medium text-purple-blue-500">Forget
                                password?</a>
                        </div>
                        <button type="submit"
                            class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-2xl bg-gradient-to-t from-blue-600 to-blue-500">Create
                            Account</button>
                        <p class="text-sm leading-relaxed text-grey-900">Already have an account? <a href="/login"
                                class="font-bold text-grey-700">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
