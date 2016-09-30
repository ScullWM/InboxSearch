<?php

namespace tests\units\Swm\InboxSearch\Factory;

use Swm\InboxSearch\Factory\InboxSearchFactory as TestedClass;
use Swm\InboxSearch\Model\InboxSearchInterface;
use mageekguy\atoum;

class InboxSearchFactory extends atoum\test
{
    public function testAddFilterParser()
    {
        $this
            ->given($this->newTestedInstance('element'))
            ->if($this->testedInstance->addFilterParser('my_fake_filter_fqcn'))
            ->then
                ->array($this->testedInstance->getAllFilters())
                ->contains('my_fake_filter_fqcn')
        ;
    }

    public function testProcess()
    {
        $this
            ->given($this->newTestedInstance('element'))
            ->then
                ->object($this->testedInstance->process())
                    ->isInstanceOf('Swm\InboxSearch\Model\InboxSearch')
        ;
    }

    public function testRemoveFilterParser()
    {
        $this
            ->given($this->newTestedInstance('element'))
            ->if($this->testedInstance->removeFilterParser(InboxSearchInterface::FILTER_FROM))
            ->then
                ->array($this->testedInstance->getAllFilters())
                    ->notHasKey(InboxSearchInterface::FILTER_FROM)
        ;
    }

    public function testFromFilter()
    {
        $inboxSearch = $this->newTestedInstance('from:thomas@scullwm.com forum')->process();

        $this
            ->given($inboxSearch)
            ->then
                ->string($inboxSearch->getFrom())
                    ->isEqualTo('thomas@scullwm.com')
            ->then
                ->string($inboxSearch->getKeywordFor(InboxSearchInterface::FILTER_FROM))
                    ->isEqualTo('forum')
            ->then
                ->array($inboxSearch->getKeyword())
                    ->notHasKeys([InboxSearchInterface::FILTER_FILENAME, InboxSearchInterface::FILTER_SUBJECT])
                    ->hasKey(InboxSearchInterface::FILTER_FROM)
                    ->contains('forum')
        ;
    }

    public function testFromFilterComposed()
    {
        $randomValue = md5(mt_rand());
        $inboxSearch = $this->newTestedInstance('from:thomas+testing123@scullwm.com my great test '. $randomValue)->process();

        $this
            ->given($inboxSearch)
            ->then
                ->string($inboxSearch->getFrom())
                    ->isEqualTo('thomas+testing123@scullwm.com')
            ->then
                ->string($inboxSearch->getKeywordFor(InboxSearchInterface::FILTER_FROM))
                    ->isEqualTo('my great test '. $randomValue)
            ->then
                ->array($inboxSearch->getKeyword())
                    ->notHasKeys([InboxSearchInterface::FILTER_FILENAME, InboxSearchInterface::FILTER_SUBJECT])
                    ->hasKey(InboxSearchInterface::FILTER_FROM)
                    ->contains('my great test '. $randomValue)
        ;
    }

    public function testFilenameFilter()
    {
        $inboxSearch = $this->newTestedInstance('filename:file.xls mykeyword')->process();

        $this
            ->given($inboxSearch)
            ->then
                ->string($inboxSearch->getFilename())
                    ->isEqualTo('file.xls')
            ->then
                ->string($inboxSearch->getKeywordFor(InboxSearchInterface::FILTER_FILENAME))
                    ->isEqualTo('mykeyword')
        ;
    }

    public function testSubjectFilter()
    {
        $inboxSearch = $this->newTestedInstance('subject:here is my subject')->process();

        $this
            ->given($inboxSearch)
            ->then
                ->string($inboxSearch->getSubject())
                    ->isEqualTo('here is my subject')
            ->then
                ->variable($inboxSearch->getKeywordFor(InboxSearchInterface::FILTER_SUBJECT))
                    ->isNull()
        ;
    }
}