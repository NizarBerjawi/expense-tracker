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
      $this->call(TagsTableSeeder::class);

      factory(App\Models\User::class, 1)->create()->each(function($expense) {
          $expense->save();
      });

      factory(App\Models\Category::class, 15)->create()->each(function($expense) {
          $expense->save();
      });

      factory(App\Models\Expense::class, 500)->create()->each(function($expense) {
          $expense->save();
      });

      factory(App\Models\Income::class, 500)->create()->each(function($income) {
          $income->save();
      });
    }
}
