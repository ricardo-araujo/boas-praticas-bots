<?php

namespace BoasPraticas\Bots\Iterator;

class LicitacaoIterator extends AbstractArrayIterator
{
    public function current()
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
            'dt_publiacao'     => 'data_deve_ser_parseada'
        ];
    }
}
