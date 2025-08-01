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
        $nims = [
            '0401623009',
            '0401623010',
            '0702619038',
            '0702622047',
            '0702622054',
            '0702622056',
            '0702622059',
            '0702622060',
            '0702622064',
            '0702622070',
            '0702622075',
            '0702623002',
            '0702623003',
            '0702623004',
            '0702623006',
            '0702623008',
            '0702623009',
            '0702623010',
            '0702623012',
            '0702623013',
            '0702623014',
            '0702623016',
            '0702623017',
            '0702623019',
            '0702623020',
            '0702623021',
            '0702623026',
            '0702623027',
            '0702623028',
            '0702623029',
            '0702623030',
            '0702623031',
            '0702623033',
            '0702623034',
            '0702623035',
            '0702623036',
            '0702623038',
            '0702623040',
            '0702623042',
            '0702623043',
            '0702623044',
            '0702623046',
            '0101520012',
            '0101520028',
            '0102520026',
            '0102520041',
            '0104520021',
            '0104520022',
            '0105520006',
            '0301520033',
            '0311520017',
            '0311520046',
            '0311520075',
            '0311520089',
            '0311520096',
            '0311520113',
            '0311520165',
            '0312520017',
            '0312520076',
            '0402520008',
            '0402520011',
            '0402520016',
            '0402520018',
            '0402520019',
            '0403520024',
            '0601520002',
            '0601520029',
            '0602520007',
            '0603520002',
            '0603520022',
            '0603520024',
            '0603520045',
            '0701520050',
            '0701520055',
            '0802520013',
            '0802520088',
            '0802520090',
            '0802520123',
            '0802520130',
            '0802520182',
            '0802520189',
            '0802521127'
        ];

        foreach ($nims as $nim) {
            PassStatement::create([
                'nim' => $nim,
                'description' => 'Cumlaude'
            ]);
        }

        // Jobs

        PassStatement::create([
            'nim' => '0702623006',
            'description' => 'Pekerjaan Pertama'
        ]);

        // High scores
        PassStatement::create([
            'nim' => '0102520038',
            'description' => 'IPK Tertinggi Fakultas Sains dan Teknologi'
        ]);
        PassStatement::create([
            'nim' => '0311520096',
            'description' => 'IPK Tertinggi Fakultas Ekonomi dan Bisnis'
        ]);
        PassStatement::create([
            'nim' => '0402520018',
            'description' => 'IPK Tertinggi Fakultas Ilmu Pengetahuan Budaya'
        ]);
        PassStatement::create([
            'nim' => '0603520022',
            'description' => 'IPK Tertinggi Fakultas Psikologi dan Pendidikan'
        ]);
        PassStatement::create([
            'nim' => '0711518187',
            'description' => 'IPK Tertinggi Fakultas Hukum'
        ]);
        PassStatement::create([
            'nim' => '0802521127',
            'description' => 'IPK Tertinggi Fakultas Ilmu Sosial dan Ilmu Politik'
        ]);
        PassStatement::create([
            'nim' => '0702623006',
            'description' => 'IPK Tertinggi Magister Ilmu Hukum'
        ]);
        PassStatement::create([
            'nim' => '0803622027',
            'description' => 'IPK Tertinggi Magister Ilmu Komunikasi'
        ]);
        PassStatement::create([
            'nim' => '0401623002',
            'description' => 'IPK Tertinggi Magister Linguistik'
        ]);

        // Best students
        PassStatement::create([
            'nim' => '0402520018',
            'description' => 'Lulusan Terbaik Fakultas Ilmu Pengetahuan Budaya'
        ]);
        PassStatement::create([
            'nim' => '0603520002',
            'description' => 'Lulusan Terbaik Fakultas Psikologi dan Pendidikan'
        ]);
        PassStatement::create([
            'nim' => '0701520050',
            'description' => 'Lulusan Terbaik Fakultas Hukum'
        ]);
        PassStatement::create([
            'nim' => '0311520165',
            'description' => 'Lulusan Terbaik Fakultas Ekonomi dan Bisnis'
        ]);
        PassStatement::create([
            'nim' => '0802521127',
            'description' => 'Lulusan Terbaik Fakultas Ilmu Sosial dan Ilmu Politik'
        ]);
        PassStatement::create([
            'nim' => '0101520012',
            'description' => 'Lulusan Terbaik Fakultas Sains dan Teknologi'
        ]);
        PassStatement::create([
            'nim' => '0702623031',
            'description' => 'Lulusan Terbaik Magister Ilmu Hukum'
        ]);
        // PassStatement::create([
        //     'nim' => '0702623031',
        //     'description' => 'Lulusan Terbaik Magister Ilmu Komunikasi'
        // ]);
        PassStatement::create([
            'nim' => '0401623002',
            'description' => 'Lulusan Terbaik Magister Linguistik'
        ]);

        // Best students
        PassStatement::create([
            'nim' => '0802521127',
            'description' => 'Lulusan Terbaik Universitas'
        ]);

        PassStatement::create([
            'nim' => '0702623006',
            'description' => 'IPK Tertinggi Universitas'
        ]);
        PassStatement::create([
            'nim' => '0402520018',
            'description' => 'IPK Tertinggi Universitas'
        ]);

        

        
    }
}
