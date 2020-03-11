<?php

namespace BoasPraticas\Bots\Parser;

use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractParser
{
    protected $crawler;

    public function __construct(string $bodyContents, string $charset = 'UTF-8')
    {
        $this->crawler = new Crawler();
        $this->crawler->addHtmlContent($bodyContents, $charset);
    }
}
