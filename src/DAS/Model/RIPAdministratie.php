<?php

namespace Bigtree\InfoPlus\DAS\Model;

class RIPAdministratie
{
    /**
     * @var string
     */
    private $reisInformatieProductID;

    /**
     * @var string
     */
    private $abonnementId;

    /**
     * @var \DateTime
     */
    private $reisInformatieTijdstip;

    /**
     * Get the value of reisInformatieProductID
     *
     * @return string
     */
    public function getReisInformatieProductID()
    {
        return $this->reisInformatieProductID;
    }

    /**
     * Set the value of reisInformatieProductID
     *
     * @param string $reisInformatieProductID
     * @return self
     */
    public function setReisInformatieProductID($reisInformatieProductID)
    {
        $this->reisInformatieProductID = $reisInformatieProductID;
        return $this;
    }

    /**
     * Get the value of abonnementId
     *
     * @return string
     */
    public function getAbonnementId()
    {
        return $this->abonnementId;
    }

    /**
     * Set the value of abonnementId
     *
     * @param string $abonnementId
     * @return self
     */
    public function setAbonnementId($abonnementId)
    {
        $this->abonnementId = $abonnementId;
        return $this;
    }

    /**
     * Get the value of reisInformatieTijdstip
     *
     * @return \DateTime
     */
    public function getReisInformatieTijdstip()
    {
        return $this->reisInformatieTijdstip;
    }

    /**
     * Set the value of reisInformatieTijdstip
     *
     * @param \DateTime $reisInformatieTijdstip
     * @return self
     */
    public function setReisInformatieTijdstip($reisInformatieTijdstip)
    {
        $this->reisInformatieTijdstip = $reisInformatieTijdstip;
        return $this;
    }
}
