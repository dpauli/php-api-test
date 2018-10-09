<?php
declare(strict_types=1);

namespace ApiTest;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use phpDocumentor\Reflection\DocBlock;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * @author  david.pauli
 * @package ApiTest
 * @since   07.10.2018
 */
abstract class ApiTestCase extends TestCase
{
    protected const DOCUMENTATION_DIR = __DIR__;

    /** @var Client */
    private $client;

    /** @var MDWriter */
    private $mdWriter;

    /** @var PromiseInterface */
    private $response;

    /** @var string */
    private $uri;

    /** @var string[] */
    private $collectedHeaders;

    /** @var array */
    private $collectedParameters;

    protected function addHeaders(array $headers): void
    {
        $this->collectedHeaders[] = $headers;
    }

    protected function addParameters(array $parameters): void
    {
        $this->collectedParameters[] = $parameters;
    }

    protected function get(string $uri)
    {
        $this->response = $this->client->get($uri);
        $this->writeToMd();
        return $this->response;
    }

    protected function put(string $uri)
    {
        $this->response = $this->client->put($uri);
        $this->writeToMd();
        return $this->response;
    }
    protected function post(string $uri)
    {
        $this->response = $this->client->post($uri);
        $this->writeToMd();
        return $this->response;
    }

    protected function delete(string $uri)
    {
        $this->response = $this->client->delete($uri);
        $this->writeToMd();
        return $this->response;
    }

    private function writeToMd(): void
    {
        $docBlock = new DocBlock(
            (string) (new ReflectionMethod(static::class, debug_backtrace()[3]['function']))->getDocComment()
        );
        $this->mdWriter
            ->addHead($docBlock)
            ->addRequestUrl($this->uri)
            ->addRequestParams($this->collectedParameters)
            ->addRequestHeaders($this->collectedHeaders)
            ->addResponse($this->response);
    }
}
