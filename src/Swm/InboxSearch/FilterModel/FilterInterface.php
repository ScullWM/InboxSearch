<?php

namespace Swm\InboxSearch\FilterModel;

use Swm\InboxSearch\Model\InboxSearchInterface;

interface FilterInterface
{
    /**
     * @param  string  $content
     */
    public function isSatisfied($content);

    /**
     * @param  InboxSearchInterface $InboxSearch
     * @param  string               $term
     */
    public function update(InboxSearchInterface $inboxSearch, $term);
}