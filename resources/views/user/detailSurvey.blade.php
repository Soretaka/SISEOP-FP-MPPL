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
                    @if($survey->is_locked == 0)
                    <a class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full left-0"
                        href="{{ route('tambah-pertanyaan-data-survey', [$survey->id]) }}">tambah pertanyaan</a>
                    <label class = "mt-4 block text-gray-700 text-sm font-bold mb-2" for="namaSurvey">Berikut merupakan list pertanyaan pada survey {{ $survey->NamaSurvey }} </label> 
                    <table class="mt-4 w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Pertanyaan
                                </th>       
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Delete
                                </th>                            
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($pertanyaans as $pertanyaan)
                            <tr>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $pertanyaan->Pertanyaan }}</div>
                                </td>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $pertanyaan->JenisPertanyaan }}</div>
                                </td>
                                <td class="border whitespace-nowrap">
                                    <a button
                                    class="button mt-4 mb-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                    href="{{ route('delete-data-pertanyaan-surveys', ['pertanyaan_id'=>$pertanyaan->id,'survey_id'=>$survey->id]) }}">delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <a class="button mt-4 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        href="{{ route('lock-data-surveys', [$survey->id]) }}">lock survey</a>
                    @else
                        {{-- {{ dd($survey->id) }} --}}
                        <a class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full left-0"
                        href="{{ route('lihat-penjawab', [$survey->id]) }}">lihat penjawab</a>
                    <a class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full left-0"
                    href="{{ route('tambah-penjawab', [$survey->id]) }}">tambah penjawab</a>
                    <a class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full left-0"
                    href="{{ route('penjawab-semua', [$survey->id]) }}">lihat jawaban</a>
                    <label class = "mt-4 block text-gray-700 text-sm font-bold mb-2" for="namaSurvey">Berikut merupakan list pertanyaan pada survey {{ $survey->NamaSurvey }} </label> 
                    <table class="mt-4 w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Pertanyaan
                                </th>                                 
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($pertanyaans as $pertanyaan)
                            <tr>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $pertanyaan->Pertanyaan }}</div>
                                </td>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $pertanyaan->JenisPertanyaan }}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <td class="border whitespace-nowrap">
                        <a button
                        class="button mt-4 mb-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                        href=" {{ url()->previous() }}">Back</a>
                    </td>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    @endif
</x-app-layout>
