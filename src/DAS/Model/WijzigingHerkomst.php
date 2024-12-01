<?php

namespace Bigtree\InfoPlus\DAS\Model;

class WijzigingHerkomst
{
    /**
     * @var string
     */
    private $wijzigingType;

    /**
     * @var string
     */
    private $wijzigingOorzaakKort;

    /**
     * @var string
     */
    private $wijzigingOorzaakLang;

    /**
     * @var Station[]
     */
    private $wijzigingenStationHerkomst;

    /**
     * @var string
     */
    private $tvvOmschrijving;

    /**
     * Get the value of wijzigingType
     *
     * @return string
     */
    public function getWijzigingType()
    {
        return $this->wijzigingType;
    }

    /**
     * Set the value of wijzigingType
     *
     * @param string $wijzigingType
     * @return self
     */
    public function setWijzigingType($wijzigingType)
    {
        $this->wijzigingType = $wijzigingType;
        return $this;
    }

    /**
     * Get the value of wijzigingOorzaakKort
     *
     * @return string
     */
    public function getWijzigingOorzaakKort()
    {
        return $this->wijzigingOorzaakKort;
    }

    /**
     * Set the value of wijzigingOorzaakKort
     *
     * @param string $wijzigingOorzaakKort
     * @return self
     */
    public function setWijzigingOorzaakKort($wijzigingOorzaakKort)
    {
        $this->wijzigingOorzaakKort = $wijzigingOorzaakKort;
        return $this;
    }

    /**
     * Get the value of wijzigingOorzaakLang
     *
     * @return string
     */
    public function getWijzigingOorzaakLang()
    {
        return $this->wijzigingOorzaakLang;
    }

    /**
     * Set the value of wijzigingOorzaakLang
     *
     * @param string $wijzigingOorzaakLang
     * @return self
     */
    public function setWijzigingOorzaakLang($wijzigingOorzaakLang)
    {
        $this->wijzigingOorzaakLang = $wijzigingOorzaakLang;
        return $this;
    }

    /**
     * Get the value of wijzigingenStationHerkomst
     *
     * @return Station[]
     */
    public function getWijzigingenStationHerkomst()
    {
        return $this->wijzigingenStationHerkomst;
    }

    /**
     * Set the value of wijzigingenStationHerkomst
     *
     * @param Station[] $wijzigingenStationHerkomst
     * @return self
     */
    public function setWijzigingenStationHerkomst($wijzigingenStationHerkomst)
    {
        $this->wijzigingenStationHerkomst = $wijzigingenStationHerkomst;
        return $this;
    }

    /**
     * Get the value of tvvOmschrijving
     *
     * @return string
     */
    public function getTvvOmschrijving()
    {
        return $this->tvvOmschrijving;
    }

    /**
     * Set the value of tvvOmschrijving
     *
     * @param string $tvvOmschrijving
     * @return self
     */
    public function setTvvOmschrijving($tvvOmschrijving)
    {
        $this->tvvOmschrijving = $tvvOmschrijving;
        return $this;
    }
}
