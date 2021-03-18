<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        DB::table('users')->insert([
            'name' => "Calvin Then",
            'email' => "calvinthen68@yahoo.co.id",
            'role' => "admin",
            'game_prefer' => "dota",
            'role_game' => "midlaner",
            'ingame_id' => "calvinthen2",
            'photo_profile' => "calvin.jpg",
            'email_verified_at' => "2021-01-02 18:08:22.000000",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Elang Bima Sorongan S",
            'email' => "elangsorongan@yahoo.com",
            'role' => "admin",
            'game_prefer' => "dota",
            'role_game' => "offlaner",
            'ingame_id' => "elangbima32",
            'photo_profile' => "elang.jpg",
            'email_verified_at' => "2021-01-04 20:11:32.000001",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Eldwin Dylan kusnadi",
            'email' => "eldwindylank@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "support",
            'ingame_id' => "hayden88",
            'photo_profile' => "eldwin.jpg",
            'email_verified_at' => "2021-02-01 16:39:19.000032",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Trinandi harun",
            'email' => "tri.haru30@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "support",
            'ingame_id' => "tkj2020",
            'photo_profile' => "user.jpg",
            'email_verified_at' => "2021-01-20 11:09:11.000102",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "kokoronipa",
            'email' => "gabrielak14@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "carry",
            'ingame_id' => "kakakgaby",
            'photo_profile' => "gebi.jpg",
            'email_verified_at' => "2021-01-21 17:11:07.000039",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "kenny ray rulan",
            'email' => "kennysray389@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "carry",
            'ingame_id' => "ghostken96",
            'photo_profile' => "kenny.jpg",
            'email_verified_at' => "2021-01-21 15:33:17.000011",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Abdul Fikar Azaril",
            'email' => "abdullahmoh22@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "carry",
            'ingame_id' => "abdoeldoto40",
            'photo_profile' => "abdul.jpg",
            'email_verified_at' => "2021-01-05 20:19:22.000290",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Arvin Sulimto",
            'email' => "arvinsulimto@gmail.com",
            'role' => "user",
            'game_prefer' => "csgo",
            'role_game' => "lurker",
            'ingame_id' => "redesvouz",
            'photo_profile' => "arvin.jpg",
            'email_verified_at' => "2021-01-13 19:20:19.000089",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Firecracker",
            'email' => "patrickadiraja@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "offlaner",
            'ingame_id' => "patrikadiraja123",
            'photo_profile' => "patrick.jpg",
            'email_verified_at' => "2021-01-22 15:31:20.001029",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "MysteZ",
            'email' => "solmistez@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "support",
            'ingame_id' => "mystez123",
            'photo_profile' => "michael.jpg",
            'email_verified_at' => "2021-01-22 15:40:22.008290",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Santucz",
            'email' => "albertus.anggani@gmail.com",
            'role' => "user",
            'game_prefer' => "csgo",
            'role_game' => "entry fragger",
            'ingame_id' => "santuczalb",
            'photo_profile' => "user.jpg",
            'email_verified_at' => "2021-01-08 14:52:23.001277",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "elangers",
            'email' => "elangbima39@gmail.com",
            'role' => "user",
            'game_prefer' => "csgo",
            'role_game' => "leader",
            'ingame_id' => "elangers23",
            'photo_profile' => "user.jpg",
            'email_verified_at' => "2021-01-07 22:49:23.008149",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "devon suktikno",
            'email' => "devinsoetikno22@gmail.com",
            'role' => "user",
            'game_prefer' => "csgo",
            'role_game' => "leader",
            'ingame_id' => "devonwin90",
            'photo_profile' => "user.jpg",
            'email_verified_at' => "2021-01-07 19:26:23.000023",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "GodHand",
            'email' => "putrasanggut6@gmail.com",
            'role' => "user",
            'game_prefer' => "csgo",
            'role_game' => "lurker",
            'ingame_id' => "putrasanggut6",
            'photo_profile' => "user.jpg",
            'email_verified_at' => "2021-01-22 16:16:22.006209",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Sepedarusak",
            'email' => "kevinaxellinot@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "carry",
            'ingame_id' => "kevint89",
            'photo_profile' => "user.jpg",
            'email_verified_at' => "2021-01-16 14:33:29.029381",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "King",
            'email' => "richardlaurent@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "midlaner",
            'ingame_id' => "richardlrn3",
            'photo_profile' => "richard.jpg",
            'email_verified_at' => "2021-01-11 16:47:30.027881",
            'password' => Hash::make("asdasdasd"),
        ]);

        DB::table('users')->insert([
            'name' => "Pilbert",
            'email' => "pilbertlk@gmail.com",
            'role' => "user",
            'game_prefer' => "dota",
            'role_game' => "midlaner",
            'ingame_id' => "pilbertlkmn",
            'photo_profile' => "user.jpg",
            'email_verified_at' => "2021-01-22 17:43:12.289190",
            'password' => Hash::make("asdasdasd"),
        ]);

    }
}
