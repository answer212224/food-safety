<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::find(1)->tasks()->create([
            'restaurant_id' => 1,
            'category' => '食安及5S巡檢',
            'task_date' => today(),
            'is_completed' => false,
            'inner_manager' => '',
            'outer_manager' => '',
        ]);

        User::find(2)->tasks()->create([
            'restaurant_id' => 1,
            'category' => '清潔檢查',
            'task_date' => today()->addDays(3),
            'is_completed' => false,
            'inner_manager' => '',
            'outer_manager' => '',
        ]);

        User::find(3)->tasks()->create([
            'restaurant_id' => 3,
            'category' => '餐點採樣',
            'task_date' => today()->addDays(2),
            'is_completed' => false,
            'inner_manager' => '',
            'outer_manager' => '',
        ]);
    }
}
