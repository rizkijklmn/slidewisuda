<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class DualSlideshowController extends Controller
{
    /**
     * Menampilkan slideshow per jalur / blok tertentu (misal: /jalur/A atau /jalur/B).
     *
     * @param string $block Blok pemanggilan ('A' atau 'B')
     * @param int|string|null $session Nomor urut awal (opsional)
     */
    public function block(string $block, $session = null)
    {
        $block = strtoupper(trim($block));

        $graduates = Graduate::with(['department.faculty', 'passStatements'])
            ->where('idWisuda', 34)
            ->where('blok_pemanggilan', $block)
            ->get()
            ->sortBy(fn($q) => (int) $q->urut)
            ->values();

        return view('slideshow.jalur', [
            'graduates' => $graduates,
            'block' => $block,
            'startIndex' => $session,
        ]);
    }

    /**
     * Menampilkan slideshow 2 jalur sekaligus (Split Screen A & B berdampingan).
     *
     * @param int|string|null $session Nomor urut awal (opsional)
     */
    public function dual($session = null)
    {
        $graduatesA = Graduate::with(['department.faculty', 'passStatements'])
            ->where('idWisuda', 34)
            ->where('blok_pemanggilan', 'A')
            ->get()
            ->sortBy(fn($q) => (int) $q->urut)
            ->values();

        $graduatesB = Graduate::with(['department.faculty', 'passStatements'])
            ->where('idWisuda', 34)
            ->where('blok_pemanggilan', 'B')
            ->get()
            ->sortBy(fn($q) => (int) $q->urut)
            ->values();

        return view('slideshow.dual', [
            'graduatesA' => $graduatesA,
            'graduatesB' => $graduatesB,
            'startIndex' => $session,
        ]);
    }
}

