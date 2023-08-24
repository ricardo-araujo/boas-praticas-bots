<?php

namespace BoasPraticas\Bots\Tests;

use BoasPraticas\Bots\PageObject\Uma_Classe_de_bot_errada;
use BoasPraticas\Bots\Parser\AbstractParser;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class UmaClasseDeBotErradaTest extends TestCase
{
    public function testRequisicaoDeveRetornarUmParser()
    {
        $pageObject = new Uma_Classe_de_bot_errada(new Client());

        $parser = $pageObject->uma_requisicao();

        $this->assertInstanceOf(AbstractParser::class, $parser);
    }

    public function testInformacoesDoParser()
    {
        $pageObject = new Uma_Classe_de_bot_errada(new Client());

        $parser = $pageObject->uma_requisicao();

        $this->assertArrayHasKey('nome', $parser->getEmpresaAsArray());
    }
}
