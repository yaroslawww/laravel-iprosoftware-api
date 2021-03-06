<?php

namespace Angecode\LaravelIproSoft\Tests\Response;

use Angecode\LaravelIproSoft\Entities\ContactInfo;
use Angecode\LaravelIproSoft\Entities\IproEntity;
use Angecode\LaravelIproSoft\Responses\ResponseEntity;
use Angecode\LaravelIproSoft\Tests\IproSoftwareTestCase;

class ResponseEntityTest extends IproSoftwareTestCase
{
    protected function mockData(): array
    {
        return [
            'Id' => 1,
        ];
    }

    /**
     * @test
     */
    public function parsing_in_initialisation(): void
    {
        $response = ResponseEntity::mock(
            ContactInfo::class,
            $this->mockData(),
            [
                'size' => 2,
            ]
        );

        $this->assertInstanceOf(IproEntity::class, $response->entity);
        $this->assertInstanceOf(ContactInfo::class, $response->entity);
    }
}
