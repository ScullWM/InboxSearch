<?php

namespace tests\units\Swm\InboxSearch\Factory;

use Swm\InboxSearch\Factory\InboxSearchFactory as TestedClass;
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
}