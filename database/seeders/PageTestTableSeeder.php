<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageTest;

class PageTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 50; $i++){
            $data = new PageTest();
            $data->text = "サンプル" . $i;
            $data->save();
        }
    }
}
