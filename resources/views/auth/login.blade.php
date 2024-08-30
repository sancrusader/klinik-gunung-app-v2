<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-10">
                    <form action="{{ route('login') }}" method="POST"
                        class="flex flex-col w-full h-full pb-6 text-center rounded-3xl">
                        <x-auth.header-auth>Sign In</x-auth.header-auth>
                        <p class="mb-4 text-grey-700">Enter your email and password</p>
                        @csrf

                        <x-alert />

                        {{-- Email --}}
                        <x-form.label for="email" id="Email" />

                        <x-form.input type="email" name="email" placeholder="Your Email" />

                        {{-- Password --}}
                        <x-form.label for="password" id="Password" />

                        <x-form.input type="password" name="password" placeholder="Password" />

                        <div class="flex flex-row justify-between mb-8">
                            <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                <input type="checkbox" checked value="" class="sr-only peer">
                                <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                                    class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember
                                        me</label>
                                </div>
                            </label>
                            <a href="/forgot-password" class="mr-4 text-sm font-medium text-purple-blue-500">Forget
                                password?</a>
                        </div>
                        <x-form.primary-button>Sign In</x-form.primary-button>
                        <p class="text-sm leading-relaxed text-grey-900">Not registered yet? <a
                                href="{{ route('register') }}" class="font-bold text-grey-700">Create an Account</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
