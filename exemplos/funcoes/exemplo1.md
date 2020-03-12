> Evite o uso de flags como paramêtro de funções

- Ruim

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

[Próximo](./exemplo2.md)
