<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    //
    public function index($session = null)
    {
        $filters = [
            'idWisuda' => 34,
            // 'stKeuangan' => 'system:valid'
        ];

        // $graduates = Graduate::with(['department', 'passStatements'])->where($filters)->get()->sortBy(fn ($q) => $q->department?->order_id);
        $graduates = Graduate::with(['department', 'passStatements'])
            ->where($filters)
            ->where('ketPerpustakaan', 'like', '%Online%')
            ->get()
            ->sortBy(fn($q) => $q->urut);

        return view('slideshow.index', [
            'graduates' => $graduates->all(),
            'startIndex' => $session
        ]);
    }

    // public function show($index)
    // {
    //     $graduates = Graduate::with(['department'])->where('idWisuda', 28)->get()->sortBy(function ($q) {
    //         return $q->department->order_id;
    //     });

    //     return view('slideshow.show', [
    //         'graduates' => $graduates,
    //         'index' => $index
    //     ]);
    // }
}
