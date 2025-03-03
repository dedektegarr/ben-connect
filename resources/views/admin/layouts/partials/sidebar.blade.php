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

            {{-- // pemerintahan --}}
            <li>
                <button type="button"
                    class="sidebar-menu-link group w-full flex items-center justify-between
                    {{ Route::is('admin.pemerintahan.*') ? 'active bg-gray-200 dark:bg-gray-700' : '' }}"
                    aria-controls="dropdown-pemerintahan"
                    data-collapse-toggle="dropdown-pemerintahan">

                    <div class="flex items-center">
                        <svg class="sidebar-menu-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 4a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm-2.952.462c-.483.19-.868.432-1.19.71-.363.315-.638.677-.831.93l-.106.14c-.21.268-.36.418-.574.527C6.125 6.883 5.74 7 5 7a1 1 0 0 0 0 2c.364 0 .696-.022 1-.067v.41l-1.864 4.2a1.774 1.774 0 0 0 .821 2.255c.255.133.538.202.825.202h2.436a1.786 1.786 0 0 0 1.768-1.558 1.774 1.774 0 0 0-.122-.899L8 9.343V8.028c.2-.188.36-.38.495-.553.062-.079.118-.15.168-.217.185-.24.311-.406.503-.571a1.89 1.89 0 0 1 .24-.177A3.01 3.01 0 0 0 11 7.829V20H5.5a1 1 0 1 0 0 2h13a1 1 0 1 0 0-2H13V7.83a3.01 3.01 0 0 0 1.63-1.387c.206.091.373.19.514.29.31.219.532.465.811.78l.025.027.02.023v1.78l-1.864 4.2a1.774 1.774 0 0 0 .821 2.255c.255.133.538.202.825.202h2.436a1.785 1.785 0 0 0 1.768-1.558 1.773 1.773 0 0 0-.122-.899L18 9.343v-.452c.302.072.633.109 1 .109a1 1 0 1 0 0-2c-.48 0-.731-.098-.899-.2-.2-.12-.363-.293-.651-.617l-.024-.026c-.267-.3-.622-.7-1.127-1.057a5.152 5.152 0 0 0-1.355-.678 3.001 3.001 0 0 0-5.896.04Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">{{ __('Pemerintahan') }}</span>
                    </div>

                    <svg class="w-3 h-3 transform transition-transform duration-200
                    {{ Route::is('admin.pemerintahan.*') ? 'rotate-180' : '' }}"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <ul id="dropdown-pemerintahan"
                    class="py-2 space-y-2 ml-10 transition-all duration-300
                    {{ Route::is('admin.pemerintahan.*') ? 'block' : 'hidden' }}">
                    <li>
                        <a href="{{ route('admin.pemerintahan.visimisi') }}"
                            class="sidebar-sub-menu {{ Route::is('admin.pemerintahan.visimisi') ? 'active bg-gray-300 dark:bg-gray-800' : '' }}">
                            {{ __('Visi & Misi') }}
                        </a>
                    </li>
                </ul>
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
                        <path
                            d="m6 10.5237-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Z" />
                        <path fill-rule="evenodd"
                            d="M12.5547 3.16795c-.3359-.22393-.7735-.22393-1.1094 0l-6.00002 4c-.45952.30635-.5837.92722-.27735 1.38675.30636.45953.92723.5837 1.38675.27735L8 7.86853V21h8V7.86853l1.4453.96352c.0143.00957.0289.01873.0435.02746.1597.09514.3364.14076.5112.1406.3228-.0003.6395-.15664.832-.44541.3064-.45953.1822-1.0804-.2773-1.38675l-6-4ZM10 12c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Zm8 12c0-.5523.4477-1 1-1h.01c.5523 0 1 .4477 1 1s-.4477 1-1 1H20c-.5523 0-1-.4477-1-1Zm1-8c.5523 0 1 .4477 1 1v4c0 .5523-.4477 1-1 1s-1-.4477-1-1v-4c0-.5523.4477-1 1-1Z"
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
                        <a href="{{ route('admin.perindustrian.ikm.index') }}"
                            class="{{ Route::is('admin.perindustrian.ikm.*') ? 'active' : '' }} sidebar-sub-menu">{{ __('Industri Kecil menengah') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.perindustrian.komoditas.index') }}"
                            class="{{ Route::is('admin.perindustrian.komoditas.*') ? 'active' : '' }} sidebar-sub-menu">{{ __('Harga Komoditas') }}</a>
                    </li>
                </ul>
            </li>

            <li>
                <button type="button"
                    class="{{ Route::is('admin.kesehatan.*') ? 'active' : '' }} sidebar-menu-link group w-full"
                    aria-controls="dropdown-kesehatan" data-collapse-toggle="dropdown-kesehatan">
                    <svg class="{{ Route::is('admin.kesehatan.*') ? 'active' : '' }} sidebar-menu-icon"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('Kesehatan') }}</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-kesehatan"
                    class="{{ Route::is('admin.kesehatan.*') ? 'block' : 'hidden' }} py-2 space-y-2 ml-10">
                    <li>
                        <a href="{{ route('admin.kesehatan.rs.index') }}"
                            class="{{ Route::is('admin.kesehatan.rs.*') ? 'active' : '' }} sidebar-sub-menu">{{ __('Data Rumah Sakit') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kesehatan.rsud.kunjungan') }}"
                            class="{{ Route::is('admin.kesehatan.rsud.kunjungan') ? 'active' : '' }} sidebar-sub-menu">{{ __('Kunjungan Pasien') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kesehatan.rsud.kamar') }}"
                            class="{{ Route::is('admin.kesehatan.rsud.kamar') ? 'active' : '' }} sidebar-sub-menu">{{ __('Ketersediaan Kamar') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kesehatan.rsud.poli') }}"
                            class="{{ Route::is('admin.kesehatan.rsud.poli') ? 'active' : '' }} sidebar-sub-menu">{{ __('Pelayanan Poli') }}</a>
                    </li>
                </ul>
            </li>

            <li>
                <button type="button"
                    class="{{ Route::is('admin.pendidikan.*') ? 'active' : '' }} sidebar-menu-link group w-full"
                    aria-controls="dropdown-pendidikan" data-collapse-toggle="dropdown-pendidikan">
                    <svg class="{{ Route::is('admin.pendidikan.*') ? 'active' : '' }} sidebar-menu-icon"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.4472 4.10557c-.2815-.14076-.6129-.14076-.8944 0L2.76981 8.49706l9.21949 4.39024L21 8.38195l-8.5528-4.27638Z" />
                        <path
                            d="M5 17.2222v-5.448l6.5701 3.1286c.278.1325.6016.1293.8771-.0084L19 11.618v5.6042c0 .2857-.1229.5583-.3364.7481l-.0025.0022-.0041.0036-.0103.009-.0119.0101-.0181.0152c-.024.02-.0562.0462-.0965.0776-.0807.0627-.1942.1465-.3405.2441-.2926.195-.7171.4455-1.2736.6928C15.7905 19.5208 14.1527 20 12 20c-2.15265 0-3.79045-.4792-4.90614-.9751-.5565-.2473-.98098-.4978-1.27356-.6928-.14631-.0976-.2598-.1814-.34049-.2441-.04036-.0314-.07254-.0576-.09656-.0776-.01201-.01-.02198-.0185-.02991-.0253l-.01038-.009-.00404-.0036-.00174-.0015-.0008-.0007s-.00004 0 .00978-.0112l-.00009-.0012-.01043.0117C5.12215 17.7799 5 17.5079 5 17.2222Zm-3-6.8765 2 .9523V17c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6543Z" />
                    </svg>

                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('Pendidikan') }}</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-pendidikan"
                    class="{{ Route::is('admin.pendidikan.*') ? 'block' : 'hidden' }} py-2 space-y-2 ml-10">
                    <li>
                        <a href="{{ route('admin.pendidikan.sekolah.index') }}"
                            class="{{ Route::is('admin.pendidikan.sekolah.*') ? 'active' : '' }} sidebar-sub-menu">{{ __('Jumlah Sekolah') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendidikan.guru.index') }}"
                            class="{{ Route::is('admin.pendidikan.guru.*') ? 'active' : '' }} sidebar-sub-menu">{{ __('Jumlah Guru') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendidikan.peserta-didik.index') }}"
                            class="{{ Route::is('admin.pendidikan.peserta-didik.*') ? 'active' : '' }} sidebar-sub-menu">{{ __('Jumlah Peserta Didik') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
