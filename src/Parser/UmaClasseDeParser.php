<?php

namespace BoasPraticas\Bots\Parser;

class UmaClasseDeParser extends AbstractParser
{
    public function getEmpresaAsArray()
    {
        $body = $this->crawler->filterXPath('//body')->text();

        return json_decode($body, true);
    }
}
