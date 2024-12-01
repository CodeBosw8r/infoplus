<?php

namespace Bigtree\InfoPlus\DAS\Model;

class Spoor
{
    /**
     * @var string
     */
    private $spoorNummer;

    /**
     * @var string
     */
    private $spoorFase;

    /**
     * Get the value of spoorNummer
     *
     * @return string
     */
    public function getSpoorNummer()
    {
        return $this->spoorNummer;
    }

    /**
     * Set the value of spoorNummer
     *
     * @param string $spoorNummer
     * @return self
     */
    public function setSpoorNummer($spoorNummer)
    {
        $this->spoorNummer = $spoorNummer;
        return $this;
    }

    /**
     * Get the value of spoorFase
     *
     * @return string
     */
    public function getSpoorFase()
    {
        return $this->spoorFase;
    }

    /**
     * Set the value of spoorFase
     *
     * @param string $spoorFase
     * @return self
     */
    public function setSpoorFase($spoorFase)
    {
        $this->spoorFase = $spoorFase;
        return $this;
    }
}
