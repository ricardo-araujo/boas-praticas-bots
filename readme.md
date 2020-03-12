# Desenvolvendo crawlers de forma limpa

Esse projeto tem como objetivo mostrar algumas melhorias observadas ao longo do tempo e que fazem de um projeto de bot mais fácil de entender/corrigir/evoluir.

<a name="tabela-de-conteudo"/>

### Conteúdo

- [Pré-requisitos](#pre-requisitos)
    - [Local](#pre-requisitos-local)
    - [Dockerfile](#pre-requisitos-dockerfile)
- [Introdução](#intro)
- [Variáveis](./exemplos/variaveis)
- [Funções](./exemplos/funcoes)
- [Classes](./exemplos/classes)
- [Conceituais](./exemplos/conceituais)

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

Caso tenha o Docker instalado em sua máquina, execute o comando abaixo na raiz do projeto:

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
