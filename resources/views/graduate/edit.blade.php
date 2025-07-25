<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Data Wisudawan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{ selectedFaculty: {{ $graduate->faculty->id }} }">
                    <div class="mb-4">
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" nama="nama" type="text" class="mt-1 block w-full"
                            :value="old('nama', $graduate->nama)" required autofocus autocomplete="nama" />
                        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                    </div>
                    <div class="mb-4" x-data="faculties">
                        <label for="faculty">Fakultas</label>
                        <select name="faculty" id="faculty" x-model="faculties">
                            <template x-for="const faculty in faculties">
                                <option x-text="faculty"></option>
                            </template>


                        </select>
                    </div>
                    <div class="mb-4" x-data="departments">
                        <label for="department">Program Studi</label>
                        <select name="department" id="department">
                            <option disabled selected>Pilih Program Studi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script>

</x-app-layout>
