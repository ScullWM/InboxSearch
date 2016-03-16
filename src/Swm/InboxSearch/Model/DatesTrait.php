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
     * @param mixed $after the after
     *
     * @return this
     */
    public function setAfter($after)
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
     * @param mixed $before the before
     *
     * @return this
     */
    public function setBefore($before)
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
     * @param mixed $older the older
     *
     * @return this
     */
    public function setOlder($older)
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
     * @param mixed $newer the newer
     *
     * @return this
     */
    public function setNewer($newer)
    {
        $this->newer = $newer;

        return $this;
    }
}