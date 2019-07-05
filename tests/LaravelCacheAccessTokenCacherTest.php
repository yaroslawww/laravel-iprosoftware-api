<?php

namespace Angecode\LaravelIproSoft\Tests;

use Mockery;
use Illuminate\Contracts\Cache\Repository as Cache;
use Angecode\LaravelIproSoft\AccessToken\LaravelCacheAccessTokenCacher;

class LaravelCacheAccessTokenCacherTest extends IproSoftwareTestCase
{
    public function test_flow()
    {
        $cache = Mockery::mock(Cache::class);
        $accessToken = new \Angecode\IproSoftware\AccessToken\AccessToken(uniqid(), uniqid(), uniqid());

        $cacheManager = new LaravelCacheAccessTokenCacher($cache, 'some_key');

        $cache->shouldReceive('put')
            ->with('some_key', serialize($accessToken), 10)
            ->once()
            ->andReturn(true);

        $this->assertTrue($cacheManager->put($accessToken, 10));

        $cache->shouldReceive('get')
            ->once()
            ->andReturn(serialize($accessToken));

        $this->assertEquals($accessToken, $cacheManager->get());
    }
}
