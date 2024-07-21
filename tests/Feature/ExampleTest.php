<?php

use FeedIo\FeedInterface;
use FeedIo\FeedIo;
use FeedIo\Reader\Result;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;

it('returns a successful response', function () {
    $feedItem = Mockery::mock(FeedInterface::class);
    $feedItem->shouldReceive('getLink')->andReturn('https://hello-world.test');
    $feedItem->shouldReceive('getTitle')->andReturn('Hello World');

    $feedItems = [$feedItem];

    $feed = Mockery::mock(FeedInterface::class);
    $feed->shouldReceive('rewind')->andReturn(null);
    $feed->shouldReceive('current')->andReturnUsing(function () use (&$feedItems) {
        return current($feedItems);
    });

    $feed->shouldReceive('key')->andReturnUsing(function () use (&$feedItems) {
        return key($feedItems);
    });

    $feed->shouldReceive('next')->andReturnUsing(function () use (&$feedItems) {
        return next($feedItems);
    });

    $feed->shouldReceive('valid')->andReturnUsing(function () use (&$feedItems) {
        return current($feedItems) !== false;
    });

    $result = Mockery::mock(Result::class);
    $result->shouldReceive('getFeed')->andReturn($feed);

    $this->mock(FeedIo::class, function (MockInterface $mock) use ($result) {
        $mock->shouldReceive('read')
            ->with('https://laravel-france.com/rss')
            ->andReturn($result);
    });

    $response = $this->get('/');
    $response->assertStatus(200)
        ->assertJson([
            [
                'url' => 'https://hello-world.test',
                'title' => 'Hello World',
            ]
            ]);
});
