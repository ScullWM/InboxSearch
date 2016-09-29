<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class DeliveredToFilter implements FilterInterface
{
    /**
     * @param  string  $content
     * @return boolean
     */
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_DELIVEREDTO));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_DELIVEREDTO . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setDelivredTo(new \DateTime($cleanTerm));
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_DELIVEREDTO, implode(' ', $expTerm));

        return $inboxSearch;
    }
}