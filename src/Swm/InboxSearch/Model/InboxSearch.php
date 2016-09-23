<?php

namespace Swm\InboxSearch\Model;

use Swm\InboxSearch\Model\DatesTrait;

class InboxSearch implements InboxSearchInterface
{
    use DatesTrait;

    protected $filename;
    protected $size = 0;
    protected $has;
    protected $from;
    protected $to;
    protected $subject;
    protected $label;
    protected $deliveredto;

    protected $in;
    protected $keyword = [];

    /**
     * Gets the value of filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename the filename
     *
     * @return this
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Gets the value of size.
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param integer $size the size
     *
     * @return this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    public function getHas()
    {
        return $this->has;
    }

    /**
     * @param string $has the has
     *
     * @return this
     */
    public function setHas($has)
    {
        $this->has = $has;

        return $this;
    }

    /**
     * Gets the value of from.
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from the from
     *
     * @return this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Gets the value of to.
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $to the to
     *
     * @return this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Gets the value of subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject the subject
     *
     * @return this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Gets the value of label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label the label
     *
     * @return this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Gets the value of deliveredto.
     *
     * @return string
     */
    public function getDeliveredto()
    {
        return $this->deliveredto;
    }

    /**
     * @param string $deliveredto the deliveredto
     *
     * @return this
     */
    public function setDeliveredTo($deliveredto)
    {
        $this->deliveredto = $deliveredto;

        return $this;
    }

    /**
     * Gets the value of in.
     *
     * @return string
     */
    public function getIn()
    {
        return $this->in;
    }

    /**
     * @param string $in the in
     *
     * @return this
     */
    public function setIn($in)
    {
        $this->in = $in;

        return $this;
    }

    /**
     * Gets the value of keyword.
     *
     * @return array
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Gets the keyword value for a filter.
     *
     * @return string|null
     */
    public function getKeywordFor($filter)
    {
        if (isset($this->keyword[$filter])) {
            return $this->keyword[$filter]
        }
    }

    /**
     * @param string $keyword the keyword
     *
     * @return this
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function addKeywordForFilter($filter, $keyword)
    {
        $this->keyword[$filter] = $keyword;

        return $this;
    }
}