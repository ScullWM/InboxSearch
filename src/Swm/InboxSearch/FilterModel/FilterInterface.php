<?php

namespace Swm\InboxSearch\FilterModel;

interface FilterInterface
{
    public function isSatisfied($content);
}