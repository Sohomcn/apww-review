<?php
use App\Models\Review\Review;
use Illuminate\Database\Seeder;

class ReviewSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Review\Review::class,20)->create();
    }
}
