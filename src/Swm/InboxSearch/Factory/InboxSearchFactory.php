<?php

namespace Swm\InboxSearch\Factory;

use Swm\InboxSearch\Model\InboxSearchInterface;

class InboxSearchFactory
{
    private $defaultInboxSearchFqcn = 'Swm\InboxSearch\Model\InboxSearch';
    private $searchString;

    const INTERNAL_DELIMITER = '||';

    const DONT_EXTRACT_KEYWORD = false;
    const EXTRACT_KEYWORD = true;

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

    /**
     * @param string $searchString
     */
    public function __construct($searchString)
    {
        $this->searchString = $searchString;
    }

    public function process()
    {
        $exploded    = explode(self::INTERNAL_DELIMITER, $this->prepare($this->searchString));
        $inboxSearch = new $this->defaultInboxSearchFqcn();

        foreach (array_filter($exploded) as $term) {
            foreach ($this->filterParsing as $filter) {
                if (strstr($term, $filter)) {
                    // var_dump(self::INTERNAL_DELIMITER . $filter);
                    $cleanTerm = str_replace($filter . ':', '', $term);
                    $expTerm = explode(' ', $cleanTerm);

                    switch ($filter) {
                        case InboxSearchInterface::FILTER_AFTER:
                            $inboxSearch->setAfter(new \DateTime($cleanTerm));
                            break;
                        case InboxSearchInterface::FILTER_BEFORE:
                            $inboxSearch->setBefore(new \DateTime($cleanTerm));
                            break;
                        case InboxSearchInterface::FILTER_OLDER:
                            $inboxSearch->setOlder(new \DateTime($cleanTerm));
                            break;
                        case InboxSearchInterface::FILTER_NEWER:
                            $inboxSearch->setNewer(new \DateTime($cleanTerm));
                            break;
                        case InboxSearchInterface::FILTER_FILENAME:
                            $inboxSearch->setFilename($cleanTerm);
                            break;
                        case InboxSearchInterface::FILTER_SIZE:
                            $inboxSearch->setSize((int) $cleanTerm);
                            break;
                        case InboxSearchInterface::FILTER_HAS:
                            $inboxSearch->setHas($cleanTerm);
                            break;
                        case InboxSearchInterface::FILTER_SUBJECT:
                            $inboxSearch->setSubject($cleanTerm);
                            break;
                        case InboxSearchInterface::FILTER_LABEL:
                            $inboxSearch->setLabel($cleanTerm);
                            break;
                        case InboxSearchInterface::FILTER_FROM:
                            if (count($expTerm) > 1) {
                                $inboxSearch->setFrom($expTerm[0]);
                                unset($expTerm[0]);
                                $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_FROM, implode(' ', $expTerm));
                            } else {
                                $inboxSearch->setFrom($cleanTerm);
                            }
                            break;
                        case InboxSearchInterface::FILTER_TO:
                            if (count($expTerm) > 1) {
                                $inboxSearch->setTo($expTerm[0]);
                                unset($expTerm[0]);
                                $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_TO, implode(' ', $expTerm));
                            } else {
                                $inboxSearch->setTo($cleanTerm);
                            }
                            break;
                        case InboxSearchInterface::FILTER_DELIVEREDTO:
                            if (count($expTerm) > 1) {
                                $inboxSearch->setDelivredTo($expTerm[0]);
                                unset($expTerm[0]);
                                $inboxSearch->addKeywordForFilter(InboxSearchInterface::FILTER_DELIVEREDTO, implode(' ', $expTerm));
                            } else {
                                $inboxSearch->setDelivredTo($cleanTerm);
                            }
                            break;
                        case InboxSearchInterface::FILTER_IN:
                            $inboxSearch->setIn($cleanTerm);
                            break;
                    }
                }
            }
        }
        var_dump($inboxSearch);
        return $inboxSearch;
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
}