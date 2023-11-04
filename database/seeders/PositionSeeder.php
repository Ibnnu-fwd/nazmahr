<?php

namespace Database\Seeders;

use App\Models\Positition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Positition::insert([
            [
                'name'       => 'Admin',
                'status'     => '1',
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name'       => 'Manager',
                'status'     => '1',
                'created_by' => '1',
                'updated_by' => '1'
            ],
            [
                'name'       => 'Karyawan',
                'status'     => '1',
                'created_by' => '1',
                'updated_by' => '1'
            ],
        ]);
    }
}
