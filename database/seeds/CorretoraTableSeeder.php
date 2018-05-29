<?php

use Illuminate\Database\Seeder;
use App\Corretora;


class CorretoraTableSeeder extends Seeder
{
  /**
  * @var \Faker\Generator
  */
  private $faker;

  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    Corretora::create([
      'name' => 'ABREPE ADMINISTRADORA E CORRETORA DE SEGUROS LTDA - ME',
      'cnpj'  => '09487625000102',
      'phone' => '6139635939',
      'email' => 'abrepeseguros@gmail.com',
      'address' => 'QUADRA 301 RUA A CONJUNTO 2 LOTE 01 SALA 304 ED. PAULO SÉRGIO - CEP 71901020 - ÁGUAS CLARAS - DF',
    ]);
    Corretora::create([
      'name' => 'ABSOLUT BRASILIA CORRETORA DE SEGUROS LTDA',
      'cnpj'  => '14926340000152',
      'phone' => '6130366569',
      'email' => 'absolutbrasilia@gmail.com	',
      'address' => 'RUA DAS PANEIRAS LOTE 06 BLOCO B SALA 509 - SHOPPING ONE',
    ]);
    Corretora::create([
      'name' => 'ADMINSEG - ADMINISTRADORA E CORRETORA DE SEGUROS LTDA - ME',
      'cnpj'  => '08656288000169',
      'phone' => '6133228044',
      'email' => 'adminseg@adminseg.com.br',
      'address' => 'SDS BLOCO Q , ED. VENANCIO IV , SALA 304',
    ]);
    Corretora::create([
      'name' => 'ADRA GABRIELA SEGUROS LTDA - ME',
      'cnpj'  => '24971037000125',
      'phone' => '6133385563',
      'email' => 'adra@adraseguros.com.br',
      'address' => 'SMPW QUADRA 3 CONJUNTO 4 LOTE 2 UNIDADE E',
    ]);
    Corretora::create([
      'name' => 'AGAPE LIFE CORRETORA DE SEGUROS EIRELI',
      'cnpj'  => '23848540000125',
      'phone' => '61998776654',
      'email' => 'corretora@gmail.com',
      'address' => 'Qn 312 Conjunto 9 Lote 9 e 10 Sala 567',
    ]);
    Corretora::create([
      'name' => 'AGENCIA BRASILIA ADMINISTRACAO E CORRETAGEM DE SEGUROS LTDA',
      'cnpj'  => '19877654000180',
      'phone' => '61998776654',
      'email' => 'corretora@gmail.com',
      'address' => 'Qn 312 Conjunto 9 Lote 9 e 10 Sala 567',
    ]);
    Corretora::create([
      'name' => 'AJUZ CORRETORA DE SEGUROS LTDA.',
      'cnpj'  => '19877654000180',
      'phone' => '61998776654',
      'email' => 'corretora@gmail.com',
      'address' => 'Qn 312 Conjunto 9 Lote 9 e 10 Sala 567',
    ]);
    Corretora::create([
      'name' => 'ALERTA CORRETORA DE SEGUROS LTDA',
      'cnpj'  => '19877654000180',
      'phone' => '61998776654',
      'email' => 'corretora@gmail.com',
      'address' => 'Qn 312 Conjunto 9 Lote 9 e 10 Sala 567',
    ]);
    Corretora::create([
      'name' => 'ALL CARS ADMINISTRADORA E CORRETORA DE SEGUROS LTDA',
      'cnpj'  => '19877654000180',
      'phone' => '61998776654',
      'email' => 'corretora@gmail.com',
      'address' => 'Qn 312 Conjunto 9 Lote 9 e 10 Sala 567',
    ]);
    // Exibe uma informação no console durante o processo de seed
    $this->command->info('User ths.pereira@gmail.com created');


  }
}
