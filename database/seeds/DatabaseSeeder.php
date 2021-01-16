<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_reasons')->insert([
            'reason' => "Tidak bermain sesuai dengan role",
        ]);

        DB::table('report_reasons')->insert([
            'reason' => "Bersikap toxic atau tidak sopan",
        ]);

        DB::table('report_reasons')->insert([
            'reason' => "Melakukan tindakan terlarang seperti cheating",
        ]);
    }
}
