<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [];
        for ($i = 0; $i < 10; $i++) {
            $tasks[] = [
                'user_id' => rand(1, 2),
                'name' => 'task-' . rand(1, 10),
                'detail' => 'Detail- ' . Str::random(10),
                'deadline' => Carbon::now()->addDays(rand(1, 30))->toDateString(),
                'check' => rand(0, 1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('tasks')->insert($tasks);
    }
}
