Abstraia valores "mágicos" para um contexto explicativo:

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

<p align="center">
    <a href="exemplo2.md"> < Anterior </a> | <a href="exemplo4.md"> Próximo > </a> 
</p>
