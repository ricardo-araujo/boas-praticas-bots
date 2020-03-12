> Abstraia valores "mágicos" para um contexto explicativo:

- Ruim

```php
$pageObject->porStatus(1)->get();

// ou

if ($licitacao->modalidade() == 3);
```

- Bom

```php
$pageObject->porStatus(Status::EM_ANDAMENTO)->get();

// ou

if ($licitacao->modalidade() == Modalidade::PREGAO_ELETRONICO);
```
