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
                    <h1 class="text-2xl font-bold">{{ $survey->NamaSurvey }}</h1>
                    <label class = "block text-red-700 text-sm font-bold mb-2"> TINGKATKAN LAGI JIKA NILAI ANDA MASIH DIBAWAH 50% </label>
                    <div class="mt-4">
                        <table class="mt-4 w-full border-collapse">
                            <thead class="bg-gray-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nilai
                                    </th>
                                    <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Skor
                                    </th>                                 
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        <div class="text-sm text-gray-900"> V </div>
                                    </td>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        @if($survey_user->maks_skorv == 0)
                                        <div class="text-sm text-gray-900"> 100%</div>
                                        @else
                                        <div class="text-sm text-gray-900"> {{ $survey_user->skorv/$survey_user->maks_skorv*100 }}%</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        <div class="text-sm text-gray-900"> I </div>
                                    </td>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        @if($survey_user->maks_skori == 0)
                                            <div class="text-sm text-gray-900"> 100%</div>
                                            @else
                                        <div class="text-sm text-gray-900"> {{ $survey_user->skori/$survey_user->maks_skori*100 }}%</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        <div class="text-sm text-gray-900"> P </div>
                                    </td>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        @if($survey_user->maks_skorp == 0)
                                        <div class="text-sm text-gray-900"> 100%</div>
                                        @else
                                        <div class="text-sm text-gray-900"> {{ $survey_user->skorp/$survey_user->maks_skorp*100 }}%</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        <div class="text-sm text-gray-900"> S </div>
                                    </td>
                                    <td class="px-6 py-4 border whitespace-nowrap">
                                        @if($survey_user->maks_skors == 0)
                                        <div class="text-sm text-gray-900"> 100%</div>
                                        @else
                                        <div class="text-sm text-gray-900"> {{ $survey_user->skors/$survey_user->maks_skors*100 }}%</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <td class="border whitespace-nowrap">
                            <a button
                            class="button mt-4 mb-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                            href=" {{ route('past-survey-dashboard') }}">Back</a>
                        </td>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
