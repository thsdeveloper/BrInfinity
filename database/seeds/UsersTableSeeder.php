<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
  /**
  * Auto generated seed file.
  *
  * @return void
  */
  public function run()
  {
    // Apaga toda a tabela de usuários
    // DB::table('users')->truncate();
    // Cria usuários admins (dados controlados)
    $this->createAdmins();
    // Cria usuários demo (dados faker)
    $this->createUsers();
  }
  private function createAdmins()
  {
    User::create([
      'email' => 'ths.pereira@gmail.com',
      'name'  => 'Thiago Soares',
      'password' => bcrypt('qsesbs2006')
    ]);

    // Exibe uma informação no console durante o processo de seed
    $this->command->info('User ths.pereira@gmail.com created');
    User::create([
      'email' => 'pedrocezar@brinfinite.com.br',
      'name'  => 'Pedro BrInfinity',
      'password' => bcrypt('123456')
    ]);
    $this->command->info('User pedrocezar@brinfinite.com.br created');
  }

  private function createUsers()
  {
    $max = rand(10, 30);
    for($i=0; $i < $max; $i++):
      $this->createUser($i);
    endfor;
    $this->command->info($max . ' demo users created');
  }
  private function createUser($index)
  {
    return User::create([
      'email' => 'email' . $index . '@mail.com',
      'name'  =>'User '. $index,
      'password' => bcrypt('123456')
    ]);
  }
}
