<?php

namespace Tests\Feature\Review;

use App\Models\Review\Review;
use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminReviewTest extends TestCase
{
    use RefreshDatabase;

    private function listReviews($user, $data = [])
    {
        $url = route('admin.review.index');

        return $this->actingAs($user)->get($url);
    }

    /**
     * @test
     */
    public function list_all_review_for_admin()
    {
        //Arrange
        factory(Review::class)->times(15)->create();
        $this->assertEquals(15, Review::count());

        //Act
        $user = factory(User::class)->create([
            'usertype' => 1,
        ]);
        $response = $this->listReviews($user);

        //Assert
        $response->assertOk();
        $response->assertViewIs('review.admin.index');
        $response->assertViewHas('reviews');
        $response->assertSee(__('All Reviews'));
        $this->assertEquals(15, $response->getOriginalContent()->reviews->count());
    }


    /**
     * @test
     */
    public function list_approve_and_unapprove_review_for_admin()
    {
        //Arrange
        factory(Review::class)->times(15)->create([
            'is_approve' => 0
        ]);
        $this->assertEquals(15, Review::where('is_approve',0)->count());

        factory(Review::class)->times(10)->create([
            'is_approve' => 1
        ]);
        $this->assertEquals(10, Review::where('is_approve',1)->count());

        $this->assertEquals(25, Review::count());

        //Act
        $user = factory(User::class)->create([
            'usertype' => 1,
        ]);
        $response = $this->listReviews($user);

        //Assert
        $response->assertOk();
        $response->assertViewIs('review.admin.index');
        $response->assertViewHas('reviews');
        $response->assertSee(__('All Reviews'));
        $this->assertEquals(25, $response->getOriginalContent()->reviews->count());
    }
}
