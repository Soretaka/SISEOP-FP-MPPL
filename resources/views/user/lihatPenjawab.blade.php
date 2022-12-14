<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Penjawab survey {{ $survey->NamaSurvey }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <label class = "mt-4 block text-gray-700 text-sm font-bold mb-2" for="namaSurvey">Berikut merupakan list penjawab pada survey {{ $survey->NamaSurvey }} </label> 
                    <table class="mt-4 w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    status mengisi
                                </th>                                 
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 border whitespace-nowrap">
                                    @if($user->sudah_isi == "belum mengisi")
                                    <div class="text-sm text-red-400">{{ $user->sudah_isi }}</div>
                                    @else
                                    <div class="text-sm text-gray-900">{{ $user->sudah_isi }}</div>
                                    @endif
                                    {{-- <div class="text-sm text-gray-900">{{ $user->sudah_isi }}</div> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <td class="border whitespace-nowrap">
                        <a button
                        class="button mt-4 mb-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                        href="{{ route('detail-data-survey', ['id'=>$survey->id]) }}">Back</a>
                    </td>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
