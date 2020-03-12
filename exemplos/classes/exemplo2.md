> Dependa de abstrações para que seus page-objects funcionem e não crie alto acoplamento:

- Ruim

```php
class PageObject
{
    private $client;

    public function __construct() { 
        $this->client = MinhaCriacaoDoGuzzle::getInstance();
    }
}
```
 
- Bom

```php
class PageObject
{
    private $client;
    
    public function __construct(\GuzzleHttp\ClientInterface $client) { 
        $this->client = $client;
    }
}
```

<p align="center">
    <a href="exemplo1.md"> Anterior </a>
</p>
