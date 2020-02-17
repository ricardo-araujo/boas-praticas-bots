<?php

namespace BoasPraticas\Bots\PageObject;

use BoasPraticas\Bots\Parser\LicitacaoDetalhesParser;

class LicitacaoDetalhesPageObject extends AbstractPageObject
{
    public function get()
    {
        $resp = $this->request('metodo request', 'url do portal p/ pegar detalhes');

        return new LicitacaoDetalhesParser($resp->getBody()->getContents());
    }
}
