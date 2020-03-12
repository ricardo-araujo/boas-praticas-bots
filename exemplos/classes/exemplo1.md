> Seguindo o que reza a cartilha do [S.O.L.I.D.](https://pt.wikipedia.org/wiki/SOLID), cabe a cada classe ser responsável por suas devidas capturas, sem uma classe que faz tudo de uma só vez:

- Ruim

```php
class LicitacaoPageObject extends AbstractPageObject
{
    public function get()
    {
        $resp = $this->request('metodo request', 'url do portal');
        
        return new LicitacaoParser($resp->getBody()->getContents());
    }

    public function getDetalhes()
    {
        $resp = $this->request('metodo request', 'url do portal p/ pegar detalhes');

        return new LicitacaoDetalhesParser($resp->getBody()->getContents());
    }
}
```

- Bom

```php
class LicitacaoPageObject extends AbstractPageObject
{
    public function get()
    {
        $resp = $this->request('metodo', 'url do portal');

        return new LicitacaoParser($resp->getBody()->getContents());
    }
}

// e

class LicitacaoDetalhesPageObject extends AbstractPageObject
{
    public function get()
    {
        $resp = $this->request('metodo request', 'url do portal p/ pegar detalhes');

        return new LicitacaoDetalhesParser($resp->getBody()->getContents());
    }
}
```
