<x-layout>
    <x-slot:title>Register</x-slot:title>
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-10">
                    <form action="{{ route('register') }}" method="POST"
                        class="flex flex-col w-full h-full pb-6 text-center rounded-3xl">
                        <x-auth.header-auth>Sign Up</x-header-auth>
                            {{-- <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Sign Up</h3> --}}
                            <p class="mb-4 text-grey-700">Create Your Account</p>
                            @csrf

                            <x-auth-alert />

                            {{-- Name --}}
                            <x-form.label for="name" id="Name" />
                            <x-form.input type="name" name="name" placeholder="Full Name" />

                            {{-- Email --}}
                            <x-form.label for="email" id="Email" />
                            <x-form.input type="email" name="email" placeholder="Your Email" />

                            {{-- Password --}}
                            <x-form.label for="password" id="Password" />
                            <x-form.input type="password" name="password" placeholder="Password" />

                            <x-form.label for="password" id="Password" />
                            <x-form.input type="password" name="password_confirmation"
                                placeholder="Confirmation Password" />

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

                            <input type="hidden" name="role" value="pasien">
                            <div class="flex flex-row justify-between mb-8">
                                <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                    <input type="checkbox" checked value="" class="sr-only peer">
                                    <div
                                        class="w-5 h-5 bg-white border-2 rounded-sm border-grey-500 peer peer-checked:border-0 peer-checked:bg-purple-blue-500">
                                        <img class=""
                                            src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/icons/check.png"
                                            alt="tick">
                                    </div>

                                    <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                                        class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                        required>
                                    <label for="remember" class="font-medium text-gray-900 dark:text-white">&nbsp; I
                                        accept
                                        the <a href="#"
                                            class="text-primary-700 hover:underline dark:text-primary-500">Terms
                                            and Conditions</a></label>

                                </label>

                            </div>
                            <x-form.primary-button>Create Account</x-form.primary-button>
                            <p class="text-sm leading-relaxed text-grey-900">Already have an account? <a
                                    href="{{ route('login') }}" class="font-bold text-grey-700">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
