<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('faculties')->insert(
            array(
                'name' => 'fsktm',
                )
        );

        DB::table('departments')->insert(
            array(
                'name' => 'ai',
                'faculty_id' => 1,
                )
        );

        DB::table('academic_programmes')->insert(
            array(
                'name' => 'ai',
                'department_id' => 1,
                )
        );
    }
}
