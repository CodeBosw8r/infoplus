<?php

namespace Bigtree\InfoPlus\DAS\Model;

class Uiting
{

    /**
     * @var string
     */
    private $taal;

    /**
     * @var string
     */
    private $uiting;

    /**
     * Get the value of taal
     *
     * @return string
     */
    public function getTaal()
    {
        return $this->taal;
    }

    /**
     * Set the value of taal
     *
     * @param string $taal
     * @return self
     */
    public function setTaal($taal)
    {
        $this->taal = $taal;
        return $this;
    }

    /**
     * Get the value of uiting
     *
     * @return string
     */
    public function getUiting()
    {
        return $this->uiting;
    }

    /**
     * Set the value of uiting
     *
     * @param string $uiting
     * @return self
     */
    public function setUiting($uiting)
    {
        $this->uiting = $uiting;
        return $this;
    }
}
