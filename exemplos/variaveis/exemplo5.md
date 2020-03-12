> Não force o leitor a traduzir o que está sendo feito:

- Ruim

```php
$l = $parser->licitacoes();

for ($i = 0; $i < count($l); $i++) {
    $li = $l[$i];
    salvaNoBancoDeDados($li);
}
```

- Bom

```php
$licitacoes = $parser->licitacoes();

foreack ($licitacoes as $licitacao) {
    salvaNoBancoDeDados($licitacao);
}
```

- Ruim

```php
class PortalQualquerLicitacaoIterator extends AbstractIterator
{
    public function current()
    {
        $element = $this->iterator->current(); 

        return [
            'nCdProcesso'        => $element['nCdProcesso'],        // a principio, traduzir valores como os das chaves 
            'sNrProcessoDisplay' => $element['sNrProcessoDisplay'], // pode ser um pouco complicado p/ quem não conhece
            'sNrEdital'          => $element['sNrEdital'],          // o portal em questao
            'sDsObjeto'          => $element['sDsObjeto'],
            'sNmEmpresa'         => $element['sNmEmpresa'],
            'sNmApelido'         => $element['sNmApelido'],
            'sDsSituacao'        => $element['sDsSituacao'],
            'sNmModalidade'      => $element['sNmModalidade'],
        ];
    }
}
```

- Bom

```php
class PortalQualquerLicitacaoIterator extends AbstractIterator
{
    public function current()
    {
        $element = $this->iterator->current();

        return [
            'codigo_oportunidade' => $element['nCdProcesso'],
            'numero_processo'     => $element['sNrProcessoDisplay'],
            'numero_edital'       => $element['sNrEdital'],
            'objeto'              => $element['sDsObjeto'],
            'nome_orgao'          => $element['sNmEmpresa'],
            'razao_social_orgao'  => $element['sNmApelido'],
            'status'              => $element['sDsSituacao'],
            'modalidade'          => $element['sNmModalidade'],
        ];
    }
}
```
