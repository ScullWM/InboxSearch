<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

class FilenameFilter implements FilterInterface
{
    /**
     * @param  string  $content
     * @return boolean
     */
    public function isSatisfied($content)
    {
        return (strstr($content, InboxSearchInterface::FILTER_FILENAME));
    }

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     * @return InboxSearchInterface
     */
    public function update(InboxSearchInterface $inboxSearch, $term)
    {
        $cleanTerm = str_replace(InboxSearchInterface::FILTER_FILENAME . ':', '', $term);
        $expTerm = explode(' ', $cleanTerm);

        $inboxSearch->setFilename($cleanTerm);
        $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_AFTER, implode(' ', $expTerm));

        return $inboxSearch;
    }
}