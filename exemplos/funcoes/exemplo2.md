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
