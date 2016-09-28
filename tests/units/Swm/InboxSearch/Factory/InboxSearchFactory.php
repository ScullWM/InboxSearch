<?php

namespace tests\units\Swm\InboxSearch\Factory;

require_once __DIR__.'/../../../../../vendor/autoload.php';

use atoum;

class InboxSearchFactory extends atoum
{
    public function testAddFilterParser()
    {
        $this
            ->given($this->newTestedInstance('element'))
            ->if($this->newTestedInstance->addFilterParser('my_fake_filter_fqcn'))
            ->then
                ->array($this->testedInstance->getAllFilters())
                ->contain('my_fake_filter_fqcn')
        ;
    }
}