<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slideshow Wisudawan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="relative w-screen h-screen bg-wisuda-34-black bg-cover bg-no-repeat flex justify-center items-center ">
        @foreach ($graduates as $graduate)
            @php
                $isCurrent = false;
                if (isset($startIndex) && $startIndex !== null && $startIndex !== '') {
                    $isCurrent = ($graduate->urut == $startIndex) || ($loop->iteration == $startIndex) || ($loop->index == $startIndex);
                } else {
                    $isCurrent = ($loop->index == 0);
                }
            @endphp
            <div
                class="absolute py-4 px-6 mt-12 transition-opacity duration-700 flex flex-col {{ $isCurrent ? 'current' : '' }} slide"
                data-urut="{{ $graduate->urut }}" data-index="{{ $loop->iteration }}">
                <div class="flex flex-row mb-5 items-stretch">
                    <div class="h-[26rem] w-[19.5rem] border-4 border-yellow-400 rounded-xl mr-8 overflow-hidden bg-black/50 shadow-2xl flex-shrink-0">
                        <img src="{{ $graduate->photo_url }}"
                            alt="{{ $graduate->nim }}" class="w-full h-full object-cover" decoding="async">
                    </div>

                    <div
                        class="flex w-[52rem] flex-col justify-center py-7 px-9 bg-black/75 backdrop-blur-md border-4 border-yellow-400 rounded-xl shadow-2xl">
                        <div class="font-black text-4xl lg:text-5xl text-yellow-400 tracking-wide leading-tight mb-2">{{ $graduate->nama }}</div>
                        <div class="font-extrabold text-2xl lg:text-3xl text-yellow-200/90 tracking-wider font-mono mb-4">{{ $graduate->nim }}</div>
                        <div class="font-semibold text-xl lg:text-2xl text-gray-100 leading-snug mb-3">
                            <span class="text-yellow-400 font-black">{{ !in_array($graduate->department?->id, [36,42,43,44]) ? 'Judul Skripsi : ' : 'Judul Tesis : ' }}</span>{{ !in_array($graduate->department?->id, [36,42,43,44]) ? mb_convert_encoding($graduate->judulSkripsi, 'UTF-8') : html_entity_decode(htmlentities($graduate->judulSkripsi)) }}
                        </div>
                        @if ($graduate->passStatements && count($graduate->passStatements) > 0)
                            <ul class="list-disc list-outside px-6 space-y-1.5 mt-1">
                                @foreach ($graduate->passStatements as $statement)
                                    <li class="font-black text-2xl text-amber-300 tracking-wide">
                                        {{ $statement->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="w-full py-6 px-8 text-center bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 shadow-2xl">
                    <div class="font-black text-4xl lg:text-5xl text-yellow-400 tracking-wider">{{ $graduate->department?->title }}</div>
                    <br>
                    <div class="font-extrabold text-3xl lg:text-4xl text-white mt-2.5 tracking-wide">{{ __('Program Studi ') . $graduate->department?->name }}</div>
                    <div class="font-bold text-2xl lg:text-3xl text-gray-200 mt-1.5">Fakultas {{ $graduate->department?->faculty?->name }}</div>
                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
