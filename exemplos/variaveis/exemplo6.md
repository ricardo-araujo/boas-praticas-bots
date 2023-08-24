Evite aninhamentos grandes e pratique o "early return"

- Ruim

```php
if ($status) {
    if ($status === 'em_andamento') {
        return true;
    } elseif ($status === 'futuras') {
        return true;
    } elseif ($status === 'encerradas') {
        return true;
    } else {
        return false;
    }
} else {
    return false;
}
```

- Bom

```php
if (empty($status)) {
    return false; //early return    
}

$statusValidos = ['em_andamento', 'futuras', 'encerradas'];

return in_array($status, $statusValidos, true);
```

<p align="center">
    <a href="exemplo5.md"> < Anterior </a> | <a href="../funcoes/exemplo1.md"> Próximo Tópico (Funções) >> </a>
</p>
