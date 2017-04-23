<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $incomeTag = Tag::create([
        'name' => 'Income',
      ]);

      $expenseTag = Tag::create([
        'name' => 'Expense',
      ]);
    }
}
