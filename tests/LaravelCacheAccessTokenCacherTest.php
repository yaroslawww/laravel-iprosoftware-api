<?php

namespace Angecode\LaravelIproSoft\Tests;

use Angecode\LaravelIproSoft\AccessToken\LaravelCacheAccessTokenCacher;
use Illuminate\Contracts\Cache\Repository as Cache;
use Mockery;

class LaravelCacheAccessTokenCacherTest extends IproSoftwareTestCase
{
    /**
     * @test
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function flow()
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
