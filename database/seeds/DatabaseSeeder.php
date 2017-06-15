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

      factory(App\Models\User::class, 5)->create()->each(function($user) {
          $user->save();
      });

      factory(App\Models\LiquidAsset::class, 20)->create()->each(function($liquidAsset) {
          $liquidAsset->save();
      });

      factory(App\Models\Category::class, 100)->create()->each(function($category) {
          $category->save();
      });

      factory(App\Models\Expense::class, 50000)->create()->each(function($expense) {
          $expense->save();
      });

      factory(App\Models\Income::class, 50000)->create()->each(function($income) {
          $income->save();
      });
    }
}
