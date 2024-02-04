<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('siswa.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="nisn" :value="__('NISN')" />
                            <x-text-input id="nisn" name="nisn" type="text" class="mt-1 block w-full" :value="old('nisn')" autofocus required />
                            <x-input-error class="mt-2" :messages="$errors->get('nisn')" />
                        </div>

                        <div>
                            <x-input-label for="nis" :value="__('NIS')" />
                            <x-text-input id="nis" name="nis" type="text" class="mt-1 block w-full" :value="old('nis')" />
                            <x-input-error class="mt-2" :messages="$errors->get('nis')" />
                        </div>

                        <div>
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama')" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <div>
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat')" />
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                        </div>

                        <div>
                            <x-input-label for="telp" :value="__('Nomor Telepon')" />
                            <x-text-input id="telp" name="telp" type="text" class="mt-1 block w-full" :value="old('telp')" />
                            <x-input-error class="mt-2" :messages="$errors->get('telp')" />
                        </div>

                        <div>
                            <x-input-label for="idKelas" :value="__('Kelas')" />
                            <select id="idKelas" name="idKelas" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($kelas as $kelas)
                                    <option value="{{ $kelas->id }}" @selected(old('idKelas') == $kelas->id)>
                                        {{ $kelas->namaKelas . ' - ' . $kelas->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('idKelas')" />
                        </div>

                        <div>
                            <x-input-label for="idSpp" :value="__('SPP')" />
                            <select id="idSpp" name="idSpp" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($bayar as $bayar)
                                    <option value="{{ $bayar->id }}" @selected(old('idSpp') == $bayar->id)>
                                        {{ $bayar->tahun . ' - ' . "Rp" . number_format($bayar->nominal,2,',','.') }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('idSpp')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
