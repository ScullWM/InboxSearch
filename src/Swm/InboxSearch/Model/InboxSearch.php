<?php

namespace Swm\InboxSearch\Model;

use Swm\InboxSearch\Model\DatesTrait;

class InboxSearch implements InboxSearchInterface
{
    use DatesTrait;


    protected $filename;
    protected $size;
    protected $has;
    protected $from;
    protected $to;
    protected $subject;
    protected $label;
    protected $deliveredto;

    protected $in;
    protected $keyword = [];
}