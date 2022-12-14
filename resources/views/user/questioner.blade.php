<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Survey dashboard
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
                    <table class="mt-4 w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Survey
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Detail
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Delete
                                </th>                                
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($surveys as $survey)
                            <tr>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $survey->NamaSurvey }}</div>
                                </td>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $survey->Deskripsi }}</div>
                                </td>
                                <td class="border whitespace-nowrap">
                                    <a button
                                    class="button mt-4 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                    href="{{ route('detail-data-survey', [$survey->id]) }}">detail</a>
                                </td>
                                <td class="border whitespace-nowrap">
                                    <a button
                                    class="button mt-4 mb-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                    href="{{ route('delete-data-survey', [$survey->id]) }}">delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- {{dd($past)}} --}}
                    @if($past == 0)
                    <label class = "block text-gray-700 text-sm font-bold mb-2" for="namaSurvey">Berikut merupakan list survey yang harus dikerjakan</label>
                    <table class="mt-4 w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Survey
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kerjakan
                                </th>                            
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($survey_users as $survey_user)
                            <tr>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $survey_user->NamaSurvey }}</div>
                                </td>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $survey_user->Deskripsi }}</div>
                                </td>
                                <td class="border whitespace-nowrap">
                                    <a button
                                    class="button mt-4 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                    href="{{ route('kerjakan-survey', [$survey_user->id]) }}">kerjakan</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    @else
                    <label class = "block text-gray-700 text-sm font-bold mb-2" for="namaSurvey">Berikut merupakan list survey yang harus dikerjakan</label>
                    <table class="mt-4 w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Survey
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Lihat nilai
                                </th>                            
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($survey_users as $survey_user)
                            <tr>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $survey_user->NamaSurvey }}</div>
                                </td>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $survey_user->Deskripsi }}</div>
                                </td>
                                <td class="border whitespace-nowrap">
                                    <a button
                                    class="button mt-4 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                    href="{{ route('detail-nilai', [$survey_user->id]) }}">Lihat nilai</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
