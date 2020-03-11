<?php

namespace BoasPraticas\Bots\PageObject;

use BoasPraticas\Bots\Parser\LicitacaoParser;

class LicitacaoPageObject extends AbstractPageObject
{
    const ANO_FINALIZACAO_TODOS = 0;
    const IDIOMA_PORTUGUES = 1;
    const NUMERO_PROCESSO_NENHUM = 0;
    const OBJETO_NENHUM = '';
    const TIPO_MURAL = 0;
    const TIPO_PROCESSO_TODOS = 0;
    const UNIDADE_COMPRADORA_TODAS = 0;
    const CODIGO_OPORTUNIDADE = 0;
    const CAMPO_CODIGO = 'NCDPROCESSO';

    const MODALIDADE_TODAS = 0;
    const MODALIDADE_COMPRA_DIRETA = 19;
    const MODALIDADE_PREGAO_ELETRONICO = 18;
    const MODALIDADE_PROCESSOS_PRESENCIAIS = 22;
    const MODALIDADE_COTACAO_DE_ORCAMENTO = 8;

    const SITUACAO_TODAS = 0;
    const SITUACAO_ABERTURA_PROPOSTAS = 9;
    const SITUACAO_AGENDADO_PUBLICADO = 1;
    const SITUACAO_EM_ADJUDICACAO = 22;

    private $processo = self::NUMERO_PROCESSO_NENHUM;
    private $modalidade = self::MODALIDADE_TODAS;
    private $situacao = self::SITUACAO_TODAS;
    private $codigoOportunidade = self::CODIGO_OPORTUNIDADE;

    private $qtdRegistrosPorPagina = 50;
    private $qtdRegistrosDe = 1;
    private $qtdRegistrosAte = 50;

    public function post() : LicitacaoParser
    {
        $response = $this->request('POST', 'https://compras.fieb.org.br/portal/WebService/Servicos.asmx/PesquisarProcessos', [
            'json' => [
                'dtoProcesso' => [
                    'nAnoFinalizacao' => self::ANO_FINALIZACAO_TODOS,
                    'tmpTipoMuralProcesso' => self::TIPO_MURAL,
                    'nCdModulo' => $this->modalidade,
                    'tmpTipoMuralVisao' => $this->situacao,
                    'nCdSituacao' => $this->situacao,
                    'nCdTipoProcesso' => self::TIPO_PROCESSO_TODOS,
                    'nCdEmpresa' => self::UNIDADE_COMPRADORA_TODAS,
                    'sNrProcesso' => $this->processo,
                    'nCdProcesso' => $this->codigoOportunidade,
                    'sDsObjeto' => self::OBJETO_NENHUM,
                    'sOrdenarPor' => self::CAMPO_CODIGO,
                    'sOrdenarPorDirecao' => 'DESC',
                    'dtoPaginacao' => [
                        'nPaginaDe' => $this->qtdRegistrosDe,
                        'nPaginaAte' => $this->qtdRegistrosAte,
                    ],
                    'dtoIdioma' => [
                        'nCdIdioma' => self::IDIOMA_PORTUGUES
                    ],
                ]
            ]
        ]);

        $this->proximosRegistros();

        return new LicitacaoParser($response->getBody()->getContents());
    }

    public function porProcesso(int $processo) : void
    {
        $this->processo = $processo;
    }

    public function porModalidade(int $modalidade) : void
    {
        $this->modalidade = $modalidade;
    }

    public function porSituacao(int $situacao) : void
    {
        $this->situacao = $situacao;
    }

    public function porCodigoOportunidade(int $codigo) : void
    {
        $this->codigoOportunidade = $codigo;
    }

    public function qtdeRegistrosPorPagina(int $qtde) : void
    {
        $this->qtdRegistrosPorPagina = $qtde;
    }

    private function proximosRegistros() : void
    {
        $this->qtdRegistrosDe += $this->qtdRegistrosPorPagina;
        $this->qtdRegistrosAte += $this->qtdRegistrosPorPagina;
    }
}
