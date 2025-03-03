<?php

namespace Database\Seeders;

use App\Models\SettingPdf;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingPdfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingPdf::create([
            'name' => 'Raisa Climatizaciones',
            'logo' => 'assets/img/logo-raisa.png',
            'phone' => '',
            'email' => '',
            'address' => '',
            'color_pdf' => '#056b73',
            'colorline_pdf' => '#FFFFFF',
            'message_email' => '',
        ]);

        SettingPdf::create([
            'name' => 'Ciro Climatizaciones',
            'logo' => 'assets/img/logo-ciro.png',
            'phone' => '',
            'email' => '',
            'address' => '',
            'color_pdf' => '#000000',
            'colorline_pdf' => '#FFFFFF',
            'message_email' => '',
        ]);
    }
}
