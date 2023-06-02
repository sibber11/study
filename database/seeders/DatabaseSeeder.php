<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $courses = [
        [
            'name' => 'Peripheral and Interfacing',
            'code' => 'PI',
            'chapters' => [
                ['name'=>'Interfacing techniques'],
                ['name'=>'Digital Interfacing'],
                ['name'=>'Modern data-entry devices'],
                ['name'=>'Display devices'],
                ['name'=>'Printers'],
                ['name'=>'Storage devices'],
                ['name'=>'Data Communication and Network'],
                ['name'=>'Digitizer'],
            ]
        ],
        [
            'name' => 'Data and Telecommunications',
            'code' => 'DT',
            'chapters' => []
        ],
        [
            'name' => 'Operating System',
            'code' => 'OS',
            'chapters' => []
        ],
        [
            'name' => 'Economics',
            'code' => 'ECO',
            'chapters' => []
        ],
    ];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $semester = Semester::create([
            'name' => '5th'
        ]);

        foreach ($this->courses as $course) {
            $courseModel = Course::create([
                'name' => $course['name'],
                'code' => $course['code'],
                'semester_id' => $semester->id
            ]);
            
            foreach ($course['chapters'] as $chapter) {
                $chapterModel = Chapter::create([
                    'name' => $chapter['name'],
                    'course_id' => $courseModel->id
                ]);
            }
        }
    }
}
