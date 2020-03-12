> Encapsule condicionais e não revele suas regras de negócio

- Ruim

```php
if ($parser->qtdDeLicitacoes() === 0) {
    // ... 
}
```
 
- Bom

```php
if ($parser->temLicitacoes()) {
    // ...
}
```

<p>
    <a href="exemplo1.md"> Anterior </a> | <a href="exemplo3.md"> Próximo </a> 
</p>
