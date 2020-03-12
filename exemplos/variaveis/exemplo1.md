> Apesar de uma dica básica, é comum ver perdido pelo código variáveis indecifráveis. Nomes de variáveis devem ser claros e objetivos, evitando que seu código seja mal interpretado:

- Ruim

```php
$dt = $licitacao['dt_pub_lic'];
```

- Bom

```php
$dtPublicacaoLicitacao = $licitacao['dt_publicacao'];

//ou

$dataPublicacao = $licitacao['dt_publicacao'];
```

<p align="center">
    <a href="exemplo2.md"> Próximo </a>
</p>
