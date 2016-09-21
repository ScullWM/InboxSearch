<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class BeforeFilter implements FilterInterface
{
    /**
     * @param  string  $content
     * @return boolean
     */
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_BEFORE));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_BEFORE . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setBefore(new \DateTime($cleanTerm));
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_BEFORE, implode(' ', $expTerm));

        return $inboxSearch;
    }
}