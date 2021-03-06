<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function SetUp()
    {
        parent::SetUp();

        $this->thread = create('App\Thread');
    }

    /** @test  */
    public function a_user_can_browse_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test  */
    public function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test  */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())->assertSee($reply->body);
    }
}
