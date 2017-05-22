<?php

namespace Tests\Unit;

use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
            'created_at'=> Carbon::now()->subMonth()
        ]);


        $posts = Post::archives()->toArray();


        $this->assertEquals(
            [
                [
                    "year" => $second->created_at->format('Y'),
                    "month" => $second->created_at->format('F'),
                    "published" => 1
                ],
                [
                    "year" => $first->created_at->format('Y'),
                    "month" => $first->created_at->format('F'),
                    "published" => 1
                ]
            ]
        , $posts);
    }
}
