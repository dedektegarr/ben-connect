@extends('admin.layouts.app')

@section('title', 'Jumlah Penduduk')
@section('content')
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between gap-2">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    {{ __('Jumlah Penduduk') }}
                </h3>

                <div class="flex items-center gap-2">
                    <button type="button" data-modal-target="import-modal" data-modal-toggle="import-modal"
                        class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5h7.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2a1 1 0 0 0-1.414 1.414l.293.293H4V9h5a2 2 0 0 0 2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ __('Impor') }}
                    </button>
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14m-7 7V5" />
                        </svg>
                        {{ __('Tambah Data') }}
                    </button>
                </div>

            </div>
            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                <!-- ====== DataTable One Start -->
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
                    <table id="default-table">
                        <thead>
                            <tr>
                                <th>
                                    <span class="flex items-center">
                                        Name
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th data-type="date" data-format="YYYY/DD/MM">
                                    <span class="flex items-center">
                                        Release Date
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        NPM Downloads
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Growth
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Flowbite</td>
                                <td>2021/25/09</td>
                                <td>269000</td>
                                <td>49%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">React</td>
                                <td>2013/24/05</td>
                                <td>4500000</td>
                                <td>24%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Angular</td>
                                <td>2010/20/09</td>
                                <td>2800000</td>
                                <td>17%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Vue</td>
                                <td>2014/12/02</td>
                                <td>3600000</td>
                                <td>30%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Svelte</td>
                                <td>2016/26/11</td>
                                <td>1200000</td>
                                <td>57%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Ember</td>
                                <td>2011/08/12</td>
                                <td>500000</td>
                                <td>44%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Backbone</td>
                                <td>2010/13/10</td>
                                <td>300000</td>
                                <td>9%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">jQuery</td>
                                <td>2006/28/01</td>
                                <td>6000000</td>
                                <td>5%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Bootstrap</td>
                                <td>2011/19/08</td>
                                <td>1800000</td>
                                <td>12%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Foundation</td>
                                <td>2011/23/09</td>
                                <td>700000</td>
                                <td>8%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Bulma</td>
                                <td>2016/24/10</td>
                                <td>500000</td>
                                <td>7%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Next.js</td>
                                <td>2016/25/10</td>
                                <td>2300000</td>
                                <td>45%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nuxt.js</td>
                                <td>2016/16/10</td>
                                <td>900000</td>
                                <td>50%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Meteor</td>
                                <td>2012/17/01</td>
                                <td>1000000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Aurelia</td>
                                <td>2015/08/07</td>
                                <td>200000</td>
                                <td>20%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Inferno</td>
                                <td>2016/27/09</td>
                                <td>100000</td>
                                <td>35%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Preact</td>
                                <td>2015/16/08</td>
                                <td>600000</td>
                                <td>28%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Lit</td>
                                <td>2018/28/05</td>
                                <td>400000</td>
                                <td>60%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Alpine.js</td>
                                <td>2019/02/11</td>
                                <td>300000</td>
                                <td>70%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Stimulus</td>
                                <td>2018/06/03</td>
                                <td>150000</td>
                                <td>25%</td>
                            </tr>
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Solid</td>
                                <td>2021/05/07</td>
                                <td>250000</td>
                                <td>80%</td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div id="import-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('Impor Data Penduduk') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="import-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Periode') }}</label>
                            <select id="countries"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>{{ __('Pilih periode') }}</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('File') }}</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="file_input" type="file">
                            <p class="mt-1 ml-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PDF (MAX.
                                5Mb).
                            </p>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                clip-rule="evenodd" />
                        </svg>

                        {{ __('Impor') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
