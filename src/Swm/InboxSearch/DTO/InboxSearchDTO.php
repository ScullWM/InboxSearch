<?php

namespace Swm\InboxSearch\DTO;

class InboxSearchDTO
{
    private $defaultInboxSearchFqcn = 'Swm\InboxSearch\Model\InboxSearch';
    private $searchString;

    private $filterParsing = [
        InboxSearchInterface::FILTER_FILENAME,
        InboxSearchInterface::FILTER_SIZE,
        InboxSearchInterface::FILTER_HAS,
        InboxSearchInterface::FILTER_FROM,
        InboxSearchInterface::FILTER_TO,
        InboxSearchInterface::FILTER_SUBJECT,
        InboxSearchInterface::FILTER_LABEL,
        InboxSearchInterface::FILTER_DELIVEREDTO,
        InboxSearchInterface::FILTER_AFTER,
        InboxSearchInterface::FILTER_BEFORE,
        InboxSearchInterface::FILTER_OLDER,
        InboxSearchInterface::FILTER_NEWER,
        InboxSearchInterface::FILTER_IN
    ];

    public function __construct($searchString)
    {
        $this->searchString = $searchString;
    }

    public function process()
    {
        $exploded = explode(';', $this->prepare($this->searchString));

        $inboxSearch = new $this->defaultInboxSearchFqcn();

        foreach (array_filter($exploded) as $term) {
            # code...
        }
    }

    /**
     * @param  string $string
     * @return string
     */
    private function prepare($string)
    {
        $filterParsingDelimiter = array_map(function($filter){ return ';' . $filter;}, $this->filterParsing);
        return str_replace($this->filterParsing, $filterParsingDelimiter, $string);
    }
}