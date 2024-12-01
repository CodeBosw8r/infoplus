<?php

namespace Bigtree\InfoPlus\DAS\Model;

class Station
{
    /**
     * @var string
     */
    private $stationCode;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $korteNaam;

    /**
     * @var string
     */
    private $middelNaam;

    /**
     * @var string
     */
    private $langeNaam;

    /**
     * @var string
     */
    private $uicCode;

    /**
     * Get the value of stationCode
     *
     * @return string
     */
    public function getStationCode()
    {
        return $this->stationCode;
    }

    /**
     * Set the value of stationCode
     *
     * @param string $stationCode
     * @return self
     */
    public function setStationCode($stationCode)
    {
        $this->stationCode = $stationCode;
        return $this;
    }

    /**
     * Get the value of type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the value of korteNaam
     *
     * @return string
     */
    public function getKorteNaam()
    {
        return $this->korteNaam;
    }

    /**
     * Set the value of korteNaam
     *
     * @param string $korteNaam
     * @return self
     */
    public function setKorteNaam($korteNaam)
    {
        $this->korteNaam = $korteNaam;
        return $this;
    }

    /**
     * Get the value of middelNaam
     *
     * @return string
     */
    public function getMiddelNaam()
    {
        return $this->middelNaam;
    }

    /**
     * Set the value of middelNaam
     *
     * @param string $middelNaam
     * @return self
     */
    public function setMiddelNaam($middelNaam)
    {
        $this->middelNaam = $middelNaam;
        return $this;
    }

    /**
     * Get the value of langeNaam
     *
     * @return string
     */
    public function getLangeNaam()
    {
        return $this->langeNaam;
    }

    /**
     * Set the value of langeNaam
     *
     * @param string $langeNaam
     * @return self
     */
    public function setLangeNaam($langeNaam)
    {
        $this->langeNaam = $langeNaam;
        return $this;
    }

    /**
     * Get the value of uicCode
     *
     * @return string
     */
    public function getUicCode()
    {
        return $this->uicCode;
    }

    /**
     * Set the value of uicCode
     *
     * @param string $uicCode
     * @return self
     */
    public function setUicCode($uicCode)
    {
        $this->uicCode = $uicCode;
        return $this;
    }
}
