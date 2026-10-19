<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slideshow Dual 2 Jalur (A & B) - Wisudawan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .slide-track-a, .slide-track-b {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .slide-item-a, .slide-item-b {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 500ms ease-in-out;
            z-index: 10;
        }

        .slide-item-a.active, .slide-item-b.active {
            opacity: 1;
            pointer-events: auto;
            z-index: 20;
        }

        /* Pulse glow animation saat pindah slide */
        @keyframes subtle-pulse {
            0% { transform: scale(0.985); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        .slide-item-a.active .card-content,
        .slide-item-b.active .card-content {
            animation: subtle-pulse 300ms ease-out;
        }
    </style>
</head>

<body class="overflow-hidden select-none bg-black text-slate-800 font-sans">
    <div class="relative w-screen h-screen bg-wisuda-34-black bg-cover bg-center bg-no-repeat flex flex-col justify-between p-4 md:p-6">

        {{-- Top Header Bar --}}
        <div class="flex items-center justify-between z-30 pb-2 border-b border-yellow-400/40">
            <div class="flex items-center space-x-3">
                <span class="bg-yellow-400 text-black font-extrabold px-3 py-1 rounded text-sm tracking-wider uppercase shadow">
                    Dual Screen
                </span>
                <span class="text-white font-bold text-lg md:text-xl tracking-wide drop-shadow">
                    PEMANGGILAN 2 JALUR WISUDAWAN
                </span>
            </div>

            <div class="flex items-center space-x-4">
                <div id="keyboardInputDisplay" class="hidden px-3 py-1 bg-yellow-400 text-black rounded font-mono font-bold text-sm shadow">
                    Lompat: <span id="keyboardInputVal"></span>
                </div>

                <button id="toggleHelpBtn" class="bg-black/60 hover:bg-black/80 text-yellow-300 border border-yellow-400/50 px-3 py-1 rounded-full text-xs font-semibold backdrop-blur transition flex items-center gap-1.5 cursor-pointer">
                    <span>Petunjuk Tombol</span>
                    <kbd class="bg-white/20 px-1.5 py-0.5 rounded text-[10px]">H</kbd>
                </button>
            </div>
        </div>

        {{-- Main Split-Screen Container (2 Kolom: Kiri Jalur A, Kanan Jalur B) --}}
        <div class="relative flex-1 grid grid-cols-2 gap-4 md:gap-8 my-2 min-h-0">

            {{-- Kolom Kiri: Jalur A --}}
            <div class="relative flex flex-col h-full bg-black/40 backdrop-blur-sm rounded-2xl border-2 border-blue-500/60 p-4 md:p-5 overflow-hidden shadow-2xl">
                {{-- Header Jalur A --}}
                <div class="flex items-center justify-between mb-3 z-30 bg-black/60 px-4 py-2 rounded-xl border border-blue-400/40">
                    <div class="flex items-center space-x-2.5">
                        <span class="w-8 h-8 rounded-full bg-blue-600 text-white font-black text-base flex items-center justify-center shadow">A</span>
                        <span class="text-blue-300 font-extrabold text-lg md:text-xl tracking-wide">JALUR A</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span id="badgeUrutA" class="bg-yellow-400 text-black font-extrabold text-sm md:text-base px-3 py-0.5 rounded shadow">
                            No. Urut: -
                        </span>
                        <span id="counterA" class="text-white/70 text-xs font-semibold">
                            (0 / {{ count($graduatesA) }})
                        </span>
                    </div>
                </div>

                {{-- Track Slide Jalur A --}}
                <div class="slide-track-a flex-1">
                    @forelse ($graduatesA as $graduate)
                        @php
                            $isCurrentA = false;
                            if (isset($startIndex) && $startIndex !== null && $startIndex !== '') {
                                $isCurrentA = ($graduate->urut == $startIndex) || ($loop->iteration == $startIndex);
                            } else {
                                $isCurrentA = ($loop->index == 0);
                            }
                        @endphp
                        <div class="slide-item-a {{ $isCurrentA ? 'active' : '' }}"
                             data-urut="{{ $graduate->urut }}"
                             data-index="{{ $loop->index }}"
                             data-name="{{ $graduate->nama }}">
                            <div class="card-content w-full h-full flex flex-col justify-between py-1">
                                {{-- Baris Atas: Foto + Identitas --}}
                                <div class="flex items-stretch gap-4 md:gap-5 flex-1 min-h-0">
                                    {{-- Foto --}}
                                    <div class="w-44 md:w-52 h-60 md:h-72 border-4 border-yellow-400 rounded-xl overflow-hidden bg-black/50 shadow-xl flex-shrink-0">
                                        <img src="{{ $graduate->photo_url }}"
                                             alt="{{ $graduate->nim }}"
                                             class="w-full h-full object-cover" decoding="async">
                                    </div>

                                    {{-- Detail Teks --}}
                                    <div class="flex-1 flex flex-col justify-between bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 p-4 md:p-5 shadow-xl min-w-0 overflow-hidden text-white">
                                        <div>
                                            <div class="text-xs font-bold text-blue-400 uppercase tracking-wider mb-1 flex items-center gap-1.5">
                                                <span>Jalur A</span> &bull; <span>Urut #{{ $graduate->urut }}</span>
                                            </div>
                                            <h3 class="font-extrabold text-xl md:text-2xl text-yellow-400 leading-tight line-clamp-2">
                                                {{ $graduate->nama }}
                                            </h3>
                                            <p class="font-semibold text-sm md:text-base text-yellow-200/90 mt-0.5 tracking-wider font-mono">
                                                {{ $graduate->nim }}
                                            </p>
                                        </div>

                                        <div class="my-2 border-t border-b border-white/20 py-2">
                                            <p class="text-xs font-bold text-yellow-400 uppercase">
                                                {{ !in_array($graduate->department?->id, [36, 42, 43, 44]) ? 'Judul Skripsi:' : 'Judul Tesis:' }}
                                            </p>
                                            <p class="text-xs md:text-sm text-gray-200 line-clamp-3 italic leading-relaxed mt-0.5">
                                                {{ !in_array($graduate->department?->id, [36, 42, 43, 44]) ? mb_convert_encoding($graduate->judulSkripsi, 'UTF-8') : html_entity_decode(htmlentities($graduate->judulSkripsi)) }}
                                            </p>
                                        </div>

                                        @if ($graduate->passStatements && count($graduate->passStatements) > 0)
                                            <div>
                                                <ul class="space-y-0.5">
                                                    @foreach ($graduate->passStatements as $statement)
                                                        <li class="font-bold text-xs md:text-sm text-amber-300 flex items-center gap-1.5">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                                            <span class="line-clamp-1">{{ $statement->description }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Baris Bawah: Program Studi & Fakultas --}}
                                <div class="mt-3 bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 py-3 px-4 text-center shadow-xl flex-shrink-0 text-white">
                                    <div class="font-bold text-base md:text-xl text-yellow-400 leading-tight">
                                        {{ __('Program Studi ') . $graduate->department?->name }}
                                    </div>
                                    <div class="text-xs md:text-sm font-semibold text-gray-200 mt-0.5">
                                        {{ $graduate->department?->faculty?->name }} &bull; {{ $graduate->department?->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex items-center justify-center text-center p-6 text-white/80">
                            <div>
                                <div class="text-4xl mb-2">ℹ️</div>
                                <p class="font-bold text-lg">Belum ada data wisudawan untuk Jalur A</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Kolom Kanan: Jalur B --}}
            <div class="relative flex flex-col h-full bg-black/40 backdrop-blur-sm rounded-2xl border-2 border-emerald-500/60 p-4 md:p-5 overflow-hidden shadow-2xl">
                {{-- Header Jalur B --}}
                <div class="flex items-center justify-between mb-3 z-30 bg-black/60 px-4 py-2 rounded-xl border border-emerald-400/40">
                    <div class="flex items-center space-x-2.5">
                        <span class="w-8 h-8 rounded-full bg-emerald-600 text-white font-black text-base flex items-center justify-center shadow">B</span>
                        <span class="text-emerald-300 font-extrabold text-lg md:text-xl tracking-wide">JALUR B</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span id="badgeUrutB" class="bg-yellow-400 text-black font-extrabold text-sm md:text-base px-3 py-0.5 rounded shadow">
                            No. Urut: -
                        </span>
                        <span id="counterB" class="text-white/70 text-xs font-semibold">
                            (0 / {{ count($graduatesB) }})
                        </span>
                    </div>
                </div>

                {{-- Track Slide Jalur B --}}
                <div class="slide-track-b flex-1">
                    @forelse ($graduatesB as $graduate)
                        @php
                            $isCurrentB = false;
                            if (isset($startIndex) && $startIndex !== null && $startIndex !== '') {
                                $isCurrentB = ($graduate->urut == $startIndex) || ($loop->iteration == $startIndex);
                            } else {
                                $isCurrentB = ($loop->index == 0);
                            }
                        @endphp
                        <div class="slide-item-b {{ $isCurrentB ? 'active' : '' }}"
                             data-urut="{{ $graduate->urut }}"
                             data-index="{{ $loop->index }}"
                             data-name="{{ $graduate->nama }}">
                            <div class="card-content w-full h-full flex flex-col justify-between py-1">
                                {{-- Baris Atas: Foto + Identitas --}}
                                <div class="flex items-stretch gap-4 md:gap-5 flex-1 min-h-0">
                                    {{-- Foto --}}
                                    <div class="w-44 md:w-52 h-60 md:h-72 border-4 border-yellow-400 rounded-xl overflow-hidden bg-black/50 shadow-xl flex-shrink-0">
                                        <img src="{{ $graduate->photo_url }}"
                                             alt="{{ $graduate->nim }}"
                                             class="w-full h-full object-cover" decoding="async">
                                    </div>

                                    {{-- Detail Teks --}}
                                    <div class="flex-1 flex flex-col justify-between bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 p-4 md:p-5 shadow-xl min-w-0 overflow-hidden text-white">
                                        <div>
                                            <div class="text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1 flex items-center gap-1.5">
                                                <span>Jalur B</span> &bull; <span>Urut #{{ $graduate->urut }}</span>
                                            </div>
                                            <h3 class="font-extrabold text-xl md:text-2xl text-yellow-400 leading-tight line-clamp-2">
                                                {{ $graduate->nama }}
                                            </h3>
                                            <p class="font-semibold text-sm md:text-base text-yellow-200/90 mt-0.5 tracking-wider font-mono">
                                                {{ $graduate->nim }}
                                            </p>
                                        </div>

                                        <div class="my-2 border-t border-b border-white/20 py-2">
                                            <p class="text-xs font-bold text-yellow-400 uppercase">
                                                {{ !in_array($graduate->department?->id, [36, 42, 43, 44]) ? 'Judul Skripsi:' : 'Judul Tesis:' }}
                                            </p>
                                            <p class="text-xs md:text-sm text-gray-200 line-clamp-3 italic leading-relaxed mt-0.5">
                                                {{ !in_array($graduate->department?->id, [36, 42, 43, 44]) ? mb_convert_encoding($graduate->judulSkripsi, 'UTF-8') : html_entity_decode(htmlentities($graduate->judulSkripsi)) }}
                                            </p>
                                        </div>

                                        @if ($graduate->passStatements && count($graduate->passStatements) > 0)
                                            <div>
                                                <ul class="space-y-0.5">
                                                    @foreach ($graduate->passStatements as $statement)
                                                        <li class="font-bold text-xs md:text-sm text-amber-300 flex items-center gap-1.5">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                                            <span class="line-clamp-1">{{ $statement->description }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Baris Bawah: Program Studi & Fakultas --}}
                                <div class="mt-3 bg-black/75 backdrop-blur-md rounded-xl border-4 border-yellow-400 py-3 px-4 text-center shadow-xl flex-shrink-0 text-white">
                                    <div class="font-bold text-base md:text-xl text-yellow-400 leading-tight">
                                        {{ __('Program Studi ') . $graduate->department?->name }}
                                    </div>
                                    <div class="text-xs md:text-sm font-semibold text-gray-200 mt-0.5">
                                        {{ $graduate->department?->faculty?->name }} &bull; {{ $graduate->department?->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex items-center justify-center text-center p-6 text-white/80">
                            <div>
                                <div class="text-4xl mb-2">ℹ️</div>
                                <p class="font-bold text-lg">Belum ada data wisudawan untuk Jalur B</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Bottom Floating Control Bar --}}
        <div id="controlBar" class="z-40 flex items-center justify-between bg-black/75 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-yellow-400/50 shadow-2xl transition-all">
            {{-- Kontrol Jalur A --}}
            <div class="flex items-center space-x-2">
                <span class="text-blue-400 font-bold text-xs">Jalur A:</span>
                <button id="btnPrevA" class="px-2.5 py-1 bg-blue-700/80 hover:bg-blue-600 text-white rounded text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                    ◀ Prev (↑)
                </button>
                <button id="btnNextA" class="px-2.5 py-1 bg-blue-700/80 hover:bg-blue-600 text-white rounded text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                    Next (↓) ▶
                </button>
            </div>

            {{-- Kontrol Bersamaan (Dual Sync) --}}
            <div class="flex items-center space-x-2">
                <button id="btnSyncPrev" class="px-3 py-1 bg-yellow-500/90 hover:bg-yellow-400 text-black rounded text-xs font-extrabold transition flex items-center gap-1 shadow cursor-pointer">
                    ⏪ Mundur Berdua (⬅️)
                </button>
                <button id="btnSyncNext" class="px-4 py-1.5 bg-yellow-400 hover:bg-yellow-300 text-black rounded text-sm font-black transition flex items-center gap-1.5 shadow-lg scale-105 cursor-pointer">
                    Maju Berdua (➡️ / Spasi) ⏩
                </button>
            </div>

            {{-- Kontrol Jalur B --}}
            <div class="flex items-center space-x-2">
                <button id="btnPrevB" class="px-2.5 py-1 bg-emerald-700/80 hover:bg-emerald-600 text-white rounded text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                    ◀ Prev (PgUp)
                </button>
                <button id="btnNextB" class="px-2.5 py-1 bg-emerald-700/80 hover:bg-emerald-600 text-white rounded text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                    Next (PgDn) ▶
                </button>
                <span class="text-emerald-400 font-bold text-xs ml-1">:Jalur B</span>
            </div>
        </div>

        {{-- Modal / Popover Petunjuk Shortcut Keyboard --}}
        <div id="helpModal" class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
            <div class="bg-gray-900 border-2 border-yellow-400 rounded-2xl p-6 max-w-lg w-full text-white shadow-2xl relative">
                <div class="flex items-center justify-between pb-3 border-b border-gray-700">
                    <h3 class="text-xl font-black text-yellow-400">Petunjuk Tombol Keyboard</h3>
                    <button id="closeHelpBtn" class="text-gray-400 hover:text-white text-2xl font-bold cursor-pointer">&times;</button>
                </div>

                <div class="mt-4 space-y-3 text-sm">
                    <div class="bg-gray-800/80 p-3 rounded-lg border border-gray-700">
                        <div class="font-bold text-yellow-300 mb-1">Maju / Mundur Bersamaan:</div>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div><kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">➡️</kbd> atau <kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">Spasi</kbd> : Maju Keduanya</div>
                            <div><kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">⬅️</kbd> : Mundur Keduanya</div>
                        </div>
                    </div>

                    <div class="bg-gray-800/80 p-3 rounded-lg border border-gray-700">
                        <div class="font-bold text-blue-300 mb-1">Kendali Khusus Jalur A Saja:</div>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div><kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">⬇️</kbd> atau <kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">A</kbd> : Maju Jalur A</div>
                            <div><kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">⬆️</kbd> atau <kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">Shift+A</kbd> : Mundur Jalur A</div>
                        </div>
                    </div>

                    <div class="bg-gray-800/80 p-3 rounded-lg border border-gray-700">
                        <div class="font-bold text-emerald-300 mb-1">Kendali Khusus Jalur B Saja:</div>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div><kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">PageDown</kbd> atau <kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">B</kbd> : Maju Jalur B</div>
                            <div><kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">PageUp</kbd> atau <kbd class="bg-white/20 px-2 py-0.5 rounded font-mono">Shift+B</kbd> : Mundur Jalur B</div>
                        </div>
                    </div>

                    <div class="bg-gray-800/80 p-3 rounded-lg border border-gray-700">
                        <div class="font-bold text-yellow-300 mb-1">Lompat Nomor Urut:</div>
                        <p class="text-xs text-gray-300 mb-1">Ketik angka lalu tekan <kbd class="bg-white/20 px-1.5 py-0.5 rounded font-mono">Enter</kbd> (atau tunggu 1 detik):</p>
                        <ul class="text-xs list-disc list-inside space-y-1 text-gray-300">
                            <li><strong class="text-white">Ketik angka (misal "2"):</strong> Kedua jalur lompat ke nomor urut 2</li>
                            <li><strong class="text-blue-300">Ketik "a2" atau "A2":</strong> Jalur A saja yang lompat ke nomor urut 2</li>
                            <li><strong class="text-emerald-300">Ketik "b2" atau "B2":</strong> Jalur B saja yang lompat ke nomor urut 2</li>
                        </ul>
                    </div>

                    <div class="bg-gray-800/80 p-3 rounded-lg border border-gray-700 flex justify-between items-center text-xs">
                        <span>Sembunyikan / Tampilkan Bar Bawah:</span>
                        <kbd class="bg-white/20 px-2 py-0.5 rounded font-mono text-yellow-300 font-bold">H</kbd>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <button id="okHelpBtn" class="px-6 py-2 bg-yellow-400 text-black font-extrabold rounded-lg hover:bg-yellow-300 transition cursor-pointer">
                        Mengerti
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- Script Navigasi Dual Screen --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const itemsA = Array.from(document.querySelectorAll(".slide-item-a"));
            const itemsB = Array.from(document.querySelectorAll(".slide-item-b"));

            const badgeUrutA = document.getElementById("badgeUrutA");
            const badgeUrutB = document.getElementById("badgeUrutB");
            const counterA = document.getElementById("counterA");
            const counterB = document.getElementById("counterB");

            const inputDisplay = document.getElementById("keyboardInputDisplay");
            const inputValEl = document.getElementById("keyboardInputVal");

            const helpModal = document.getElementById("helpModal");
            const toggleHelpBtn = document.getElementById("toggleHelpBtn");
            const closeHelpBtn = document.getElementById("closeHelpBtn");
            const okHelpBtn = document.getElementById("okHelpBtn");
            const controlBar = document.getElementById("controlBar");

            let indexA = itemsA.findIndex(el => el.classList.contains("active"));
            let indexB = itemsB.findIndex(el => el.classList.contains("active"));

            if (indexA === -1 && itemsA.length > 0) indexA = 0;
            if (indexB === -1 && itemsB.length > 0) indexB = 0;

            const updateStatus = () => {
                if (itemsA.length > 0 && indexA >= 0 && indexA < itemsA.length) {
                    const elA = itemsA[indexA];
                    badgeUrutA.textContent = `No. Urut: ${elA.dataset.urut || '-'}`;
                    counterA.textContent = `(${indexA + 1} / ${itemsA.length})`;
                } else {
                    badgeUrutA.textContent = "No. Urut: -";
                    counterA.textContent = `(0 / ${itemsA.length})`;
                }

                if (itemsB.length > 0 && indexB >= 0 && indexB < itemsB.length) {
                    const elB = itemsB[indexB];
                    badgeUrutB.textContent = `No. Urut: ${elB.dataset.urut || '-'}`;
                    counterB.textContent = `(${indexB + 1} / ${itemsB.length})`;
                } else {
                    badgeUrutB.textContent = "No. Urut: -";
                    counterB.textContent = `(0 / ${itemsB.length})`;
                }
            };

            const goToA = (newIndex) => {
                if (itemsA.length === 0) return;
                const target = Math.max(0, Math.min(newIndex, itemsA.length - 1));
                itemsA.forEach((el, idx) => {
                    el.classList.toggle("active", idx === target);
                });
                indexA = target;
                updateStatus();
            };

            const goToB = (newIndex) => {
                if (itemsB.length === 0) return;
                const target = Math.max(0, Math.min(newIndex, itemsB.length - 1));
                itemsB.forEach((el, idx) => {
                    el.classList.toggle("active", idx === target);
                });
                indexB = target;
                updateStatus();
            };

            const nextA = () => goToA(indexA + 1 >= itemsA.length ? 0 : indexA + 1);
            const prevA = () => goToA(indexA - 1 < 0 ? itemsA.length - 1 : indexA - 1);

            const nextB = () => goToB(indexB + 1 >= itemsB.length ? 0 : indexB + 1);
            const prevB = () => goToB(indexB - 1 < 0 ? itemsB.length - 1 : indexB - 1);

            const nextBoth = () => {
                nextA();
                nextB();
            };

            const prevBoth = () => {
                prevA();
                prevB();
            };

            const jumpByUrut = (track, targetUrut) => {
                const num = parseInt(targetUrut, 10);
                if (isNaN(num)) return;

                if (track === 'A' || track === 'BOTH') {
                    const foundA = itemsA.findIndex(el => parseInt(el.dataset.urut, 10) === num);
                    if (foundA !== -1) {
                        goToA(foundA);
                    } else if (num >= 1 && num <= itemsA.length) {
                        goToA(num - 1);
                    }
                }

                if (track === 'B' || track === 'BOTH') {
                    const foundB = itemsB.findIndex(el => parseInt(el.dataset.urut, 10) === num);
                    if (foundB !== -1) {
                        goToB(foundB);
                    } else if (num >= 1 && num <= itemsB.length) {
                        goToB(num - 1);
                    }
                }
            };

            // Init status
            goToA(indexA);
            goToB(indexB);

            // Button Event Listeners
            document.getElementById("btnPrevA")?.addEventListener("click", prevA);
            document.getElementById("btnNextA")?.addEventListener("click", nextA);
            document.getElementById("btnPrevB")?.addEventListener("click", prevB);
            document.getElementById("btnNextB")?.addEventListener("click", nextB);
            document.getElementById("btnSyncPrev")?.addEventListener("click", prevBoth);
            document.getElementById("btnSyncNext")?.addEventListener("click", nextBoth);

            // Help Modal Handlers
            const toggleHelp = () => helpModal.classList.toggle("hidden");
            toggleHelpBtn?.addEventListener("click", toggleHelp);
            closeHelpBtn?.addEventListener("click", () => helpModal.classList.add("hidden"));
            okHelpBtn?.addEventListener("click", () => helpModal.classList.add("hidden"));

            // Keyboard Typing Buffer
            let typedBuffer = "";
            let typeTimeout = null;

            const processTypedBuffer = () => {
                if (!typedBuffer) return;
                const raw = typedBuffer.trim();
                const prefix = raw[0].toUpperCase();

                if (prefix === 'A' && raw.length > 1) {
                    jumpByUrut('A', raw.slice(1));
                } else if (prefix === 'B' && raw.length > 1) {
                    jumpByUrut('B', raw.slice(1));
                } else {
                    jumpByUrut('BOTH', raw);
                }

                typedBuffer = "";
                inputDisplay.classList.add("hidden");
            };

            document.addEventListener("keydown", (e) => {
                if (["INPUT", "TEXTAREA", "SELECT"].includes(document.activeElement?.tagName)) return;

                // Toggle Help with 'H' or 'h'
                if (e.key === 'h' || e.key === 'H') {
                    if (helpModal.classList.contains("hidden")) {
                        controlBar.classList.toggle("opacity-0");
                        controlBar.classList.toggle("pointer-events-none");
                    } else {
                        helpModal.classList.add("hidden");
                    }
                    return;
                }

                // Escape closes modal
                if (e.key === "Escape") {
                    helpModal.classList.add("hidden");
                    typedBuffer = "";
                    inputDisplay.classList.add("hidden");
                    return;
                }

                // Enter triggers immediately
                if (e.key === "Enter" && typedBuffer.length > 0) {
                    clearTimeout(typeTimeout);
                    processTypedBuffer();
                    return;
                }

                // Backspace removes character
                if (e.key === "Backspace" && typedBuffer.length > 0) {
                    clearTimeout(typeTimeout);
                    typedBuffer = typedBuffer.slice(0, -1);
                    if (typedBuffer.length === 0) {
                        inputDisplay.classList.add("hidden");
                    } else {
                        inputValEl.textContent = typedBuffer;
                    }
                    return;
                }

                // Numbers or A/B prefixes for jump
                if ((e.key >= "0" && e.key <= "9") || ((e.key === "a" || e.key === "A" || e.key === "b" || e.key === "B") && typedBuffer.length === 0)) {
                    clearTimeout(typeTimeout);
                    typedBuffer += e.key;
                    inputValEl.textContent = typedBuffer;
                    inputDisplay.classList.remove("hidden");

                    typeTimeout = setTimeout(() => {
                        processTypedBuffer();
                    }, 1200);
                    return;
                }

                // Arrow keys navigation
                switch (e.key) {
                    case "ArrowRight":
                    case " ":
                        e.preventDefault();
                        nextBoth();
                        break;
                    case "ArrowLeft":
                        e.preventDefault();
                        prevBoth();
                        break;
                    case "ArrowDown":
                        e.preventDefault();
                        nextA();
                        break;
                    case "ArrowUp":
                        e.preventDefault();
                        prevA();
                        break;
                    case "PageDown":
                        e.preventDefault();
                        nextB();
                        break;
                    case "PageUp":
                        e.preventDefault();
                        prevB();
                        break;
                }
            });
        });
    </script>
</body>

</html>

