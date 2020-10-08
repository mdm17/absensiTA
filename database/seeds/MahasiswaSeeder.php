<?php

use App\Kelas;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('dosen')->insert([
                'nip' => $faker->isbn13,
                'nama' => $faker->name,
                'email' => $faker->email
            ]);
        }
    }
}
