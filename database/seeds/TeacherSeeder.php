<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'fname' => Str::random(10),
            'teacher_subject' => 'Quran',
            'email' => Str::random(10).'@gmail.com',
            'token' => Hash::make('token'),
        ]);
    }
}
