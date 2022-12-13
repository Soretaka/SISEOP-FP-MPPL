<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(auth()->user()->jabatan_id  == 2)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200"> 
                    <label class = "block text-red-700 text-sm font-bold mb-2"> PASTIKAN DATA SUDAH BENAR SEBELUM SUBMIT KARENA DATA TIDAK BISA DI EDIT </label>
                    <form action="{{ route('store-data-survey') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class = "block text-gray-700 text-sm font-bold mb-2" for="namaSurvey">Nama Survey </label>
                            <input type="namaSurvey" class="shadow appearance-none border rounded w-full py-2 px-3 mb-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline form-control @error('namaSurvey') is-invalid @enderror"
                                name="namaSurvey" value="{{ old('namaSurvey') }}" required>

                            <!-- error message untuk title -->
                            @error('namaSurvey')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class = "block text-gray-700 text-sm font-bold mb-2" for="Deskripsi">Deskripsi </label>
                            <input type="Deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 mb-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline form-control @error('Deskripsi') is-invalid @enderror"
                                name="Deskripsi" value="{{ old('Deskripsi') }}" required>

                            <!-- error message untuk title -->
                            @error('Deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Simpan survey</button>
                    </form>
                    @foreach ($surveys as $survey)
                    {{ $survey->NamaSurvey }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Selamat datang {{ auth()->user()->name }}!
                    Kerjakan survey berikut:
                    @foreach ($survey_users as $survey_user)
                    {{ $survey_user->NamaSurvey }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
