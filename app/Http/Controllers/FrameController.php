<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    public function index()
    {
        $filters = [
            'idWisuda' => 31,
            'stKeuangan' => 'system:valid'
        ];

        $graduates = Graduate::with(['department', 'passStatements'])->where($filters)->get()->sortBy(fn ($q) => $q->department->order_id);

        return view('frame.index', [
            'graduates' => $graduates->all()
        ]);
    }

}
