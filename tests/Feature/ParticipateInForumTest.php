<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForum extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $reply = create('App\Reply');
        $thread = create('App\Thread');
        $this->post($thread->path() .'/replies', $reply->toArray());

    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {

        $user = create('App\User');
        $this->be($user);

        $thread = create('App\Thread');

        $reply = create('App\Reply');

        $this->post($thread->path() .'/replies', $reply->toArray());

        $this->get($thread->path())
             ->assertSee($reply->body);
    }
}
