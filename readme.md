# Desenvolvendo crawlers de forma limpa

> Esse projeto tem como objetivo mostrar algumas melhorias observadas ao longo do tempo e que fazem de um projeto de bot mais fácil de entender/corrigir/evoluir.

<a name="tabela-de-conteudo"/>

### Conteúdo

- [Pré-requisitos](#pre-requisitos)
    - [Local](#pre-requisitos-local)
    - [Dockerfile](#pre-requisitos-dockerfile)
- [Introdução](#intro)
- [Variáveis](#variaveis)
- [Funções](#funcoes)

<a name="intro"/>

### Pré-requisitos

<a name="pre-requisitos-local"/>

#### Local

Para o funcionamento dos scripts, é necessário a versão >= 7 do PHP. Uma vez instalada, rode no terminal para instalar as dependências do projeto:

```bash
php composer.phar install
```

<a name="pre-requisitos-dockerfile"/>

#### Dockerfile

Caso tenha o Docker instalado em sua maquina, execute o comando abaixo na raiz do projeto:

```bash
docker build -t boas-praticas-bots . 
# e após
docker run -it --rm --name boas-praticas-bots -v "$PWD":/www/boas-praticas-bots -w /www/boas-praticas-bots boas-praticas-bots bash
``` 

Ao entrar no container, repita o passo feito localmente p/ instalar as dependências do projeto.

<a name="intro"/>

### Introdução

As dicas aqui observadas, inspiradas no [clean-code-php](https://github.com/jupeter/clean-code-php), seguem os princípios adotados no clássico livro [Clean Code: A Handbook of Agile Software Craftsmanship](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882), e de forma alguma devem ser adotadas como regra universal e absoluta, mas assim como o próprio livro, servir como um guia para ser adaptado às devidas necessidades dentro de um projeto (no caso, bots).

Mas afinal de contas, o que são bots? De acordo com a [Wikipedia](https://pt.wikipedia.org/wiki/Bot): 

_"...diminutivo de 'robot', também conhecido como internet bot ou web robot, é uma aplicação de software concebido para simular ações humanas repetidas vezes de maneira padrão, da mesma forma como faria um robô. No contexto dos programas de computador, pode ser um utilitário que desempenha tarefas rotineiras..."_

Aplicando esse conceito ao nosso universo, capturamos informações disponibilizadas em portais de compras publicas gerais e centralizamos essas informações.

Para tanto, foi definido um padrão de projetos chamado [Page Object](https://martinfowler.com/bliki/PageObject.html), bastante usado para testes em paginas e aplicações web, que em resumo, permite criar um repositório de objetos com elementos contidos nessa página, devendo haver uma classe correspondente a cada página. Uma vez tendo essas páginas, extraimos e testamos as informações nelas obtidas. 

As classes usadas para extração de informações que aparecem de forma "única" (Ex.: quantidade de licitações ou nome de um órgão) na página, chamamos de Parsers

Quando dentro das páginas encontramos uma lista estruturada de informações (Ex.: uma tabela de licitações do dia), usamos classes chamadas de Iterators.

Agora, seguem as dicas:

<a name="variaveis"/>

### Variaveis

- Apesar de uma dica básica, é comum ver perdido pelo código variáveis indecifráveis. Nomes de variáveis devem ser claros e objetivos, evitando que seu código seja mal interpretado:

#### Ruim

```php
$dtPuLi = $licitacao['dt_publicacao'];
```

#### Bom

```php
$dataPublicacao = $licitacao['dt_publicacao'];
//ou
$dtPublicacaoLicitacao = $licitacao['dt_publicacao'];
```

- Caso o contexto de acesso às informações seja o mesmo, como por exemplo, um get em licitações futuras ou realizadas, use o mesmo vocabulário para esse mesmo tipo. Abaixo, os métodos são claros em relação a quais status de licitacoes serão retornadas, o que torna a explicação da chamada inutil.

#### Ruim

```php
$licitacoes = $pageObject->porStatus(Status::FUTURAS)->getLicitacoesFuturas();
$licitacoes = $pageObject->porStatus(Status::REALIZADAS)->getLicitacoesRealizadas();
```

#### Bom

```php
$licitacoes = $pageObject->porStatus(Status::FUTURAS)->get();
$licitacoes = $pageObject->porStatus(Status::REALIZADAS)->get();
```

- Abstraia valores "mágicos" para um contexto explicativo:

#### Ruim

```php
$pageObject->porStatus(1)->get();
// ou
if ($licitacao->modalidade() == 3);
```

#### Bom

```php
$pageObject->porStatus(Status::EM_ANDAMENTO)->get();
// ou
if ($licitacao->modalidade() == Modalidade::PREGAO_ELETRONICO);
```

- Caso a captura de informações sejam feitas através de regexes, o que é comum em alguns portais, padrões explicativos podem ser utilizados:

#### Ruim

```php
class ConsultaLicitacaoParser
{
    public function qtdLicitacoes()
    {
        $text = $this->elementText('//td[@class="td_titulo_campo"][contains(., "Licitações")]/center');

        preg_match('#(\d+)\)#U', $text, $match); // <-------------

        return  (int) $match[1] ?? 0;
    }
...
```

#### Bom

```php
class ConsultaLicitacaoParser
{
    public function qtdLicitacoes()
    {
        $text = $this->elementText('//td[@class="td_titulo_campo"][contains(., "Licitações")]/center');

        preg_match('#(?<qtd_licitacao>\d+)\)#U', $text, $match);

        return  (int) $match['qtd_licitacao'] ?? 0; // <-------------
    }
...
```
- Não force quem lê o código a traduzir o que está sendo feito:

#### Ruim
```php
$l = $parser->licitacoes();

for ($i = 0; $i < count($l); $i++) {
    $li = $l[$i];
    salvaNoBancoDeDados($li);
}
```

#### Bom
```php
$licitacoes = $parser->licitacoes();

foreack ($licitacoes as $licitacao) {
    salvaNoBancoDeDados($licitacao);
}
```

#### Ruim
```php
class PortalQualquerLicitacaoIterator extends AbstractIterator
{
    public function current()
    {
        $element = $this->offsetGet($this->key()); 

        return [
            'nCdProcesso' => $element['nCdProcesso'],               // a principio, traduzir valores como os das chaves 
            'sNrProcessoDisplay' => $element['sNrProcessoDisplay'], // pode ser um pouco complicado p/ quem não conhece
            'sNrEdital' => $element['sNrEdital'],                   // o portal em questao
            'sDsObjeto' => $element['sDsObjeto'],
            'sNmEmpresa' => $element['sNmEmpresa'],
            'sNmApelido' => $element['sNmApelido'],
            'sDsSituacao' => $element['sDsSituacao'],
            'sNmModalidade' => $element['sNmModalidade'],
        ];
    }
}
```

#### Bom
```php
class PortalQualquerLicitacaoIterator extends AbstractIterator
{
    public function current()
    {
        $element = $this->offsetGet($this->key());

        return [
            'codigo_oportunidade' => $element['nCdProcesso'],
            'numero_processo' => $element['sNrProcessoDisplay'],
            'numero_edital' => $element['sNrEdital'],
            'objeto' => $element['sDsObjeto'],
            'nome_orgao' => $element['sNmEmpresa'],
            'razao_social_orgao' => $element['sNmApelido'],
            'status' => $element['sDsSituacao'],
            'modalidade' => $element['sNmModalidade'],
        ];
    }
}
```

- Evite aninhamentos grandes e pratique o "early return"

#### Ruim
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

#### Bom
```php
if (empty($status)) {
    return false; //early return    
}

$statusValidos = ['em_andamento', 'futuras', 'encerradas'];

return in_array($status, $statusValidos, true);
```

<a name="funcoes" />

### Funções

- Evite o uso de flags como paramêtro de funções

#### Ruim
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
 
#### Bom
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
- Encapsule condicionais e não revele suas regras de negócio

#### Ruim
```php
if ($parser->qtdDeLicitacoes() === 0) {
    // ... 
}
```
 
#### Bom
```php
if ($parser->temLicitacoes()) {
    // ...
}
```
