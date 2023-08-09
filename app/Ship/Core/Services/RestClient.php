<?php

declare(strict_types=1);

namespace App\Ship\Core\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\FulfilledPromise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class RestClient extends Client
{
    /**
     * @var RequestInterface|null
     */
    protected ?RequestInterface $lastRequest;

    /**
     * @var ResponseInterface|null
     */
    protected ?ResponseInterface $lastResponse;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->getHandler()->push(fn(callable $handler) => function (RequestInterface $request, array $options) use ($handler) {

            $this->setLastRequest($request);
            $this->setLastResponse(null);

            /** @var FulfilledPromise $promise */
            $promise = $handler($request, $options);

            return $promise->then(fn(ResponseInterface $response) => $this->lastResponse = $response);
        });
    }

    /**
     * @return mixed
     */
    protected function getHandler(): mixed
    {
        return $this->getConfig('handler');
    }

    /**
     * @return RequestInterface|null
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * @param RequestInterface|null $lastRequest
     */
    public function setLastRequest(?RequestInterface $lastRequest): void
    {
        $this->lastRequest = $lastRequest;
    }

    /**
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * @param ResponseInterface|null $lastResponse
     */
    public function setLastResponse(?ResponseInterface $lastResponse): void
    {
        $this->lastResponse = $lastResponse;
    }
}
