> Caso o contexto de acesso às informações seja o mesmo, como por exemplo, um get em licitações futuras ou realizadas, use o mesmo vocabulário para esse mesmo tipo. Abaixo, os métodos são claros em relação a quais status de licitacoes serão retornadas, o que torna a explicação da chamada inutil.

- Ruim

```php
$licitacoes = $pageObject->porStatus(Status::FUTURAS)->getLicitacoesFuturas();
$licitacoes = $pageObject->porStatus(Status::REALIZADAS)->getLicitacoesRealizadas();
```

- Bom

```php
$licitacoes = $pageObject->porStatus(Status::FUTURAS)->get();
$licitacoes = $pageObject->porStatus(Status::REALIZADAS)->get();
```

[Anterior](./exemplo1.md) | [Próximo](./exemplo3.md)
