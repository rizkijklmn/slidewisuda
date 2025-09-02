<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PassStatement;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $nims = [
        //     '0311520161',
        //     '0311521018',
        //     '0311521030',
        //     '0311521037'
        // ];

        // foreach ($nims as $nim) {
        //     PassStatement::create([
        //         'nim' => $nim,
        //         'description' => 'Lulus dengan Predikat Cumlaude'
        //     ]);
        // }

        // Jobs
        // PassStatement::create([
        //     'nim' => '0702623006',
        //     'description' => 'Pekerjaan Pertama'
        // ]);

        // High scores
        // PassStatement::create([
        //     'nim' => '0101623006',
        //     'description' => 'IPK Tertinggi Fakultas Sains dan Teknologi Program Magister'
        // ]);

        // PassStatement::create([
        //     'nim' => '0106521009',
        //     'description' => 'IPK Tertinggi Fakultas Sains dan Teknologi Program Sarjana'
        // ]);

        // PassStatement::create([
        //     'nim' => '0302521018',
        //     'description' => 'IPK Tertinggi Fakultas Ekonomi dan Bisnis Program Sarjana'
        // ]);

        // PassStatement::create([
        //     'nim' => '0404520014',
        //     'description' => 'IPK Tertinggi Universitas'
        // ]);

        // PassStatement::create([
        //     'nim' => '0603521035',
        //     'description' => 'IPK Tertinggi Fakultas Psikologi dan Pendidikan Program Sarjana'
        // ]);

        // PassStatement::create([
        //     'nim' => '0801521040',
        //     'description' => 'IPK Tertinggi Fakultas Ilmu Sosial dan Ilmu Politik Program Sarjana'
        // ]);

        // PassStatement::create([
        //     'nim' => '0803623003',
        //     'description' => 'IPK Tertinggi Fakultas Ilmu Sosial dan Ilmu Politik Program Magister'
        // ]);


        // Best students
        // PassStatement::create([
        //     'nim' => '0801521031',
        //     'description' => 'Lulusan Terbaik Universitas'
        // ]);

        PassStatement::create([
            'nim' => '0101623006',
            'description' => 'Lulusan Terbaik Fakultas Sains dan Teknologi Program Magister'
        ]);
        PassStatement::create([
            'nim' => '0702623072',
            'description' => 'Lulusan Terbaik Fakultas Hukum Program Magister'
        ]);
        PassStatement::create([
            'nim' => '0702623072',
            'description' => 'IPK Tertinggi Universitas Program Magister'
        ]);
        PassStatement::create([
            'nim' => '0803623003',
            'description' => 'Lulusan Terbaik Fakultas Ilmu Sosial dan Ilmu Politik Program Magister',
        ]);
        PassStatement::create([
            'nim' => '0101521010',
            'description' => 'Lulusan Terbaik Fakultas Sains dan Teknologi Program Sarjana',
        ]);
        PassStatement::create([
            'nim' => '0101521010',
            'description' => 'Lulusan Terbaik Fakultas Sains dan Teknologi Program Sarjana'
        ]);
        PassStatement::create([
            'nim' => '0301521023',
            'description' => 'Lulusan Terbaik Fakultas Ekonomi dan Bisnis Program Sarjana'
        ]);
        PassStatement::create([
            'nim' => '0404520014',
            'description' => 'Lulusan Terbaik Fakultas Ilmu Pengetahuan Budaya Program Sarjana'
        ]);
        PassStatement::create([
            'nim' => '0404520014',
            'description' => 'IPK Tertinggi Universitas Program Sarjana'
        ]);
        PassStatement::create([
            'nim' => '0603521035',
            'description' => 'Lulusan Terbaik Fakultas Psikologi dan Pendidikan Program Sarjana'
        ]);
        PassStatement::create([
            'nim' => '0711521005',
            'description' => 'Lulusan Terbaik Fakultas Hukum Program Sarjana'
        ]);
        PassStatement::create([
            'nim' => '0801521031',
            'description' => 'Lulusan Terbaik Fakultas Ilmu Sosial dan Ilmu Politik Program Sarjana'
        ]);
        PassStatement::create([
            'nim' => '0801521031',
            'description' => 'Lulusan Terbaik Universitas'
        ]);
    }
}
