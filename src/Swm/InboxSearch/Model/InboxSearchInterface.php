<?php

namespace Swm\InboxSearch\Model;

interface InboxSearchInterface
{
    const FILTER_FILENAME = 'filename';
    const FILTER_SIZE = 'size';
    const FILTER_HAS = 'has';
    const FILTER_FROM = 'from';
    const FILTER_TO = 'to';
    const FILTER_SUBJECT = 'subject';
    const FILTER_LABEL = 'label';
    const FILTER_DELIVEREDTO = 'deliveredto';
    const FILTER_AFTER = 'after';
    const FILTER_BEFORE = 'before';
    const FILTER_OLDER = 'older';
    const FILTER_NEWER = 'newer';
    const FILTER_IN = 'in';
}