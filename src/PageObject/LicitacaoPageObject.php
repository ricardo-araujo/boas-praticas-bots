<?php

namespace BoasPraticas\Bots\PageObject;

use BoasPraticas\Bots\Parser\LicitacaoParser;

class LicitacaoPageObject extends AbstractPageObject
{
    public function get()
    {
        $resp = $this->request('metodo', 'url do portal');

        return new LicitacaoParser($resp->getBody()->getContents());
    }
}
