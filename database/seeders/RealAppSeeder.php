<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RealAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // months of the year arabic and english names (it should be )
         Month::upsert([
            ['name' => 'January', 'name_ar' => 'يناير'],
            ['name' => 'February', 'name_ar' => 'فبراير'],
            ['name' => 'March', 'name_ar' => 'مارس'],
            ['name' => 'April', 'name_ar' => 'أبريل'],
            ['name' => 'May', 'name_ar' => 'مايو'],
            ['name' => 'June', 'name_ar' => 'يونيو'],
            ['name' => 'July', 'name_ar' => 'يوليو'],
            ['name' => 'August', 'name_ar' => 'أغسطس'],
            ['name' => 'September', 'name_ar' => 'سبتمبر'],
            ['name' => 'October', 'name_ar' => 'أكتوبر'],
            ['name' => 'November', 'name_ar' => 'نوفمبر'],
            ['name' => 'December', 'name_ar' => 'ديسمبر'],
         ], ['name'], ['name_ar']);
    }
}
