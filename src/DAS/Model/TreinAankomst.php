<?php

namespace Bigtree\InfoPlus\DAS\Model;

class TreinAankomst
{
    /**
     * @var string
     */
    private $treinNummer;

    /**
     * @var string
     */
    private $treinNaam;

    /**
     * @var string
     */
    private $treinSoortCode;

    /**
     * @var string
     */
    private $treinSoort;

    /**
     * @var string
     */
    private $treinStatus;

    /**
     * @var string
     */
    private $vervoerder;

    /**
     * @var Station
     */
    private $treinHerkomstGepland;

    /**
     * @var Station
     */
    private $treinHerkomstActueel;

    /**
     * @var Uiting[]
     */
    private $presentatieTreinHerkomst;

    /**
     * @var \DateTime
     */
    private $aankomsttijdActueel;

    /**
     * @var \DateTime
     */
    private $aankomsttijdGepland;

    /**
     * @var string
     */
    private $exacteAankomstVertraging;

    /**
     * @var Uiting[]
     */
    private $presentatieAankomstVertraging;

    /**
     * @var string
     */
    private $gedempteAankomstVertraging;

    /**
     * @var Spoor
     */
    private $treinAankomstSpoorGepland;

    /**
     * @var Spoor
     */
    private $treinAankomstSpoorActueel;

    /**
     * @var Uiting[]
     */
    private $presentatieTreinAankomstSporen;

    /**
     * @var Station[]
     */
    private $verkorteRouteHerkomstGepland;

    /**
     * @var Station[]
     */
    private $verkorteRouteHerkomstActueel;

    /**
     * @var Uiting[]
     */
    private $presentatieVerkorteRouteHerkomst;

    /**
     * @var WijzigingHerkomst[]
     */
    private $wijzigingenHerkomst;

    /**
     * Get the value of treinNummer
     *
     * @return string
     */
    public function getTreinNummer()
    {
        return $this->treinNummer;
    }

    /**
     * Set the value of treinNummer
     *
     * @param string $treinNummer
     * @return self
     */
    public function setTreinNummer($treinNummer)
    {
        $this->treinNummer = $treinNummer;
        return $this;
    }

    /**
     * Get the value of treinNaam
     *
     * @return string
     */
    public function getTreinNaam()
    {
        return $this->treinNaam;
    }

    /**
     * Set the value of treinNaam
     *
     * @param string $treinNaam
     * @return self
     */
    public function setTreinNaam($treinNaam)
    {
        $this->treinNaam = $treinNaam;
        return $this;
    }

    /**
     * Get the value of treinSoortCode
     *
     * @return string
     */
    public function getTreinSoortCode()
    {
        return $this->treinSoortCode;
    }

    /**
     * Set the value of treinSoortCode
     *
     * @param string $treinSoortCode
     * @return self
     */
    public function setTreinSoortCode($treinSoortCode)
    {
        $this->treinSoortCode = $treinSoortCode;
        return $this;
    }

    /**
     * Get the value of treinSoort
     *
     * @return string
     */
    public function getTreinSoort()
    {
        return $this->treinSoort;
    }

    /**
     * Set the value of treinSoort
     *
     * @param string $treinSoort
     * @return self
     */
    public function setTreinSoort($treinSoort)
    {
        $this->treinSoort = $treinSoort;
        return $this;
    }

    /**
     * Get the value of treinStatus
     *
     * @return string
     */
    public function getTreinStatus()
    {
        return $this->treinStatus;
    }

    /**
     * Set the value of treinStatus
     *
     * @param string $treinStatus
     * @return self
     */
    public function setTreinStatus($treinStatus)
    {
        $this->treinStatus = $treinStatus;
        return $this;
    }

    /**
     * Get the value of vervoerder
     *
     * @return string
     */
    public function getVervoerder()
    {
        return $this->vervoerder;
    }

    /**
     * Set the value of vervoerder
     *
     * @param string $vervoerder
     * @return self
     */
    public function setVervoerder($vervoerder)
    {
        $this->vervoerder = $vervoerder;
        return $this;
    }

    /**
     * Get the value of treinHerkomstGepland
     *
     * @return Station
     */
    public function getTreinHerkomstGepland()
    {
        return $this->treinHerkomstGepland;
    }

    /**
     * Set the value of treinHerkomstGepland
     *
     * @param Station $treinHerkomstGepland
     * @return self
     */
    public function setTreinHerkomstGepland($treinHerkomstGepland)
    {
        $this->treinHerkomstGepland = $treinHerkomstGepland;
        return $this;
    }

    /**
     * Get the value of treinHerkomstActueel
     *
     * @return Station
     */
    public function getTreinHerkomstActueel()
    {
        return $this->treinHerkomstActueel;
    }

    /**
     * Set the value of treinHerkomstActueel
     *
     * @param Station $treinHerkomstActueel
     * @return self
     */
    public function setTreinHerkomstActueel($treinHerkomstActueel)
    {
        $this->treinHerkomstActueel = $treinHerkomstActueel;
        return $this;
    }

    /**
     * Get the value of aankomsttijdGepland
     *
     * @return \DateTime
     */
    public function getAankomsttijdGepland()
    {
        return $this->aankomsttijdGepland;
    }

    /**
     * Set the value of aankomsttijdGepland
     *
     * @param \DateTime $aankomsttijdGepland
     * @return self
     */
    public function setAankomsttijdGepland($aankomsttijdGepland)
    {
        $this->aankomsttijdGepland = $aankomsttijdGepland;
        return $this;
    }

    /**
     * Get the value of exacteAankomstVertraging
     *
     * @return string
     */
    public function getExacteAankomstVertraging()
    {
        return $this->exacteAankomstVertraging;
    }

    /**
     * Set the value of exacteAankomstVertraging
     *
     * @param string $exacteAankomstVertraging
     * @return self
     */
    public function setExacteAankomstVertraging($exacteAankomstVertraging)
    {
        $this->exacteAankomstVertraging = $exacteAankomstVertraging;
        return $this;
    }

    /**
     * Get the value of presentatieAankomstVertraging
     *
     * @return Uiting[]
     */
    public function getPresentatieAankomstVertraging()
    {
        return $this->presentatieAankomstVertraging;
    }

    /**
     * Set the value of presentatieAankomstVertraging
     *
     * @param Uiting[] $presentatieAankomstVertraging
     * @return self
     */
    public function setPresentatieAankomstVertraging($presentatieAankomstVertraging)
    {
        $this->presentatieAankomstVertraging = $presentatieAankomstVertraging;
        return $this;
    }

    /**
     * Get the value of gedempteAankomstVertraging
     *
     * @return string
     */
    public function getGedempteAankomstVertraging()
    {
        return $this->gedempteAankomstVertraging;
    }

    /**
     * Set the value of gedempteAankomstVertraging
     *
     * @param string $gedempteAankomstVertraging
     * @return self
     */
    public function setGedempteAankomstVertraging($gedempteAankomstVertraging)
    {
        $this->gedempteAankomstVertraging = $gedempteAankomstVertraging;
        return $this;
    }

    /**
     * Get the value of treinAankomstSpoorGepland
     *
     * @return Spoor
     */
    public function getTreinAankomstSpoorGepland()
    {
        return $this->treinAankomstSpoorGepland;
    }

    /**
     * Set the value of treinAankomstSpoorGepland
     *
     * @param Spoor $treinAankomstSpoorGepland
     * @return self
     */
    public function setTreinAankomstSpoorGepland($treinAankomstSpoorGepland)
    {
        $this->treinAankomstSpoorGepland = $treinAankomstSpoorGepland;
        return $this;
    }

    /**
     * Get the value of treinAankomstSpoorActueel
     *
     * @return Spoor
     */
    public function getTreinAankomstSpoorActueel()
    {
        return $this->treinAankomstSpoorActueel;
    }

    /**
     * Set the value of treinAankomstSpoorActueel
     *
     * @param Spoor $treinAankomstSpoorActueel
     * @return self
     */
    public function setTreinAankomstSpoorActueel($treinAankomstSpoorActueel)
    {
        $this->treinAankomstSpoorActueel = $treinAankomstSpoorActueel;
        return $this;
    }

    /**
     * Get the value of presentatieTreinHerkomst
     *
     * @return Uiting[]
     */
    public function getPresentatieTreinHerkomst()
    {
        return $this->presentatieTreinHerkomst;
    }

    /**
     * Set the value of presentatieTreinHerkomst
     *
     * @param Uiting[] $presentatieTreinHerkomst
     * @return self
     */
    public function setPresentatieTreinHerkomst($presentatieTreinHerkomst)
    {
        $this->presentatieTreinHerkomst = $presentatieTreinHerkomst;
        return $this;
    }

    /**
     * Get the value of aankomsttijdActueel
     *
     * @return \DateTime
     */
    public function getAankomsttijdActueel()
    {
        return $this->aankomsttijdActueel;
    }

    /**
     * Set the value of aankomsttijdActueel
     *
     * @param \DateTime $aankomsttijdActueel
     * @return self
     */
    public function setAankomsttijdActueel($aankomsttijdActueel)
    {
        $this->aankomsttijdActueel = $aankomsttijdActueel;
        return $this;
    }

    /**
     * Get the value of presentatieTreinAankomstSporen
     *
     * @return Uiting[]
     */
    public function getPresentatieTreinAankomstSporen()
    {
        return $this->presentatieTreinAankomstSporen;
    }

    /**
     * Set the value of presentatieTreinAankomstSporen
     *
     * @param Uiting[] $presentatieTreinAankomstSporen
     * @return self
     */
    public function setPresentatieTreinAankomstSporen($presentatieTreinAankomstSporen)
    {
        $this->presentatieTreinAankomstSporen = $presentatieTreinAankomstSporen;
        return $this;
    }

    /**
     * Get the value of verkorteRouteHerkomstGepland
     *
     * @return Station[]
     */
    public function getVerkorteRouteHerkomstGepland()
    {
        return $this->verkorteRouteHerkomstGepland;
    }

    /**
     * Set the value of verkorteRouteHerkomstGepland
     *
     * @param Station[] $verkorteRouteHerkomstGepland
     * @return self
     */
    public function setVerkorteRouteHerkomstGepland($verkorteRouteHerkomstGepland)
    {
        $this->verkorteRouteHerkomstGepland = $verkorteRouteHerkomstGepland;
        return $this;
    }

    /**
     * Get the value of verkorteRouteHerkomstActueel
     *
     * @return Station[]
     */
    public function getVerkorteRouteHerkomstActueel()
    {
        return $this->verkorteRouteHerkomstActueel;
    }

    /**
     * Set the value of verkorteRouteHerkomstActueel
     *
     * @param Station[] $verkorteRouteHerkomstActueel
     * @return self
     */
    public function setVerkorteRouteHerkomstActueel($verkorteRouteHerkomstActueel)
    {
        $this->verkorteRouteHerkomstActueel = $verkorteRouteHerkomstActueel;
        return $this;
    }

    /**
     * Get the value of presentatieVerkorteRouteHerkomst
     *
     * @return Uiting[]
     */
    public function getPresentatieVerkorteRouteHerkomst()
    {
        return $this->presentatieVerkorteRouteHerkomst;
    }

    /**
     * Set the value of presentatieVerkorteRouteHerkomst
     *
     * @param Uiting[] $presentatieVerkorteRouteHerkomst
     * @return self
     */
    public function setPresentatieVerkorteRouteHerkomst($presentatieVerkorteRouteHerkomst)
    {
        $this->presentatieVerkorteRouteHerkomst = $presentatieVerkorteRouteHerkomst;
        return $this;
    }

    /**
     * Get the value of wijzigingenHerkomst
     *
     * @return WijzigingHerkomst[]
     */
    public function getWijzigingenHerkomst()
    {
        return $this->wijzigingenHerkomst;
    }

    /**
     * Set the value of wijzigingenHerkomst
     *
     * @param WijzigingHerkomst[] $wijzigingenHerkomst
     * @return self
     */
    public function setWijzigingenHerkomst($wijzigingenHerkomst)
    {
        $this->wijzigingenHerkomst = $wijzigingenHerkomst;
        return $this;
    }
}
