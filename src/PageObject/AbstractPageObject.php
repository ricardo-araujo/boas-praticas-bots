<?php

namespace BoasPraticas\Bots\PageObject;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Classe abstrata comum às PageObjects filhas, podendo agrupar funcoes comuns também, à todas elas, como o __construct por exemplo
*/
abstract class AbstractPageObject
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function request(string $method, string $uri, array $config = []) : ResponseInterface
    {
        return $this->client->request($method, $uri, $config);
    }
}
