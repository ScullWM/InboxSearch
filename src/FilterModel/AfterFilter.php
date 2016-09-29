<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class AfterFilter implements FilterInterface
{
    /**
     * @param  string  $content
     * @return boolean
     */
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_AFTER));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_AFTER . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setAfter(new \DateTime($expTerm[0]));
        unset($expTerm[0]);
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_AFTER, implode(' ', $expTerm));

        return $inboxSearch;
    }
}