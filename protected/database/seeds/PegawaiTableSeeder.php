<?php

use Illuminate\Database\Seeder;
use App\Pegawai as Pegawai;

class PegawaiTableSeeder extends Seeder {

	public function run() {
        // clear table
        Pegawai::truncate(); 
        // penambahan data 1
        Pegawai::create( [
            'nama'  => 'Firman Sidik Ginanjar' ,
            'email' => 'firman@salatigadev.com' ,
            'level' => '1' ,
        ] );
        // penambahan data 2
        Pegawai::create( [
            'nama'  => 'Firman' ,
            'email' => 'firmansg@gmail.com' ,
            'level' => '2' ,
        ] );
        // penambahan data 3
        Pegawai::create( [
            'nama'  => 'Firman SG' ,
            'email' => 'firman2008@ymail.com' ,
            'level' => '3' ,
        ] );
    }
}