Caso a captura de informações sejam feitas através de regexes, o que é comum em alguns portais, padrões explicativos podem ser utilizados:

- Ruim

```php
class ConsultaLicitacaoParser
{
    public function qtdLicitacoes()
    {
        $text = $this->elementText('//td[@class="td_titulo_campo"][contains(., "Licitações")]/center');

        preg_match('#(\d+)\)#U', $text, $match);

        return  (int) $match[1] ?? 0;
    }
```

- Bom

```php
class ConsultaLicitacaoParser
{
    public function qtdLicitacoes()
    {
        $text = $this->elementText('//td[@class="td_titulo_campo"][contains(., "Licitações")]/center');

        preg_match('#(?<qtd_licitacao>\d+)\)#U', $text, $match);

        return  (int) $match['qtd_licitacao'] ?? 0;
    }
```

<p align="center">
    <a href="exemplo3.md"> < Anterior </a> | <a href="exemplo5.md"> Próximo > </a> 
</p>
