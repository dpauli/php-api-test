<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author  david.pauli
 * @package Tests
 * @since   07.10.2018
 */
class ApiTestCaseTest extends TestCase
{
    /** @var ExampleTest */
    private $apiTest;

    public function setUp()
    {
        $this->apiTest = new ExampleTest();
    }

    public function testGet(): void
    {
        $this->apiTest->testGet();
    }

    public function tearDown(): void
    {
        // delete written content
    }
}
