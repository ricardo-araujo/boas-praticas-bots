<?php

namespace BoasPraticas\Bots\Parser;

use BoasPraticas\Bots\Iterator\LicitacaoIterator;

class LicitacaoParser extends AbstractParser
{
    public function temRegistros() : bool
    {
        return ! empty($this->toArray());
    }

    public function licitacoes() : LicitacaoIterator
    {
        return new LicitacaoIterator($this->toArray());
    }

    private function toArray() : array
    {
        return @json_decode($this->crawler->text(), true)['d'] ?? [];
    }
}
