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

      $users = factory(App\Models\User::class, 1)
                      ->create()
                      ->each(function($user) {
                          $user->save();
                      });

      $profiles = factory(App\Models\Profile::class, 1)
                      ->create()
                      ->each(function($profile) {
                          $profile->save();
                      });

      $assets = factory(App\Models\Asset::class, 5)
                      ->create()
                      ->each(function($asset) {
                          $asset->save();
                      });

      $categories = factory(App\Models\Category::class, 25)
                      ->create()
                      ->each(function($category) {
                          $category->save();
                      });

      $expenses = factory(App\Models\Expense::class, 5000)
                      ->create()
                      ->each(function($expense) {
                          $expense->save();
                      });

      $income = factory(App\Models\Income::class, 5000)
                      ->create()
                      ->each(function($income) {
                          $income->save();
                      });
    }
}
