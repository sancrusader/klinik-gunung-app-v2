<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-10">
                    <form action="{{ route('login') }}" method="POST"
                        class="flex flex-col w-full h-full pb-6 text-center rounded-3xl">
                        <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Sign In</h3>
                        <p class="mb-4 text-grey-700">Enter your email and password</p>
                        @csrf
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-2 rounded mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <label for="email" class="mb-2 text-sm text-start text-grey-900">Email</label>
                        <input id="email" type="email" placeholder="Your Email"
                            class="flex border items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
                            name="email" required />
                        <label for="password" class="mb-2 text-sm text-start text-grey-900">Password*</label>
                        <input id="password" name="password" type="password" placeholder="Enter a password"
                            class="flex border items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl"
                            required />
                        <div class="flex flex-row justify-between mb-8">
                            <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                <input type="checkbox" checked value="" class="sr-only peer">

                                <input id="remember" aria-describedby="remember" name="remember" type="checkbox"
                                    class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                    required>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember
                                        me</label>
                                </div>
                            </label>
                            <a href="/forgot-password" class="mr-4 text-sm font-medium text-purple-blue-500">Forget
                                password?</a>
                        </div>
                        <button
                            class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-2xl bg-gradient-to-t from-blue-600 to-blue-500">Sign
                            In</button>
                        <p class="text-sm leading-relaxed text-grey-900">Not registered yet? <a
                                href="{{ route('register') }}" class="font-bold text-grey-700">Create an Account</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
