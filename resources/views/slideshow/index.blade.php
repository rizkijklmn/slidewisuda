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
                <div class="flex flex-row mb-4">
                    <div class="h-96 w-72 border-4 border-yellow-400 rounded-md mr-8 overflow-hidden">
                        <img src="{{ $graduate->photo_url }}"
                            alt="{{ $graduate->nim }}" class="w-full h-full object-cover" decoding="async">
                    </div>

                    <div
                        class="flex min-w-[48rem] max-w-lg flex-col justify-center py-2 px-4 bg-white border-4 border-yellow-400 rounded-md">
                        <div class="font-bold text-3xl">{{ $graduate->nama }}</div>
                        <div class="font-medium text-xl mb-2">{{ $graduate->nim }}</div>
                        <div class="font-medium mb-2 text-xl">
                            {{ !in_array($graduate->department?->id, [36,42,43,44])? 'Judul Skripsi : ' . mb_convert_encoding($graduate->judulSkripsi, 'UTF-8') : 'Judul Tesis : ' . html_entity_decode(htmlentities($graduate->judulSkripsi)) }}
                        </div>
                        <ul class="list-disc list-outside px-4">
                            @foreach ($graduate->passStatements as $statement)
                                <li class="font-bold text-xl">
                                    {{ $statement->description }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="py-6 text-center font-bold text-3xl bg-white rounded-md border-4 border-yellow-400">
                    <div>{{ $graduate->department?->title }}</div>
                    <br>
                    <div>{{ __('Program Studi ') . $graduate->department?->name }}</div>
                    <div>Fakultas {{ $graduate->department?->faculty->name }}</div>
                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
