    <x-dashboard.dashboard-layout>
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>

                <div class="px-4 pt-6">
                    <div
                        class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        {{-- Judul --}}
                        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white text-center">Komunitas Klinik
                            Gunung</h5>
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400 text-center">Stay up to date
                            and move
                            work forward
                            with Flowbite on iOS & Android. Download the app today.</p>
                        {{-- !Judul --}}

                        <div
                            class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">

                            <div class="p-4 mb-4 bg-white sm:p-6 dark:border-gray-700 dark:bg-gray-800  xl:mb-0">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Smart chat</h3>
                                </div>
                                <!-- Chat -->
                                <form class="overflow-y-auto lg:max-h-[60rem] 2xl:max-h-fit">
                                    @foreach ($topics as $topic)
                                        <article class="mb-5">
                                            <footer class="flex items-center justify-between mb-2">
                                                <div class="flex items-center">
                                                    <p
                                                        class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                        <img class="w-6 h-6 mr-2 rounded-full"
                                                            src="/storage/{{ $topic->user->profile_photo_path }}"
                                                            alt="Bonnie avatar">{{ $topic->user->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                            datetime="2022-02-08" title="February 8th, 2022">
                                                            {{ $topic->formatted_created_at }}</time></p>
                                                </div>
                                                <button id="dropdownComment2Button"
                                                    data-dropdown-toggle="dropdownComment2"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                                                        @if ($topic->user_id === auth()->id())
                                                            <li>
                                                                <a href="{{ route('community.delete', $topic->id) }}"
                                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus topik ini?');">Remove</a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a href="#"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </footer>
                                            <p class="mb-3 text-gray-900 dark:text-white">{{ $topic->title }}</p>
                                            <p class="mb-2 text-gray-900 dark:text-white">
                                                {{ $topic->description }}
                                            </p>
                                            {{-- <p class="mb-3 text-gray-900 dark:text-white">Cheers!</p> --}}
                                            <div class="flex items-center mb-2 space-x-2">
                                                <button type="button"
                                                    class="py-1.5 px-3 inline-flex items-center rounded-lg bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700">
                                                    <svg aria-hidden="true" class="h-5 mr-2" viewBox="0 0 24 27"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M24 14.1907C24 12.7352 23.7409 11.3397 23.2659 10.0486C22.9412 13.8526 20.9132 15.8065 18.7941 14.8966C16.8092 14.0439 18.1468 10.7199 18.2456 9.13377C18.4122 6.44506 18.2372 3.36742 13.3532 0.808594C15.3826 4.69095 13.5882 7.10295 11.7064 7.24977C9.61835 7.41283 7.70612 5.45542 8.412 2.27895C6.12635 3.96318 6.06 6.79801 6.76518 8.63189C7.50071 10.5434 6.73553 12.1317 4.94188 12.3081C2.93718 12.5058 1.82329 10.1615 2.85035 6.42601C1.07294 8.51895 0 11.2295 0 14.1907C0 20.8182 5.37247 26.1907 12 26.1907C18.6275 26.1907 24 20.8182 24 14.1907Z"
                                                            fill="#F4900C" />
                                                        <path
                                                            d="M19.3349 17.7211C19.4393 19.8981 17.5271 20.7515 16.4979 20.3393C15.0113 19.7442 15.4102 18.7221 15.0276 16.6044C14.645 14.4868 13.1746 13.0164 10.9984 12.3691C12.5866 16.8395 10.1182 18.487 8.82428 18.7814C7.50287 19.0821 6.17511 18.7807 6.02334 15.9529C4.4817 17.4875 3.52734 19.6108 3.52734 21.9571C3.52734 22.2169 3.54358 22.4724 3.56617 22.7266C5.73323 24.8682 8.70993 26.1924 11.9979 26.1924C15.2859 26.1924 18.2626 24.8682 20.4297 22.7266C20.4523 22.4724 20.4685 22.2169 20.4685 21.9571C20.4685 20.4134 20.0563 18.967 19.3349 17.7211Z"
                                                            fill="#FFCC4D" />
                                                    </svg>
                                                    <span
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400">14</span>
                                                </button>
                                                <button type="button"
                                                    class="py-1.5 px-3 inline-flex items-center rounded-lg bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700">
                                                    <svg aria-hidden="true" class="h-5 mr-2" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.24467 6.07733C3.87207 5.63882 4.81784 5.72291 5.38116 6.18812L4.73508 5.24903C4.21514 4.5075 4.40135 3.70523 5.14355 3.18462C5.88575 2.66601 7.98887 4.06031 7.98887 4.06031C7.46426 3.31143 7.56238 2.36233 8.31125 1.83705C9.06012 1.31377 10.0933 1.49465 10.6179 2.24486L17.5727 12.0697L16.6864 20.663L9.28906 17.9652L2.83686 8.3987C2.30758 7.64516 2.49046 6.60594 3.24467 6.07733Z"
                                                            fill="#EF9645"></path>
                                                        <path
                                                            d="M1.79857 11.5433C1.79857 11.5433 1.04302 10.442 2.14497 9.68715C3.24559 8.93226 4.00047 10.0329 4.00047 10.0329L7.50523 15.1442C7.62603 14.9426 7.75819 14.7437 7.90569 14.5475L3.04135 7.45454C3.04135 7.45454 2.28647 6.35392 3.38775 5.59904C4.48837 4.84416 5.24325 5.94478 5.24325 5.94478L9.81859 12.6172C9.98879 12.4784 10.163 12.3389 10.3425 12.2021L5.03835 4.46572C5.03835 4.46572 4.28347 3.3651 5.38475 2.61022C6.48537 1.85534 7.24025 2.95596 7.24025 2.95596L12.5444 10.691C12.7393 10.5715 12.9322 10.4681 13.1258 10.3586L8.168 3.12883C8.168 3.12883 7.41312 2.02821 8.51373 1.27333C9.61435 0.518448 10.3692 1.61907 10.3692 1.61907L15.6113 9.26398L16.4083 10.4267C13.1058 12.692 12.7914 16.9536 14.6783 19.7055C15.0554 20.2561 15.606 19.879 15.606 19.879C13.3414 16.5758 14.0328 12.8642 17.336 10.5995L16.3622 5.72586C16.3622 5.72586 15.9985 4.44169 17.282 4.07727C18.5661 3.71351 18.9306 4.99767 18.9306 4.99767L20.0552 8.33757C20.5011 9.66178 20.9756 10.9813 21.6037 12.2294C23.3771 15.7536 22.3178 20.1333 18.9739 22.4273C15.3263 24.9283 10.3399 23.9985 7.83828 20.3516L1.79857 11.5433Z"
                                                            fill="#FFDC5D"></path>
                                                        <path
                                                            d="M8.00913 21.3583C5.33934 21.3583 2.64153 18.6605 2.64153 15.9907C2.64153 15.6216 2.37122 15.3232 2.00212 15.3232C1.63302 15.3232 1.30664 15.6216 1.30664 15.9907C1.30664 19.9954 4.00445 22.6932 8.00913 22.6932C8.37822 22.6932 8.67657 22.3668 8.67657 21.9977C8.67657 21.6286 8.37822 21.3583 8.00913 21.3583Z"
                                                            fill="#5DADEC"></path>
                                                        <path
                                                            d="M4.67212 22.6649C2.66978 22.6649 1.33489 21.33 1.33489 19.3277C1.33489 18.9586 1.03654 18.6602 0.667445 18.6602C0.298348 18.6602 0 18.9586 0 19.3277C0 21.9974 2.00234 23.9998 4.67212 23.9998C5.04121 23.9998 5.33956 23.7014 5.33956 23.3323C5.33956 22.9632 5.04121 22.6649 4.67212 22.6649ZM16.0187 1.30664C15.6503 1.30664 15.3512 1.60566 15.3512 1.97409C15.3512 2.34252 15.6503 2.64153 16.0187 2.64153C18.6885 2.64153 21.3583 5.03699 21.3583 7.98109C21.3583 8.34952 21.6573 8.64854 22.0257 8.64854C22.3941 8.64854 22.6931 8.34952 22.6931 7.98109C22.6931 4.3008 20.0234 1.30664 16.0187 1.30664Z"
                                                            fill="#5DADEC"></path>
                                                        <path
                                                            d="M19.3559 0C18.9875 0 18.6885 0.270983 18.6885 0.639413C18.6885 1.00784 18.9875 1.33489 19.3559 1.33489C21.3583 1.33489 22.6651 2.81996 22.6651 4.64408C22.6651 5.01251 22.9915 5.31153 23.3606 5.31153C23.7297 5.31153 24 5.01251 24 4.64408C24 2.0831 22.0257 0 19.3559 0Z"
                                                            fill="#5DADEC"></path>
                                                    </svg>
                                                    <span
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400">8</span>
                                                </button>
                                                <button type="button"
                                                    class="py-1.5 px-3 inline-flex items-center rounded-lg bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700">
                                                    <svg aria-hidden="true" class="h-5 mr-2" viewBox="0 0 24 25"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.75255 5.29787C7.67789 5.37254 7.62122 5.46254 7.57388 5.56121L7.56855 5.55587L0.0910439 22.4003L0.0983774 22.4076C-0.0402924 22.6763 0.191713 23.223 0.667057 23.699C1.1424 24.1743 1.68908 24.4063 1.95775 24.2676L1.96442 24.2743L18.8088 16.7961L18.8035 16.7901C18.9015 16.7435 18.9915 16.6868 19.0668 16.6108C20.1082 15.5694 18.4195 12.1927 15.2961 9.06862C12.1713 5.94455 8.79458 4.25651 7.75255 5.29787Z"
                                                            fill="#DD2E44"></path>
                                                        <path
                                                            d="M8.66858 8.30273L0.279048 21.9737L0.0910439 22.3971L0.0983774 22.4044C-0.0402924 22.6731 0.191713 23.2197 0.667057 23.6958C0.821728 23.8504 0.982398 23.9678 1.13973 24.0671L11.3353 11.6361L8.66858 8.30273Z"
                                                            fill="#EA596E"></path>
                                                        <path
                                                            d="M15.3439 9.01304C18.4573 12.1278 20.186 15.4479 19.2033 16.4292C18.2213 17.4119 14.9012 15.6839 11.7858 12.5705C8.67174 9.45572 6.9437 6.13431 7.92573 5.15228C8.90841 4.17026 12.2285 5.8983 15.3439 9.01304Z"
                                                            fill="#A0041E"></path>
                                                        <path
                                                            d="M12.3913 9.37694C12.2587 9.48427 12.0853 9.54028 11.902 9.52028C11.3233 9.45761 10.8366 9.25627 10.496 8.93826C10.1353 8.60159 9.95727 8.14958 10.0059 7.6969C10.0913 6.90221 10.8886 6.17286 12.248 6.31953C12.7767 6.3762 13.0127 6.2062 13.0207 6.12486C13.03 6.04419 12.836 5.82752 12.3073 5.77019C11.7286 5.70752 11.242 5.50618 10.9006 5.18817C10.54 4.8515 10.3613 4.39949 10.4106 3.94681C10.4973 3.15213 11.294 2.42278 12.652 2.57011C13.0373 2.61145 13.2407 2.53211 13.3267 2.48078C13.3954 2.43878 13.4227 2.39878 13.4254 2.37544C13.4334 2.29477 13.242 2.0781 12.712 2.02077C12.346 1.98077 12.0807 1.65276 12.1213 1.28608C12.1607 0.920076 12.488 0.655404 12.8553 0.695405C14.2134 0.841408 14.8374 1.72343 14.7514 2.51878C14.6647 3.3148 13.868 4.04281 12.5087 3.89681C12.1233 3.85481 11.922 3.93481 11.8353 3.98615C11.7666 4.02748 11.7386 4.06815 11.736 4.09082C11.7273 4.17215 11.92 4.38816 12.45 4.44549C13.808 4.59216 14.432 5.47351 14.346 6.26887C14.26 7.06355 13.4634 7.7929 12.1047 7.64557C11.7193 7.60423 11.5166 7.68423 11.43 7.7349C11.3606 7.77757 11.334 7.81757 11.3313 7.84024C11.3226 7.9209 11.5153 8.13758 12.0447 8.19491C12.41 8.23491 12.676 8.56359 12.6353 8.92959C12.6167 9.11226 12.524 9.27027 12.3913 9.37694Z"
                                                            fill="#AA8DD8"></path>
                                                        <path
                                                            d="M20.4411 15.5411C21.7565 15.1698 22.6638 15.7565 22.8798 16.5265C23.0958 17.2958 22.6278 18.2699 21.3131 18.6399C20.7998 18.7839 20.6458 19.0292 20.6665 19.1072C20.6891 19.1859 20.9498 19.3152 21.4618 19.1706C22.7765 18.8005 23.6839 19.3872 23.8999 20.1566C24.1172 20.9266 23.6479 21.8993 22.3325 22.27C21.8198 22.414 21.6651 22.66 21.6878 22.738C21.7098 22.816 21.9698 22.9453 22.4825 22.8013C22.8358 22.702 23.2052 22.908 23.3045 23.262C23.4032 23.6167 23.1972 23.9847 22.8425 24.0847C21.5285 24.4547 20.6205 23.8693 20.4031 23.0986C20.1871 22.3293 20.6558 21.3566 21.9718 20.9859C22.4852 20.8413 22.6392 20.5966 22.6165 20.5179C22.5952 20.4399 22.3352 20.3099 21.8232 20.4539C20.5071 20.8246 19.6004 20.2392 19.3838 19.4679C19.1671 18.6985 19.6358 17.7259 20.9511 17.3545C21.4631 17.2112 21.6171 16.9645 21.5958 16.8872C21.5731 16.8085 21.3138 16.6792 20.8011 16.8232C20.4465 16.9232 20.0791 16.7165 19.9791 16.3625C19.8798 16.0092 20.0864 15.6411 20.4411 15.5411Z"
                                                            fill="#77B255"></path>
                                                        <path
                                                            d="M15.3333 13.7449C15.1373 13.7449 14.9439 13.6589 14.8119 13.4949C14.5819 13.2069 14.6292 12.7875 14.9159 12.5575C15.0612 12.4409 18.528 9.71812 23.4274 10.4188C23.7921 10.4708 24.0455 10.8081 23.9935 11.1728C23.9415 11.5368 23.6068 11.7928 23.2388 11.7382C18.91 11.1235 15.7806 13.5742 15.7499 13.5989C15.6259 13.6975 15.4793 13.7449 15.3333 13.7449Z"
                                                            fill="#AA8DD8"></path>
                                                        <path
                                                            d="M3.83539 10.9697C3.77205 10.9697 3.70739 10.9604 3.64338 10.9417C3.29071 10.8357 3.0907 10.4643 3.19671 10.1117C3.95206 7.59628 4.63674 3.58219 3.79539 2.5355C3.70138 2.41683 3.55938 2.30016 3.23404 2.32483C2.60869 2.37283 2.66803 3.69219 2.66869 3.70552C2.69669 4.07287 2.42069 4.39287 2.05401 4.42021C1.68134 4.44287 1.36666 4.1722 1.33933 3.80486C1.27066 2.8855 1.55667 1.1148 3.13404 0.995461C3.83805 0.942127 4.42273 1.1868 4.83541 1.70014C6.41611 3.66752 4.81141 9.37099 4.47407 10.495C4.3874 10.7837 4.12206 10.9697 3.83539 10.9697Z"
                                                            fill="#77B255"></path>
                                                        <path
                                                            d="M16.999 7.63774C17.5513 7.63774 17.9991 7.19002 17.9991 6.63772C17.9991 6.08542 17.5513 5.6377 16.999 5.6377C16.4467 5.6377 15.999 6.08542 15.999 6.63772C15.999 7.19002 16.4467 7.63774 16.999 7.63774Z"
                                                            fill="#5C913B"></path>
                                                        <path
                                                            d="M1.33336 13.6355C2.06976 13.6355 2.66673 13.0385 2.66673 12.3021C2.66673 11.5657 2.06976 10.9688 1.33336 10.9688C0.596967 10.9688 0 11.5657 0 12.3021C0 13.0385 0.596967 13.6355 1.33336 13.6355Z"
                                                            fill="#9266CC"></path>
                                                        <path
                                                            d="M21.666 14.3047C22.2183 14.3047 22.6661 13.857 22.6661 13.3047C22.6661 12.7524 22.2183 12.3047 21.666 12.3047C21.1137 12.3047 20.666 12.7524 20.666 13.3047C20.666 13.857 21.1137 14.3047 21.666 14.3047Z"
                                                            fill="#5C913B"></path>
                                                        <path
                                                            d="M15.666 22.3038C16.2183 22.3038 16.6661 21.856 16.6661 21.3037C16.6661 20.7514 16.2183 20.3037 15.666 20.3037C15.1137 20.3037 14.666 20.7514 14.666 21.3037C14.666 21.856 15.1137 22.3038 15.666 22.3038Z"
                                                            fill="#5C913B"></path>
                                                        <path
                                                            d="M18.6683 4.30052C19.4047 4.30052 20.0017 3.70355 20.0017 2.96715C20.0017 2.23076 19.4047 1.63379 18.6683 1.63379C17.9319 1.63379 17.335 2.23076 17.335 2.96715C17.335 3.70355 17.9319 4.30052 18.6683 4.30052Z"
                                                            fill="#FFCC4D"></path>
                                                        <path
                                                            d="M21.6699 6.9688C22.2222 6.9688 22.67 6.52107 22.67 5.96877C22.67 5.41648 22.2222 4.96875 21.6699 4.96875C21.1176 4.96875 20.6699 5.41648 20.6699 5.96877C20.6699 6.52107 21.1176 6.9688 21.6699 6.9688Z"
                                                            fill="#FFCC4D"></path>
                                                        <path
                                                            d="M19.668 9.63384C20.2203 9.63384 20.668 9.18611 20.668 8.63381C20.668 8.08151 20.2203 7.63379 19.668 7.63379C19.1157 7.63379 18.668 8.08151 18.668 8.63381C18.668 9.18611 19.1157 9.63384 19.668 9.63384Z"
                                                            fill="#FFCC4D"></path>
                                                        <path
                                                            d="M5.00198 16.9668C5.55427 16.9668 6.002 16.5191 6.002 15.9668C6.002 15.4145 5.55427 14.9668 5.00198 14.9668C4.44968 14.9668 4.00195 15.4145 4.00195 15.9668C4.00195 16.5191 4.44968 16.9668 5.00198 16.9668Z"
                                                            fill="#FFCC4D"></path>
                                                    </svg>
                                                    <span
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400">3</span>
                                                </button>
                                            </div>
                                        </article>
                                    @endforeach
                                    <article class="mb-5">
                                        <footer class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <p
                                                    class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                    <img class="w-6 h-6 mr-2 rounded-full"
                                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"alt="Jese avatar">Jese
                                                    Leos
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                        datetime="2022-02-08" title="February 8th, 2022"> 01/03/2023
                                                        4:15 PM</time></p>
                                            </div>
                                            <button id="dropdownComment3Button"
                                                data-dropdown-toggle="dropdownComment3"
                                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:ring-gray-600"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                    </path>
                                                </svg>
                                                <span class="sr-only">Comment settings</span>
                                            </button>
                                            <!-- Dropdown menu -->
                                            <div id="dropdownComment3"
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
                                            Ok <a href="#"
                                                class="font-medium hover:underline text-primary-600 dark:text-primary-500">@team</a>
                                            I'am attaching our offer and pitch deck. Take your time to review
                                            everything. I'am looking forward to the next steps! Thank you.
                                        </p>
                                        <p class="mb-3 text-gray-900 dark:text-white">Looking forward to it! Thanks.
                                        </p>
                                        <div class="items-center 2xl:space-x-4 2xl:flex">
                                            <!-- Item -->
                                            <div
                                                class="flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
                                                <div
                                                    class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                                                    <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                                        fill="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z">
                                                        </path>
                                                        <path
                                                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="mr-4">
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                        flowbite_offer_345"</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">PDF, 2.3 MB</p>
                                                </div>
                                                <div class="flex items-center ml-auto">
                                                    <button type="button" class="p-2 rounded hover:bg-gray-100">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                                d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z">
                                                            </path>
                                                        </svg>
                                                        <span class="sr-only">Download</span>
                                                    </button>
                                                    <button type="button" class="p-2 rounded hover:bg-gray-100">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path
                                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                                            </path>
                                                        </svg>
                                                        <span class="sr-only">Actions</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- Item -->
                                            <div
                                                class="flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
                                                <div
                                                    class="flex items-center justify-center w-10 h-10 mr-3 bg-teal-100 rounded-lg dark:bg-teal-900">
                                                    <svg class="w-5 h-5 text-teal-600 lg:w-6 lg:h-6 dark:text-teal-300"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path
                                                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="mr-4">
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                        bergside_pitch"</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">PPTX, 10.1 MB
                                                    </p>
                                                </div>
                                                <div class="flex items-center ml-auto">
                                                    <button type="button" class="p-2 rounded hover:bg-gray-100">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                                d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z">
                                                            </path>
                                                        </svg>
                                                        <span class="sr-only">Download</span>
                                                    </button>
                                                    <button type="button" class="p-2 rounded hover:bg-gray-100">
                                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path
                                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                                            </path>
                                                        </svg>
                                                        <span class="sr-only">Actions</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="pl-12 mb-5">
                                        <footer class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <p
                                                    class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                    <img class="w-6 h-6 mr-2 rounded-full"
                                                        src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"alt="Joseph avatar">Joseph
                                                    McFallen
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                        datetime="2022-02-08" title="February 8th, 2022"> 01/03/2023
                                                        4:15 PM</time></p>
                                            </div>
                                            <button id="dropdownComment4Button"
                                                data-dropdown-toggle="dropdownComment4"
                                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:ring-gray-600"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                                            Hello <a href="#"
                                                class="font-medium hover:underline text-primary-600 dark:text-primary-500">@jeseleos</a>
                                            I need some informations about flowbite react version.
                                        </p>
                                    </article>
                                    <article class="pl-12 mb-5">
                                        <footer class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <p
                                                    class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                    <img class="w-6 h-6 mr-2 rounded-full"
                                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"alt="Jese avatar">Jese
                                                    Leos
                                                </p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                        datetime="2022-02-08" title="February 8th, 2022"> 01/03/2023
                                                        4:15 PM</time></p>
                                            </div>
                                            <button id="dropdownComment5Button"
                                                data-dropdown-toggle="dropdownComment5"
                                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:ring-gray-600"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                    </path>
                                                </svg>
                                                <span class="sr-only">Comment settings</span>
                                            </button>
                                            <!-- Dropdown menu -->
                                            <div id="dropdownComment5"
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
                                        <p class="mb-4 text-gray-900 dark:text-white">
                                            Hi <a href="#"
                                                class="font-medium hover:underline text-primary-600 dark:text-primary-500">@josephh</a>
                                            Sure, just let me know whean you are available and we can speak.
                                        </p>
                                        <form>
                                            <label for="chat" class="sr-only">Your message</label>
                                            <div class="flex items-center mb-5">
                                                <textarea id="chat" rows="1"
                                                    class="block mr-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Reply in thread..."></textarea>
                                                <button type="submit"
                                                    class="inline-flex justify-center p-2 rounded-lg cursor-pointer text-primary-600 hover:bg-primary-100 dark:text-primary-500 dark:hover:bg-gray-600">
                                                    <svg aria-hidden="true" class="w-6 h-6 rotate-90"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                                        </path>
                                                    </svg>
                                                    <span class="sr-only">Send message</span>
                                                </button>
                                            </div>
                                        </form>
                                        <span
                                            class="inline-flex items-center text-xs font-medium cursor-pointer hover:underline text-primary-700 sm:text-sm dark:text-primary-500">
                                            Hide thread
                                            <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z">
                                                </path>
                                            </svg>
                                        </span>
                                    </article>
                                    <div
                                        class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                        <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                            <label for="comment" class="sr-only">Write your message</label>
                                            <textarea id="comment" rows="8"
                                                class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                                placeholder="Write your message" required></textarea>
                                        </div>
                                        <div
                                            class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                            <button type="submit"
                                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                Send message
                                            </button>
                                            <div class="flex pl-0 space-x-1 sm:pl-2">
                                                <button type="button"
                                                    class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Attach file</span>
                                                </button>
                                                <button type="button"
                                                    class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Set location</span>
                                                </button>
                                                <button type="button"
                                                    class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Upload image</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- end smart chat --}}
                        </div>
                    </div>
                    <hr>

                    {{-- <a href="{{ route('community.show', $topic->id) }}" class="btn btn-secondary">Lihat
                                    Diskusi</a> --}}

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
