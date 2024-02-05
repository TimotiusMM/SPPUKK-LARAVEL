<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('kelas.update', $kelas) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="namaKelas" :value="__('Nama Kelas')"/>
                            <x-text-input id="namaKelas" name="namaKelas" type="text" class="mt-1 block w-full"
                                          :value="old('namaKelas', $kelas->namaKelas)" autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('namaKelas')"/>
                        </div>

                        <div>
                            <x-input-label for="jurusan" :value="__('Kompetensi Keahlian')"/>
                            <x-text-input id="jurusan" name="jurusan" type="text"
                                          class="mt-1 block w-full"
                                          :value="old('jurusan', $kelas->jurusan)"/>
                            <x-input-error class="mt-2" :messages="$errors->get('jurusan')"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

                            @if (in_array(session('status'), ['success', 'failed']))
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 mb-4"
                                >{{ session('message') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
