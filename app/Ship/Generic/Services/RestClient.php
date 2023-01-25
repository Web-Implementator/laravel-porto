<?php

declare(strict_types=1);

namespace App\Ship\Generic\Services;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class RestClient extends Client
{
    protected ?RequestInterface $lastRequest;
    protected ?ResponseInterface $lastResponse;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->getHandler()->push(fn(callable $handler) => function (RequestInterface $request, array $options) use ($handler) {
            $this->lastRequest = $request;
            $this->lastResponse = null;

            /** @var \GuzzleHttp\Promise\FulfilledPromise $promise */
            $promise = $handler($request, $options);

            return $promise->then(fn(ResponseInterface $response) => $this->lastResponse = $response);
        });
    }

    /**
     * @return HandlerStack
     */
    protected function getHandler(): HandlerStack
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
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }
}
