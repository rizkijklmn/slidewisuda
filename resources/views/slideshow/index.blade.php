<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @font-face {
            font-family: 'Relationship of mélodrame';
            src: url('{{ asset('fonts/Relationship-of-melodrame.ttf') }}') format('truetype'),
                 local('Relationship of mélodrame'),
                 local('Relationship of melodrame');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Poppins';
            src: url('{{ asset('fonts/Poppins-Medium.ttf') }}') format('truetype'),
                 local('Poppins Medium'),
                 local('Poppins-Medium'),
                 local('Poppins');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        .font-relationship {
            font-family: 'Relationship of mélodrame', 'Relationship of melodrame', sans-serif !important;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</head>

@php
    // =========================================================================
    // DAFTAR NOMOR URUT WISUDAWAN YANG FONT NAMANYA DIPERKECIL (TETAP 1 BARIS)
    // Silakan masukkan nomor urut mahasiswa di dalam array ini:
    // =========================================================================
    $smallNameList = [
        63
    ];

@endphp

<body class="overflow-hidden bg-black select-none">
    <div class="relative w-screen h-screen bg-wisuda-34-black bg-cover bg-no-repeat flex justify-center items-center overflow-hidden">
        @foreach ($graduates as $graduate)
            @php
                $isCurrent = false;
                if (isset($startIndex) && $startIndex !== null && $startIndex !== '') {
                    $isCurrent = ($graduate->urut == $startIndex) || ($loop->iteration == $startIndex) || ($loop->index == $startIndex);
                } else {
                    $isCurrent = ($loop->index == 0);
                }

                // Jika nomor urut ada di dalam array $smallNameList: ukuran diperkecil agar tetap 1 baris (horizontal)
                if (in_array($graduate->urut, $smallNameList)) {
                    $nameSize = 'text-7xl lg:text-8xl whitespace-nowrap';
                } else {
                    $nameSize = 'text-7xl lg:text-8xl whitespace-nowrap';
                }

                // Ukuran font otomatis untuk judul skripsi jika sangat panjang
                $titleLen = mb_strlen(trim($graduate->judulSkripsi));
                if ($titleLen <= 90) {
                    $titleSize = 'text-3xl lg:text-4xl';
                } elseif ($titleLen <= 150) {
                    $titleSize = 'text-2xl lg:text-3xl';
                } else {
                    $titleSize = 'text-xl lg:text-2xl';
                }
            @endphp
            <div
                class="absolute inset-0 flex flex-col justify-center items-center p-4 transition-opacity duration-700 {{ $isCurrent ? 'current' : '' }} slide"
                data-urut="{{ $graduate->urut }}" data-index="{{ $loop->iteration }}">
                
                {{-- Baris Atas: Foto & Detail Wisudawan --}}
                <div class="flex flex-row mb-3 items-stretch">
                    <div class="h-[26rem] w-[19.5rem] border-4 border-yellow-400 rounded-xl mr-8 overflow-hidden bg-black/50 shadow-2xl flex-shrink-0">
                        <img src="{{ $graduate->photo_url }}"
                            alt="{{ $graduate->nim }}" class="w-full h-full object-cover" decoding="async">
                    </div>

                    <div
                        class="flex w-[56rem] h-[26rem] flex-col justify-center py-5 px-10 bg-black/75 backdrop-blur-md border-4 border-yellow-400 rounded-xl shadow-2xl overflow-hidden">
                        <div class="font-relationship font-black {{ $nameSize }} text-yellow-400 tracking-wide leading-normal pb-2">{{ $graduate->nama }}</div>
                        <div class="font-relationship font-extrabold text-4xl lg:text-5xl text-yellow-200/95 tracking-wider mb-3">{{ $graduate->nim }}</div>
                        <div class="font-poppins font-medium {{ $titleSize }} text-gray-100 leading-snug line-clamp-4">
                            <span class="text-yellow-400 font-poppins font-medium">{{ !in_array($graduate->department?->id, [36,42,43,44]) ? 'Judul Skripsi : ' : 'Judul Tesis : ' }}</span>{{ !in_array($graduate->department?->id, [36,42,43,44]) ? mb_convert_encoding($graduate->judulSkripsi, 'UTF-8') : html_entity_decode(htmlentities($graduate->judulSkripsi)) }}
                        </div>
                        @if ($graduate->passStatements && count($graduate->passStatements) > 0)
                            <ul class="list-disc list-outside px-6 space-y-1 mt-2">
                                @foreach ($graduate->passStatements as $statement)
                                    <li class="font-black text-2xl lg:text-3xl text-amber-300 tracking-wide">
                                        {{ $statement->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                {{-- Baris Bawah: Gelar, Program Studi & Fakultas, Untuk Online --}}
                <div class="w-[77.5rem] py-5 px-8 text-center bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 shadow-2xl font-poppins">
                    <div class="font-medium text-5xl xl:text-6xl text-yellow-400 tracking-wider leading-tight">{{ $graduate->department?->title }}</div>
                    <br>
                    <div class="font-medium text-4xl xl:text-5xl text-white mt-2 tracking-wide leading-tight">{{ __('Program Studi ') . $graduate->department?->name }}</div>
                    <div class="font-medium text-5xl xl:text-6xl text-gray-200 mt-1.5 leading-tight">Fakultas {{ $graduate->department?->faculty?->name }}</div>
                </div>

                {{-- untuk offline --}}
                 {{-- <div class="w-[77.5rem] py-5 px-8 text-center bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 shadow-2xl font-poppins">
                    <div class="font-medium text-5xl xl:text-5xl text-yellow-400 tracking-wider leading-tight">{{ $graduate->department?->title }}</div>
                    <br>
                    <div class="font-medium text-4xl xl:text-4xl text-white mt-2 tracking-wide leading-tight">{{ __('Program Studi ') . $graduate->department?->name }}</div>
                    <div class="font-medium text-5xl xl:text-5xl text-gray-200 mt-1.5 leading-tight">Fakultas {{ $graduate->department?->faculty?->name }}</div>
                </div> --}}
            </div>
        @endforeach
    </div>

</body>

</html>
