<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call(UserTableSeeder::class);
       $this->call(TrackerTableSeeder::class);
    }
}

class UserTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->insert([
        'name' => 'postika',
        'email' => 'den.postika@gmail.com',
        'password' => bcrypt('111111'),
        'youtrack_url' => 'https://atilog.myjetbrains.com/youtrack',
        'youtrack_email' => 'den.postika',
        'youtrack_password' => 'Den3103pos',
        'all_time' => 1250
    ]);
  }

}

class TrackerTableSeeder extends Seeder {

  public function run()
  {
    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-30',
      'what_action' => 'Пишу курсовой',
      'time'  => 200
    ]);
    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-30',
      'what_action' => 'Написание кода для курсовой',
      'time'  => 150
    ]);
    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-30',
      'what_action' => 'Проектирование',
      'time'  => 100
    ]);

    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-29',
      'what_action' => 'Написание плана курсовой',
      'time'  => 150
    ]);
    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-29',
      'what_action' => 'Проектирование',
      'time'  => 100
    ]);

    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-28',
      'what_action' => 'Написание кода',
      'time'  => 150
    ]);
    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-28',
      'what_action' => 'Правка багов',
      'time'  => 200
    ]);

    DB::table('tracker')->insert([
      'user_id' => 1,
      'date' => '2016-11-27',
      'what_action' => 'Прорисовка прототипов UX',
      'time'  => 200
    ]);

  }

}
