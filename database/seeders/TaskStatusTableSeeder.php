<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\TaskStatus;

class TaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'status' => 'Yapılacak'
            ],
            [
                'status' => 'Yapılıyor'
            ],
            [
                'status' => 'Yapıldı'
            ]
        ];

        foreach ($status as $item) {
            if (!TaskStatus::where('status', $item['status'])->exists()) {
                $newTaskStatus = new TaskStatus();
                $newTaskStatus->status = $item['status'];
                $newTaskStatus->save();
            
            }
        }
    }
}
