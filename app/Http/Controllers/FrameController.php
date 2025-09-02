<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use App\Models\PassStatement;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    public function index()
    {
        $filters = [
            'idWisuda' => 32,
            // 'stKeuangan' => 'system:valid'
        ];

        // $graduates = Graduate::with(['department', 'passStatements'])->where($filters)->get()->sortBy(fn($q) => $q->department->order_id);
        $graduates = Graduate::with(['department', 'passStatements'])->where($filters)->get()->sortBy(fn($q) => $q->urut);

        return view('frame.index', [
            'graduates' => $graduates->all()
        ]);
    }

    public function predikat()
    {
        // Semua graduate beserta passStatements (bisa kosong)
        $data = Graduate::with('passStatements')
            ->get()
            ->map(function ($graduate) {
                return [
                    'nim' => $graduate->nim,
                    'nama' => $graduate->nama,
                    'pass_statements' => $graduate->passStatements->map(function ($passStatement) {
                        return [
                            // 'nim' => $passStatement->nim, // NIM dari passStatement jika diperlukan
                            'description' => $passStatement->description,
                        ];
                    })->toArray(), // Ubah koleksi passStatements menjadi array
                ];
            });


        // Hanya graduate yang passStatements-nya kosong (belum punya deskripsi)
        $dataPassStatementEmpty = Graduate::with('passStatements')
            ->get()
            ->filter(function ($graduate) {
                return $graduate->passStatements->isEmpty();
            })
            ->map(function ($graduate) {
                return [
                    'nim' => $graduate->nim,
                    'nama' => $graduate->nama,
                    'pass_statements' => [],
                ];
            });


        // Daftar NIM yang ingin difilter
        $specificNIMs = [
            '0101521010',
            '0101623006',
            '0102521703',
            '0106521007',
            '0106521009',
            '0301521003',
            '0301521023',
            '0301521051',
            '0302521012',
            '0302521013',
            '0302521018',
            '0302521022',
            '0311520161',
            '0311521018',
            '0311521030',
            '0311521037',
            '0401521011',
            '0401521017',
            '0401521027',
            '0401521030',
            '0402520010',
            '0403521024',
            '0403521036',
            '0404520014',
            '0404520020',
            '0404521003',
            '0404521007',
            '0404521019',
            '0404521020',
            '0404521023',
            '0601521015',
            '0601521016',
            '0601521026',
            '0601521027',
            '0602521043',
            '0603521035',
            '0603521065',
            '0604521003',
            '0604521009',
            '0701521031',
            '0701521063',
            '0702623001',
            '0702623005',
            '0702623018',
            '0702623039',
            '0702623048',
            '0702623049',
            '0702623050',
            '0702623051',
            '0702623054',
            '0702623055',
            '0702623057',
            '0702623058',
            '0702623059',
            '0702623061',
            '0702623062',
            '0702623064',
            '0702623066',
            '0702623068',
            '0702623069',
            '0702623070',
            '0702623071',
            '0702623072',
            '0702623073',
            '0702623074',
            '0702623075',
            '0702623076',
            '0702623077',
            '0702623079',
            '0702623081',
            '0702623082',
            '0702623083',
            '0711521005',
            '0711521018',
            '0801521031',
            '0801521040',
            '0802521007',
            '0802521044',
            '0802521060',
            '0802521061',
            '0802521084',
            '0802521136',
            '0802521150',
            '0802521151',
            '0802521167',
            '0802521169',
            '0802521184',
            '0802521197',
            '0802521216',
            '0802521238',
            '0803623003',
            '0803623007',
            '0803623009',
            '0311520161'
        ];
        // Hanya graduate dengan NIM tertentu DAN passStatements-nya kosong
        $dataPassStatementEmptyForSpecificNIMs = Graduate::with('passStatements')
            ->whereIn('nim', $specificNIMs) // Filter berdasarkan daftar NIM yang diberikan
            ->get()
            ->map(function ($graduate) {
                return [
                    'nim' => $graduate->nim,
                    'nama' => $graduate->nama,
                    'pass_statements' => $graduate->passStatements->map(function ($passStatement) {
                        return [
                            // 'nim' => $passStatement->nim, // NIM dari passStatement jika diperlukan
                            'description' => $passStatement->description,
                        ];
                    })->toArray(), // Ubah koleksi passStatements menjadi array
                ];
            });


        return response()->json($dataPassStatementEmptyForSpecificNIMs);
    }
}
