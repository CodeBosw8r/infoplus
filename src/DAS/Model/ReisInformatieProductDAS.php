<?php

namespace Bigtree\InfoPlus\DAS\Model;

class ReisInformatieProductDAS
{

    /**
     * @var string
     */
    private $versie;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var RIPAdministratie
     */
    private $ripAdministratie;

    /**
     * @var DynamischeAankomstStaat
     */
    private $dynamischeAankomstStaat;

    /**
     * Get the value of versie
     *
     * @return string
     */
    public function getVersie()
    {
        return $this->versie;
    }

    /**
     * Set the value of versie
     *
     * @param string $versie
     * @return self
     */
    public function setVersie($versie)
    {
        $this->versie = $versie;
        return $this;
    }

    /**
     * Get the value of timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @param \DateTime $timestamp
     * @return self
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Get the value of ripAdministratie
     *
     * @return RIPAdministratie
     */
    public function getRipAdministratie()
    {
        return $this->ripAdministratie;
    }

    /**
     * Set the value of ripAdministratie
     *
     * @param RIPAdministratie $ripAdministratie
     * @return self
     */
    public function setRipAdministratie($ripAdministratie)
    {
        $this->ripAdministratie = $ripAdministratie;
        return $this;
    }

    /**
     * Get the value of dynamischeAankomstStaat
     *
     * @return DynamischeAankomstStaat
     */
    public function getDynamischeAankomstStaat()
    {
        return $this->dynamischeAankomstStaat;
    }

    /**
     * Set the value of dynamischeAankomstStaat
     *
     * @param DynamischeAankomstStaat $dynamischeAankomstStaat
     * @return self
     */
    public function setDynamischeAankomstStaat($dynamischeAankomstStaat)
    {
        $this->dynamischeAankomstStaat = $dynamischeAankomstStaat;
        return $this;
    }
}
