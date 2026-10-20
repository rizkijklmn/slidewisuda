<!DOCTYPE html>
<html lang="id">

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
        // Masukkan nomor urut di sini, contoh: 1, 5, 12
    ];

    // Opsi jika ada nama yang SANGAT panjang sekali dan butuh lebih kecil lagi:
    $extraSmallNameList = [
        // Masukkan nomor urut di sini jika butuh ekstra kecil
    ];
@endphp

<body class="overflow-hidden select-none bg-black text-slate-800">
    <div
        class="relative w-screen h-screen bg-wisuda-34-black bg-cover bg-center bg-no-repeat flex justify-center items-center">

        {{-- Badge Status Jalur di Pojok Kiri Atas --}}
        {{-- <div class="absolute top-6 left-8 z-40 flex items-center space-x-3 bg-black/60 backdrop-blur-md px-5 py-2.5 rounded-full border border-yellow-400/60 shadow-lg">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-black text-lg {{ $block === 'A' ? 'bg-blue-600 text-white' : 'bg-emerald-600 text-white' }}">
                {{ $block }}
            </span>
            <div class="text-white text-sm font-semibold tracking-wide">
                JALUR {{ $block }} <span class="text-yellow-400 font-bold ml-1">({{ count($graduates) }} Wisudawan)</span>
            </div>
        </div> --}}

        {{-- Hint shortcut keyboard di Pojok Kanan Atas --}}
        {{-- <div class="absolute top-6 right-8 z-40 hidden md:flex items-center space-x-2 bg-black/60 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 text-xs text-yellow-200 shadow-lg">
            <span>Navigasi:</span>
            <kbd class="px-2 py-0.5 bg-white/20 rounded font-mono font-bold text-white">⬅️ / ➡️</kbd>
            <span class="text-white/60">atau ketik</span>
            <kbd class="px-2 py-0.5 bg-white/20 rounded font-mono font-bold text-white">[No. Urut]</kbd>
        </div> --}}

        @if (count($graduates) === 0)
            <div
                class="bg-white/95 backdrop-blur-md p-10 rounded-2xl border-4 border-yellow-400 text-center max-w-lg shadow-2xl z-20">
                <div class="text-5xl mb-4">🎓</div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Data Wisudawan</h2>
                <p class="text-gray-600">Tidak ada data wisudawan dengan blok pemanggilan <strong
                        class="text-yellow-600 font-black">"{{ $block }}"</strong> pada Wisuda 34.</p>
                <div class="mt-6 flex justify-center gap-3">
                    <a href="{{ url('/jalur/A') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition">Buka
                        Jalur A</a>
                    <a href="{{ url('/jalur/B') }}"
                        class="px-4 py-2 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition">Buka
                        Jalur B</a>
                    <a href="{{ url('/dual') }}"
                        class="px-4 py-2 bg-amber-500 text-black rounded-lg font-bold hover:bg-amber-400 transition">Buka
                        Dual View</a>
                </div>
            </div>
        @else
            @foreach ($graduates as $graduate)
                @php
                    $isCurrent = false;
                    if (isset($startIndex) && $startIndex !== null && $startIndex !== '') {
                        $isCurrent =
                            $graduate->urut == $startIndex ||
                            $loop->iteration == $startIndex ||
                            $loop->index == $startIndex;
                    } else {
                        $isCurrent = $loop->index == 0;
                    }

                    // Logika ukuran font nama:
                    // Default: 'text-7xl lg:text-8xl'
                    // Jika nomor urut ada di dalam array $smallNameList: ukuran diperkecil agar tetap 1 baris (horizontal)
                    if (in_array($graduate->urut, $extraSmallNameList)) {
                        $nameSize = 'text-4xl lg:text-5xl whitespace-nowrap';
                    } elseif (in_array($graduate->urut, $smallNameList)) {
                        $nameSize = 'text-5xl lg:text-6xl whitespace-nowrap';
                    } else {
                        $nameSize = 'text-7xl lg:text-8xl';
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
                <div class="absolute py-4 px-6 mt-8 transition-opacity duration-700 flex flex-col {{ $isCurrent ? 'current' : '' }} slide"
                    data-urut="{{ $graduate->urut }}" data-index="{{ $loop->iteration }}"
                    data-block="{{ $block }}">

                    {{-- Header Card: Indikator Jalur & Nomor Urut --}}
                    <div class="flex items-center justify-between mb-3 px-2">
                        <div class="flex items-center space-x-3">
                            <span
                                class="px-4 py-1.5 rounded-md font-black text-xl shadow-md {{ $block === 'A' ? 'bg-blue-600 text-white' : 'bg-emerald-600 text-white' }}">
                                JALUR {{ $block }}
                            </span>
                            <span
                                class="bg-yellow-400 text-black px-4 py-1.5 rounded-md font-extrabold text-xl shadow-md">
                                NO. URUT {{ $graduate->urut }}
                            </span>
                        </div>
                        <div class="text-yellow-300/80 font-bold text-sm tracking-wider uppercase">
                            Slide {{ $loop->iteration }} dari {{ $loop->count }}
                        </div>
                    </div>

                    <div class="flex flex-row mb-3 items-stretch">
                        {{-- Foto Wisudawan --}}
                        <div
                            class="h-[26rem] w-[19.5rem] border-4 border-yellow-400 rounded-xl mr-8 overflow-hidden bg-black/50 shadow-2xl flex-shrink-0">
                            <img src="{{ $graduate->photo_url }}" alt="{{ $graduate->nim }}"
                                class="w-full h-full object-cover" decoding="async">
                        </div>

                        {{-- Detail Wisudawan --}}
                        <div
                            class="flex w-[56rem] h-[26rem] flex-col justify-center py-5 px-10 bg-black/75 backdrop-blur-md border-4 border-yellow-400 rounded-xl shadow-2xl overflow-hidden">
                            <div class="font-relationship font-black {{ $nameSize }} text-yellow-400 tracking-wide leading-normal pb-2">{{ $graduate->nama }}</div>
                            <div class="font-relationship font-extrabold text-4xl lg:text-5xl text-yellow-200/95 tracking-wider mb-3">{{ $graduate->nim }}</div>

                            <div class="font-poppins font-medium {{ $titleSize }} text-gray-100 leading-snug line-clamp-4">
                                <span class="text-yellow-400 font-poppins font-medium">{{ !in_array($graduate->department?->id, [36, 42, 43, 44]) ? 'Judul Skripsi : ' : 'Judul Tesis : ' }}</span>{{ !in_array($graduate->department?->id, [36, 42, 43, 44]) ? mb_convert_encoding($graduate->judulSkripsi, 'UTF-8') : html_entity_decode(htmlentities($graduate->judulSkripsi)) }}
                            </div>

                            @if ($graduate->passStatements && count($graduate->passStatements) > 0)
                                <ul class="list-disc list-outside px-6 space-y-1 mt-2.5">
                                    @foreach ($graduate->passStatements as $statement)
                                        <li class="font-black text-3xl text-amber-300 tracking-wide">
                                            {{ $statement->description }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    {{-- Footer Card: Program Studi, Fakultas, Gelar --}}
                    <div class="w-[77.5rem] py-5 px-8 text-center bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 shadow-2xl font-poppins">
                        <div class="font-medium text-5xl xl:text-6xl text-yellow-400 tracking-wider leading-tight">{{ $graduate->department?->title }}</div>
                        <div class="font-medium text-4xl xl:text-5xl text-white mt-2 tracking-wide leading-tight">{{ __('Program Studi ') . $graduate->department?->name }}</div>
                        <div class="font-medium text-3xl xl:text-4xl text-gray-200 mt-1.5 leading-tight">Fakultas {{ $graduate->department?->faculty?->name }}</div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>

</html>
