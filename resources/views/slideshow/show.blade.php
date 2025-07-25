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
    <div class="relative w-screen h-screen bg-wisuda-27 bg-cover bg-no-repeat flex justify-center items-center ">
        @foreach ($graduates as $graduate)
            <div
                class="absolute py-4 px-6 transition-opacity duration-700 flex flex-col {{ $loop->index == $index ? 'current' : '' }} slide">
                <div class="flex flex-row mb-4">
                    <div class="h-80 w-64 border-4 border-yellow-400 rounded-md mr-8">
                        <img src="{{ asset('storage/images/28/' . $graduate->nim . '.jpg') }}" alt="Graduate Image"
                            class="h-full w-full">
                    </div>
                    <div
                        class="flex min-w-[32rem] max-w-lg flex-col justify-center py-2 px-4 bg-white border-4 border-yellow-400 rounded-md ">
                        <div class="font-bold text-xl">{{ $graduate->nama }}</div>
                        <div class="font-medium text-lg">{{ $graduate->nim }}</div>
                        <div class="font-medium">
                            {{ $graduate->department->id != 36 ? 'Judul Skripsi : ' . $graduate->judulSkripsi : 'Judul Tesis : ' . $graduate->judulSkripsi }}
                        </div>
                    </div>
                </div>
                <div class="py-6 text-center font-bold text-xl bg-white rounded-md border-4 border-yellow-400">
                    <div class="">{{ __('Program Studi ') . $graduate->department->name }}</div>
                    <div class="">{{ $graduate->department->faculty->name }}</div>
                    <div class="">{{ $graduate->department->title }}</div>
                </div>
            </div>
        @endforeach

    </div>

</body>

</html>
