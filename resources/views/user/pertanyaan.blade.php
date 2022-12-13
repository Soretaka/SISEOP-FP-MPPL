<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(auth()->user()->jabatan_id  == 2) {{-- ini untuk user pembuat survey --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('hapus'))
                <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('hapus') }}
                </div>
                @endif
                @if (session('tambah'))
                <div class="bg-green-100 border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('tambah') }}
                </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200"> 
                    <label class = "block text-red-700 text-sm font-bold mb-2"> PASTIKAN DATA SUDAH BENAR SEBELUM SUBMIT KARENA DATA TIDAK BISA DI EDIT </label>
                    <form action="{{ route('store-data-pertanyaan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="Pertanyaan">Pertanyaan: </label>
                            <input type="Pertanyaan" class="mb-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline form-control @error('Pertanyaan') is-invalid @enderror"
                                name="Pertanyaan" value="{{ old('Pertanyaan') }}" required>

                            <!-- error message untuk title -->
                            @error('Pertanyaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>
                            <label class= "block text-gray-700 text-sm font-bold mb-2" for="JenisPertanyaan">Jenis Pertanyaan: </label>
                            <select name="JenisPertanyaan" id="JenisPertanyaan">
                                @foreach($JenisPertanyaans as $JenisPertanyaan)
                                <option class value="{{ $JenisPertanyaan->NamaJenisPertanyaan  }}" {{ $JenisPertanyaan->NamaJenisPertanyaan  == $JenisPertanyaan->NamaJenisPertanyaan  ? 'selected' : '' }}>{{ $JenisPertanyaan->NamaJenisPertanyaan  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="mt-4 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Simpan Pertanyaan</button>
                    </form>
                    <table class="w-full border-collapse">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    jenis
                                </th>
                                <th class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    delete
                                </th>                                
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($Pertanyaans as $pertanyaan)
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
                                    href="{{ route('delete-data-pertanyaan', [$pertanyaan->id]) }}">delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else {{-- ini untuk user pengisi survey --}}
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
