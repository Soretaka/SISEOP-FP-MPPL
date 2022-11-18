<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($jabatans as $jabatan)
                    {{ $jabatan->NamaJabatan }}
                    @endforeach
                    <form action="{{ route('store-data-role') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="NamaJabatan">Nama Jabatan: </label>
                            <input type="NamaJabatan" class="form-control @error('NamaJabatan') is-invalid @enderror"
                                name="NamaJabatan" value="{{ old('NamaJabatan') }}" required>

                            <!-- error message untuk title -->
                            @error('NamaJabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>