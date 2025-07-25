<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="float-right mb-4">
                        {{-- <div class="inline-block">
                            <label for="sort">Sort by</label>
                            <select name="sort" id="sort">
                                <option value="id">ID Wisuda</option>
                                <option value="nama">Nama</option>
                                <option value="fakultas">Fakultas</option>
                                <option value="prodi">Prodi</option>
                            </select>
                        </div> --}}

                        <form action="{{ route('graduates.index') }}" method="get">

                            <div class="flex">
                                <input type="text" name="search" id="search" placeholder="Search..."
                                    class="h-8 px-2 border-sky-200 rounded-tl-md rounded-bl-md focus:ring focus:ring-sky-200 transition-colors">
                                <button type="submit" class=" w-8 h-8 bg-red-400 rounded-tr-md rounded-br-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-4 h-4 mx-auto text-white stroke-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>

                                </button>
                            </div>

                        </form>


                    </div>
                    <table class="table-auto w-full mb-2">
                        <thead>
                            <tr class="border-b-2 border-b-slate-400">
                                <th class="text-left">ID Wisuda</th>
                                <th class="text-left">Nama</th>
                                <th class="text-left">Prodi</th>
                                <th class="text-left">Fakultas</th>
                                <th class="text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach ($graduates as $graduate)
                                <tr class="border-b border-b-slate-200 text-slate-400">
                                    <td class="m-auto">{{ $graduate->idWisuda }}</td>
                                    <td>{{ $graduate->nama }}</td>
                                    <td>{{ $graduate->department->name }}</td>
                                    <td>{{ $graduate->department->faculty->name }}</td>
                                    <td>
                                        <a href="{{ route('graduates.edit', ['graduate' => $graduate->nim]) }}"
                                            role="button" class="w-8 h-8 inline-block p-2 rounded bg-orange-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-full h-full text-white ">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('graduates.destroy', ['graduate' => $graduate->nim]) }}"
                                            role="button" class="w-8 h-8 p-2 rounded inline-block bg-red-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-full h-full text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $graduates->links() }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
