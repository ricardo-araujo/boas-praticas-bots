<?php

namespace BoasPraticas\Bots\PageObject;

use BoasPraticas\Bots\Parser\UmaClasseDeParser;

class Uma_Classe_de_bot_errada extends AbstractPageObject
{
    const URL = 'https://www.receitaws.com.br/v1/cnpj/00000000000191';

    public function uma_requisicao()
    {
      $response = $this->request('GET', self::URL);



      return new UmaClasseDeParser($response->getBody()->getContents());

    }
}

?>
