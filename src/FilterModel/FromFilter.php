<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class FromFilter implements FilterInterface
{
    /**
     * @param  string  $content
     * @return boolean
     */
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_FROM));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_FROM . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setFrom($cleanTerm);
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_FROM, implode(' ', $expTerm));

        return $inboxSearch;
    }
}