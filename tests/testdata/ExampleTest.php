<?php
/** @noinspection PhpMissingDocCommentInspection */
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

namespace Tests;

use ApiTest\ApiTestCase;

class ExampleTest extends ApiTestCase
{
    protected const DOCUMENTATION_DIR = __DIR__ . '../output';

    /**
     * Getting a resource is the coolest way to make something.
     *
     * This is the nice description of the test get.
     */
    public function testGet(): void
    {
        $this->addHeaders(['Authorization' => 'Basic FooBar']);
        $this->addParameters(['requestType' => 'search']);
        $response = $this->get();
        static::assertEquals(200, $response->getStatusCode());
    }
}
