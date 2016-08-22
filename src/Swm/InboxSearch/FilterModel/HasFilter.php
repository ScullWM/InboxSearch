<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class HasFilter implements FilterInterface
{
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_HAS));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_HAS . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setHas($cleanTerm);

        return $inboxSearch;
    }
}