<?php

namespace Swm\InboxSearch\Model;

trait DatesTrait
{
    protected $after;
    protected $before;
    protected $older;
    protected $newer;

    /**
     * Gets the value of after.
     *
     * @return mixed
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param \DateTime $after the after
     *
     * @return this
     */
    public function setAfter(\DateTime $after)
    {
        $this->after = $after;

        return $this;
    }

    /**
     * Gets the value of before.
     *
     * @return mixed
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param \DateTime $before the before
     *
     * @return this
     */
    public function setBefore(\DateTime $before)
    {
        $this->before = $before;

        return $this;
    }

    /**
     * Gets the value of older.
     *
     * @return mixed
     */
    public function getOlder()
    {
        return $this->older;
    }

    /**
     * @param \DateTime $older the older
     *
     * @return this
     */
    public function setOlder(\DateTime $older)
    {
        $this->older = $older;

        return $this;
    }

    /**
     * Gets the value of newer.
     *
     * @return mixed
     */
    public function getNewer()
    {
        return $this->newer;
    }

    /**
     * @param \DateTime $newer the newer
     *
     * @return this
     */
    public function setNewer(\DateTime $newer)
    {
        $this->newer = $newer;

        return $this;
    }
}