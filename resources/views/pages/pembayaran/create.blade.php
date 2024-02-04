<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bayar SPP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('pembayaran.store', $siswa) }}" class="mt-6 space-y-6">
                        @csrf

                        <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                        <input type="hidden" name="idSpp" value="{{ $siswa->idSpp }}">
                        <div>
                            <x-input-label for="current_date" :value="__('Tanggal Pembayaran')"/>
                            <x-text-input id="current_date" name="current_date" type="text" class="mt-1 block w-full"
                                          :value="date('d/m/y')"
                                          disabled/>
                            <x-input-error class="mt-2" :messages="$errors->get('current_date')"/>
                        </div>

                        <div>
                            <x-input-label for="nisn" :value="__('NISN')"/>
                            <x-text-input id="nisn" name="nisn" type="text" class="mt-1 block w-full"
                                          :value="$siswa->nisn" disabled/>
                            <x-input-error class="mt-2" :messages="$errors->get('nisn')"/>
                        </div>

                        <div>
                            <x-input-label for="nama" :value="__('Nama')"/>
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                          :value="$siswa->nama" disabled/>
                            <x-input-error class="mt-2" :messages="$errors->get('nama')"/>
                        </div>

                        <div>
                            <x-input-label for="kelas" :value="__('Kelas dan Kompetensi Keahlian')"/>
                            <x-text-input id="kelas" name="kelas" type="text" class="mt-1 block w-full"
                                          :value="$siswa->kelas?->namaKelas . ' - ' . $siswa->kelas?->jurusan"
                                          disabled/>
                            <x-input-error class="mt-2" :messages="$errors->get('kelas')"/>
                        </div>

                        <div>
                            <x-input-label for="bayar" :value="__('SPP')"/>
                            <x-text-input id="bayar" name="bayar" type="text" class="mt-1 block w-full"
                                          :value="$siswa->bayar?->tahun . ' - Rp' . number_format($siswa->bayar?->nominal,2,',','.')"
                                          disabled/>
                            <x-input-error class="mt-2" :messages="$errors->get('bayar')"/>
                        </div>

                        <div>
                            <x-input-label for="bulanBayar" :value="__('Bulan Dibayar')"/>
                            <select id="bulanBayar" name="bulanBayar"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    autofocus>
                                @foreach($bulan as $bulan)
                                    <option value="{{ $bulan }}" @selected(old('bulanBayar') == $bulan)>
                                        {{ $bulan }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('bulanBayar')"/>
                        </div>

                        <div>
                            <x-input-label for="tahunBayar" :value="__('Tahun Dibayar')"/>
                            <x-text-input id="tahunBayar" name="tahunBayar" type="number" min="2010" max="{{ date('Y') }}"
                                          class="mt-1 block w-full" :value="old('tahunBayar', date('Y'))" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('tahunBayar')"/>
                        </div>

                        <div>
                            <x-input-label for="jumlah" :value="__('Jumlah Bayar')"/>
                            <x-text-input id="jumlah" name="jumlah" type="number" min="0" class="mt-1 block w-full"
                                          :value="old('jumlah', $siswa->bayar?->nominal)" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('jumlah')"/>
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
