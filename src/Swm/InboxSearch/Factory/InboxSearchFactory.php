<?php

namespace Swm\InboxSearch\Factory;

use Swm\InboxSearch\FilterModel\FilterInterface;
use Swm\InboxSearch\Model\InboxSearchInterface;

class InboxSearchFactory
{
    private $defaultInboxSearchFqcn = 'Swm\InboxSearch\Model\InboxSearch';
    private $searchString;

    const INTERNAL_DELIMITER = '||';

    private $filterParsing = [
        InboxSearchInterface::FILTER_FILENAME    => 'Swm\InboxSearch\FilterModel\FilenameFilter',
        InboxSearchInterface::FILTER_SIZE        => 'Swm\InboxSearch\FilterModel\SizeFilter',
        InboxSearchInterface::FILTER_HAS         => 'Swm\InboxSearch\FilterModel\HasFilter',
        InboxSearchInterface::FILTER_FROM        => 'Swm\InboxSearch\FilterModel\FromFilter',
        InboxSearchInterface::FILTER_TO          => 'Swm\InboxSearch\FilterModel\ToFilter',
        InboxSearchInterface::FILTER_SUBJECT     => 'Swm\InboxSearch\FilterModel\SubjectFilter',
        InboxSearchInterface::FILTER_LABEL       => 'Swm\InboxSearch\FilterModel\LabelFilter',
        InboxSearchInterface::FILTER_DELIVEREDTO => 'Swm\InboxSearch\FilterModel\DeliveredToFilter',
        InboxSearchInterface::FILTER_AFTER       => 'Swm\InboxSearch\FilterModel\AfterFilter',
        InboxSearchInterface::FILTER_BEFORE      => 'Swm\InboxSearch\FilterModel\BeforeFilter',
        InboxSearchInterface::FILTER_OLDER       => 'Swm\InboxSearch\FilterModel\OlderFilter',
        InboxSearchInterface::FILTER_NEWER       => 'Swm\InboxSearch\FilterModel\NewerFilter',
        InboxSearchInterface::FILTER_IN          => 'Swm\InboxSearch\FilterModel\InFilter',
    ];

    /**
     * @param string $searchString
     */
    public function __construct($searchString)
    {
        $this->searchString = $searchString;
    }

    /**
     * @param string $defaultInboxSearchFqcn
     */
    public function setDefaultInboxSearchFqcn($defaultInboxSearchFqcn)
    {
        $this->defaultInboxSearchFqcn = $defaultInboxSearchFqcn;

        return $this;
    }

    /**
     * @param string $filterParserFqcn
     */
    public function addFilterParser($filterParserFqcn)
    {
        $this->filterParsing[] = $filterParserFqcn;
    }

    /**
     * @param  mixed $filterParserKey
     */
    public function removeFilterParser($filterParserKey)
    {
        if (array_key_exists($filterParserKey, $this->filterParsing)) {
            unset($this->filterParsing[$filterParserKey])
        }
    }

    /**
     * @return array<string>
     */
    public function getAllFilters()
    {
        return $this->filterParsing;
    }

    /**
     * @param  string $string
     * @return string
     */
    private function prepare($string)
    {
        $filterParsingDelimiter = array_map(function($filter){ return self::INTERNAL_DELIMITER . $filter;}, $this->filterParsing);
        return str_replace($this->filterParsing, $filterParsingDelimiter, $string);
    }

    /**
     * @return InboxSearchInterface
     */
    public function process()
    {
        $explodedTerms = explode(self::INTERNAL_DELIMITER, $this->prepare($this->searchString));
        $inboxSearch = new $this->defaultInboxSearchFqcn();

        foreach ($this->filterParsing as $filter => $filterFqcn) {
            $this->filterParsing[$filter] = new $filterFqcn();
        }

        foreach (array_filter($explodedTerms) as $term) {
            foreach ($this->filterParsing as $filter => $filterModel) {

                if ($filterModel->isSatisfied($term)) {

                    $filterModel->update($inboxSearch, $term);
                }

            }
        }

        return $inboxSearch;
    }
}