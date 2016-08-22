<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class NewerFilter implements FilterInterface
{
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_NEWER));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_NEWER . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setNewer(new \DateTime($cleanTerm));
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_NEWER, implode(' ', $expTerm));

        return $inboxSearch;
    }
}