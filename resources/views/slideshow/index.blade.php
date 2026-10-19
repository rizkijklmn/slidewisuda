<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slideshow Wisudawan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

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

                // Ukuran font otomatis menyesuaikan panjang karakter nama agar tidak terpotong / turun 3 baris
                $nameLen = mb_strlen(trim($graduate->nama));
                if ($nameLen <= 16) {
                    $nameSize = 'text-7xl lg:text-8xl';
                } elseif ($nameLen <= 26) {
                    $nameSize = 'text-5xl lg:text-6xl';
                } elseif ($nameLen <= 36) {
                    $nameSize = 'text-4xl lg:text-5xl';
                } else {
                    $nameSize = 'text-3xl lg:text-4xl';
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
                        <div class="font-black {{ $nameSize }} text-yellow-400 tracking-wide leading-normal pb-2">{{ $graduate->nama }}</div>
                        <div class="font-extrabold text-4xl lg:text-5xl text-yellow-200/95 tracking-wider font-mono mb-3">{{ $graduate->nim }}</div>
                        <div class="font-semibold {{ $titleSize }} text-gray-100 leading-snug line-clamp-4">
                            <span class="text-yellow-400 font-black">{{ !in_array($graduate->department?->id, [36,42,43,44]) ? 'Judul Skripsi : ' : 'Judul Tesis : ' }}</span>{{ !in_array($graduate->department?->id, [36,42,43,44]) ? mb_convert_encoding($graduate->judulSkripsi, 'UTF-8') : html_entity_decode(htmlentities($graduate->judulSkripsi)) }}
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

                {{-- Baris Bawah: Gelar, Program Studi & Fakultas --}}
                <div class="w-[77.5rem] py-5 px-8 text-center bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 shadow-2xl">
                    <div class="font-black text-5xl xl:text-6xl text-yellow-400 tracking-wider leading-tight">{{ $graduate->department?->title }}</div>
                    <br>
                    <div class="font-black text-4xl xl:text-5xl text-white mt-2 tracking-wide leading-tight">{{ __('Program Studi ') . $graduate->department?->name }}</div>
                    <div class="font-extrabold text-5xl xl:text-6xl text-gray-200 mt-1.5 leading-tight">Fakultas {{ $graduate->department?->faculty?->name }}</div>
                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
