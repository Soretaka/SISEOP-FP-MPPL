<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(auth()->user()->jabatan_id  == 2)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('hapus'))
            <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('hapus') }}
            </div>
            @endif
            @if (session('success'))
            <div class="bg-green-100 border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200"> 
                    Pilih Pertanyaan:
                    <form action="{{ route('add-pertanyaan') }}" method="POST">
                    @csrf
                    <input name="survey_id" type="hidden" value={{ $survey->id }}>
                    <select name="pertanyaan_id" id="pertanyaan_id">
                        @foreach($pertanyaans as $pertanyaan)
                        <option value="{{ $pertanyaan->id  }}" {{ $pertanyaan->id == $pertanyaan->id ? 'selected' : '' }}>{{ $pertanyaan->Pertanyaan }} ({{ $pertanyaan->JenisPertanyaan }}) </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Save</button>
                </form> 
                </div>
            </div>
        </div>
    </div>
    @else
    @endif
</x-app-layout>
