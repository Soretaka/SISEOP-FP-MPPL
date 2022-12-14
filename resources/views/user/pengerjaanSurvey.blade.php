<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $survey->NamaSurvey }}
                    <form action="{{ route('tambah-jawaban') }}" method="POST">
                    @csrf
                    <input name="survey_id" type="hidden" value={{ $survey->id }}>
                    <input name="user_id" type="hidden" value={{ auth()->user()->id }}>
                    @php
                    $count = 0;
                  @endphp
                    @foreach($pertanyaans as $pertanyaan)
                    @php $count++;@endphp
                    <input name="pertanyaan_id" type="hidden" value={{ $pertanyaan->id }}>
                    <p>{{ $count }}. {{ $pertanyaan->Pertanyaan }}</p>
                    <input name="pertanyaan[{{ $count }}]" type="hidden" value="{{ $pertanyaan->Pertanyaan}}">
                    <input name="jawaban[{{ $count }}]" type="hidden" value="">
                    <input name="type[{{ $count }}]" type="hidden" value="{{ $pertanyaan->JenisPertanyaan}}">
                    Start - <input class="ml-4" type="radio" name="jawaban[{{ $count }}]" value="1"> 1 
                    <input class="ml-4" type="radio" name="jawaban[{{ $count }}]" value="2"> 2 
                    <input class="ml-4" type="radio" name="jawaban[{{ $count }}]" value="3"> 3 
                    <input class="ml-4" type="radio" name="jawaban[{{ $count }}]" value="4"> 4 
                    <input class="ml-4" type="radio" name="jawaban[{{ $count }}]" value="5"> 5  
                    <label class="ml-4"> - Senantiasa hebat  </label>
                    <br>
                    @endforeach
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Save</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
