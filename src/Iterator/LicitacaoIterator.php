<?php

namespace BoasPraticas\Bots\Iterator;

class LicitacaoIterator extends AbstractArrayIterator
{
    public function current() : array
    {
        $licitacao = $this->iterator->current();

        return [
            'codigo_licitacao' => $licitacao['nCdProcesso'],
            'processo'         => $licitacao['sNrEdital'],
            'objeto'           => $licitacao['sDsObjeto'],
            'razao_social'     => $licitacao['sNmEmpresa'],
            'nome_fantasia'    => $licitacao['sNmApelido'],
            'situacao'         => $licitacao['sDsSituacao'],
            'modalidade'       => $licitacao['sNmModalidade'],
            'dt_publicacao'    => 'data_a_ser_parseada...'
        ];
    }
}
