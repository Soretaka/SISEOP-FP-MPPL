<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Role') }}
        </h2>
    </x-slot>
    {{-- <form action="{{ route('store-data-role') }}" method="POST">
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
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Save</button>
    </form> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    User - Jabatan <br>
                    @foreach($users as $user)

                    <form action="{{ route('update-data-role') }}" method="POST">
                        {{ $user->name }} 
                    @csrf
                    @method('PUT')
                    <input name="user_id" type="hidden" value={{ $user->id }}>
                    <select name="jabatan" id="jabatan">
                        @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id  }}" {{ $user->jabatan_id == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->NamaJabatan }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Save</button>
                </form> 
                    @endforeach
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
