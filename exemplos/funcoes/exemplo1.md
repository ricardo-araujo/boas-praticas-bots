Evite o uso de flags como paramêtro de funções

- Aceitável

```php
public function salvaArquivo($nome, $temp = false) 
{
    if ($temp) {
        file_put_contents('/tmp/' . $nome, 'conteudo');
    } else {
        file_put_contents($nome, 'conteudo');
    }
}
```
 
- Bom

```php
public function salvaArquivo($nome) 
{
    file_put_contents($nome, 'conteudo');
}

public function salvaArquivoTemporario($nome) 
{
    file_put_contents('/tmp/' . $nome, 'conteudo');
}
``` 

<p align="center">
    <a href="../variaveis/exemplo6.md"> << Tópico Anterior (Variáveis) </a> | <a href="exemplo2.md"> Próximo > </a>
</p>
