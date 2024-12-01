<?php

namespace Bigtree\InfoPlus\DAS\Model;

class DynamischeAankomstStaat
{
    /**
     * @var string
     */
    private $ritId;

    /**
     * @var \DateTime
     */
    private $ritDatum;

    /**
     * @var Station
     */
    private $ritStation;

    /**
     * @var TreinAankomst
     */
    private $treinAankomst;

    /**
     * @var Uiting[]
     */
    private $presentatieOpmerkingen;

    /**
     * Get the value of ritId
     *
     * @return string
     */
    public function getRitId()
    {
        return $this->ritId;
    }

    /**
     * Set the value of ritId
     *
     * @param string $ritId
     * @return self
     */
    public function setRitId($ritId)
    {
        $this->ritId = $ritId;
        return $this;
    }

    /**
     * Get the value of ritDatum
     *
     * @return \DateTime
     */
    public function getRitDatum()
    {
        return $this->ritDatum;
    }

    /**
     * Set the value of ritDatum
     *
     * @param \DateTime $ritDatum
     * @return self
     */
    public function setRitDatum($ritDatum)
    {
        $this->ritDatum = $ritDatum;
        return $this;
    }

    /**
     * Get the value of ritStation
     *
     * @return Station
     */
    public function getRitStation()
    {
        return $this->ritStation;
    }

    /**
     * Set the value of ritStation
     *
     * @param Station $ritStation
     * @return self
     */
    public function setRitStation($ritStation)
    {
        $this->ritStation = $ritStation;
        return $this;
    }

    /**
     * Get the value of treinAankomst
     *
     * @return TreinAankomst
     */
    public function getTreinAankomst()
    {
        return $this->treinAankomst;
    }

    /**
     * Set the value of treinAankomst
     *
     * @param TreinAankomst $treinAankomst
     * @return self
     */
    public function setTreinAankomst($treinAankomst)
    {
        $this->treinAankomst = $treinAankomst;
        return $this;
    }

    /**
     * Get the value of presentatieOpmerkingen
     *
     * @return Uiting[]
     */
    public function getPresentatieOpmerkingen()
    {
        return $this->presentatieOpmerkingen;
    }

    /**
     * Set the value of presentatieOpmerkingen
     *
     * @param Uiting[] $presentatieOpmerkingen
     * @return self
     */
    public function setPresentatieOpmerkingen($presentatieOpmerkingen)
    {
        $this->presentatieOpmerkingen = $presentatieOpmerkingen;
        return $this;
    }
}
