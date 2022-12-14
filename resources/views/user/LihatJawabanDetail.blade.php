<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="mt-4 w-full border-collapse">
                        Jawaban dari pengguna {{ $survey_ans->name }} untuk {{ $survey_ans->survey_name }}:
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jawaban
                                </th>                                 
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                            $i = 1;
                            @endphp
                            {{-- {{ dd($survey_ans->jawaban[$i]) }} --}}
                            @foreach ($survey_ans->pertanyaan as $pertanyaan)
                            <tr>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $pertanyaan }}</div>
                                </td>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $survey_ans->jawaban[$i] }}</div>
                                </td>
                            @php
                            $i++;
                            @endphp
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <td class="border whitespace-nowrap">
                        <a button
                        class="button mt-4 mb-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                        href=" {{ route('penjawab-semua',$survey_ans->survey_id) }}">Back</a>
                    </td>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
