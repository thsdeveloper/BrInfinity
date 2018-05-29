<?php

use Illuminate\Database\Seeder;
use App\Seguradora;

class SeguradoraTableSeeder extends Seeder
{
  /**
  * Auto generated seed file.
  *
  * @return void
  */
  public function run()
  {
    // Cria usuários admins (dados controlados)
    $this->createSeguradoras();
  }
  private function createSeguradoras()
  {
    Seguradora::create([
      'name' => 'American Life',
    ]);
    Seguradora::create([
      'name' => 'Tokio Marine',
    ]);
    Seguradora::create([
      'name' => 'Generali',
    ]);
    Seguradora::create([
      'name' => 'Suhai',
    ]);
    Seguradora::create([
      'name' => 'AIG',
    ]);
    Seguradora::create([
      'name' => 'Travelers',
    ]);
    Seguradora::create([
      'name' => 'Sompo Seguros',
    ]);
    Seguradora::create([
      'name' => 'Allianz',
    ]);
  }

}
