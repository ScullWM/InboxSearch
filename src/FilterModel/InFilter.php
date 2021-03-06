<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class InFilter implements FilterInterface
{
    /**
     * @param  string  $content
     * @return boolean
     */
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_IN));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_IN . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setIn($cleanTerm);
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_IN, implode(' ', $expTerm));

        return $inboxSearch;
    }
}