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
    <div class="relative h-screen bg-[#00ff00]">
        @foreach ($graduates as $graduate)

        {{-- Wrapper detail student --}}
            <div
                class="absolute left-0 bottom-0 right-0 py-12 {{--transition-opacity duration-300--}} h-full w-full flex flex-col justify-between items-center  {{ $loop->index == 0 ? 'current' : '' }} slide">

                {{-- Faculty and departments --}}
                <div class="w-full text-end mr-3">
                    <div class="text-yellow-400
                        text-6xl text-bold text-shadow-sm shadow-gray-600">
                        {{ $graduate->department?->faculty->name }}</div>
                    <div class="text-yellow-400
                        text-4xl text-bold text-shadow-sm shadow-gray-600 mt-2" style="font-size:3.25rem;">
                        {{ $graduate->department?->name }}</div>
                </div>
                {{-- End of faculty and departments --}}

                {{-- Pass statement --}}
                <div class="flex self-end">
                    <ul class="px-4 text-yellow-400 text-end mb-12">
                        @foreach ($graduate->passStatements as $statement)
                            <li class="font-bold text-4xl text-shadow-sm shadow-gray-600 max-w-full">
                                {{ $statement->description }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- End of pass statements --}}

                {{-- Student detail --}}
                <div class="flex justify-between items-center w-full">
                    <div class="flex">
                        <div class="w-60 h-80 border-4 rounded border-white ml-2">
                            <img src="{{ asset('storage/images/32/' . $graduate->nim . '.jpg') }}"
                                alt="{{ $graduate->nim }}" class="w-full h-full" loading="lazy" />
                        </div>

                        <div class="ml-6 flex flex-col justify-end" style="margin-bottom:90px;">
                            <div class="text-yellow-400 font-bold text-6xl text-shadow-sm shadow-gray-600">
                                {{ $graduate->nama }}</div>
                            <div class="text-yellow-400 text-bold {{--text-4xl--}} text-shadow-sm shadow-gray-600" style="font-size:3.25rem;">
                                {{ $graduate->department?->title }}</div>
                        </div>
                    </div>
                </div>
                {{-- End of student detail --}}
            </div>
            {{-- End of wrapper detail student --}}
        @endforeach
    </div>

</body>

</html>
