> Evite condicionais negativas:

- Ruim

```php
function naoTemProximaPagina() : bool {}

if (!$parser->naoTemProximaPagina()) { //aqui a confusão se da por negar uma condicional negativa para saber qual é o resultado verdadeiro... confuso
    //...
}
```

- Bom

```php
function temProximaPagina() : bool {} // dessas formas, a chamada da função acompanha um raciocínio logico, e não cria a confusao da forma acima 

if ($parser->temProximaPagina())  { 
    // ...
}

if (!$parser->temProximaPagina()) { 
    //...
}
```

<p>
    <a href="exemplo2.md"> Anterior </a> | <a href="exemplo4.md"> Próximo </a> 
</p>
