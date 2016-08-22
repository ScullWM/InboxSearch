<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class SizeFilter implements FilterInterface
{
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_SIZE));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_SIZE . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setSize($cleanTerm);
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_SIZE, implode(' ', $expTerm));

        return $inboxSearch;
    }

    /**
     * @param  string $stringFilesize
     * @return integer
     */
    private function readableFilesize($stringFilesize)
    {
        $stringFilesize = trim(str_replace(' ', '', $stringFilesize));
        $last = strtoupper($stringFilesize[strlen($stringFilesize)-1]);

        $stringFilesize = (int) $stringFilesize;

        if ($last != 'G' && $last != 'M' && $last != 'K') {
            throw new \InvalidArgumentException("Invalid size format");
        }

        switch($last) {
            case 'G':
                $stringFilesize *= 1024;
            case 'M':
                $stringFilesize *= 1024;
            case 'K':
                $stringFilesize *= 1024;
        }
        return (int) $stringFilesize;
    }
}