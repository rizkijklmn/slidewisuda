<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    //
    public function index()
    {
        $filters = [
            'idWisuda' => 31,
            'stKeuangan' => 'system:valid'
        ];

        $graduates = Graduate::with(['department', 'passStatements'])->where($filters)->get()->sortBy(fn ($q) => $q->department->order_id);

        return view('slideshow.index', [
            'graduates' => $graduates->all()
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
