<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

        <button type="button" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown"
            class="flex items-center text-left w-full p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md gap-3 cursor-pointer">
            <img src="https://avatar.iran.liara.run/public/31" alt="Avatar"
                class="rounded-full w-10 h-10 border border-gray-300">
            <div class="flex flex-col items-start gap-1">
                <h3 class="text-md font-bold text-gray-700 dark:text-gray-200 line-clamp-1">{{ Auth::user()->name }}
                </h3>
                <span
                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded-md dark:bg-blue-900 dark:text-blue-300">{{ Auth::user()->getRoleNames()[0] }}</span>

            </div>
        </button>
        <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
            id="dropdown">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div>{{ Auth::user()->name }}</div>
                <div class="font-medium truncate">{{ Auth::user()->email }}</div>
            </div>
            <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                <li>
                    <a href="#"
                        class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Profil
                        saya</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Pengaturan
                        akun</a>
                </li>
            </ul>
            <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                <li>
                    <a href="#"
                        class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                </li>
            </ul>
        </div>

        <ul class="space-y-2 font-medium pt-5 mt-5 border-t border-gray-200 dark:border-gray-700">
            <li>
                <a href="{{ route('admin.dashboard.index') }}"
                    class="{{ Route::is('admin.dashboard.*') ? 'active' : '' }} sidebar-menu-link group">
                    <svg class="{{ Route::is('admin.dashboard.*') ? 'active' : '' }} sidebar-menu-icon"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">{{ __('Dashboard') }}</span>
                </a>
            </li>

            <li>
                <button type="button"
                    class="{{ Route::is('admin.kependudukan.*') ? 'active' : '' }} sidebar-menu-link group w-full"
                    aria-controls="dropdown-penduduk" data-collapse-toggle="dropdown-penduduk">
                    <svg class="{{ Route::is('admin.kependudukan.*') ? 'active' : '' }} sidebar-menu-icon"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span
                        class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('Kependudukan') }}</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-penduduk"
                    class="{{ Route::is('admin.kependudukan.*') ? 'block' : 'hidden' }} py-2 space-y-2 ml-10">
                    <li>
                        <a href="{{ route('admin.kependudukan.statistik') }}"
                            class="{{ Route::is('admin.kependudukan.statistik') ? 'active' : '' }} sidebar-sub-menu">{{ __('Statistik Penduduk') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kependudukan.jumlah-penduduk.index') }}"
                            class="{{ Route::is('admin.kependudukan.jumlah-penduduk.index') ? 'active' : '' }} sidebar-sub-menu">{{ __('Jumlah Penduduk') }}</a>
                    </li>
                </ul>
            </li>

            <li>
                <button type="button"
                    class="{{ Route::is('admin.perindustrian.*') ? 'active' : '' }} sidebar-menu-link group w-full"
                    aria-controls="dropdown-industri" data-collapse-toggle="dropdown-industri">
                    <svg class="{{ Route::is('admin.perindustrian.*') ? 'active' : '' }} sidebar-menu-icon"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span
                        class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('Perindustrian') }}</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-industri"
                    class="{{ Route::is('admin.perindustrian.*') ? 'block' : 'hidden' }} py-2 space-y-2 ml-10">
                    <li>
                        <a href="{{ route('admin.perindustrian.industri-nasional.index') }}"
                            class="{{ Route::is('admin.perindustrian.industri-nasional.*') ? 'active' : '' }} sidebar-sub-menu">{{ __('Industri Nasional') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kependudukan.jumlah-penduduk.index') }}"
                            class="{{ Route::is('admin.kependudukan.jumlah-penduduk.index') ? 'active' : '' }} sidebar-sub-menu">{{ __('IKM') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kependudukan.jumlah-penduduk.index') }}"
                            class="{{ Route::is('admin.kependudukan.jumlah-penduduk.index') ? 'active' : '' }} sidebar-sub-menu">{{ __('Harga Komoditas') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
