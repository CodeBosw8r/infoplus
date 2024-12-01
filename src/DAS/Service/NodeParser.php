<?php

namespace Bigtree\InfoPlus\DAS\Service;

use Bigtree\InfoPlus\DAS\Model\DynamischeAankomstStaat;
use Bigtree\InfoPlus\DAS\Model\ReisInformatieProductDAS;
use Bigtree\InfoPlus\DAS\Model\RIPAdministratie;
use Bigtree\InfoPlus\DAS\Model\Spoor;
use Bigtree\InfoPlus\DAS\Model\Station;
use Bigtree\InfoPlus\DAS\Model\TreinAankomst;
use Bigtree\InfoPlus\DAS\Model\Uiting;
use Bigtree\InfoPlus\DAS\Model\WijzigingHerkomst;
use Bigtree\InfoPlus\Service\AbstractParser;

class NodeParser extends AbstractParser
{

    /**
     * @param \DOMElement $element
     * @return ReisInformatieProductDAS
     */
    public function parseReisInformatieProductDASElement($element)
    {

        $das = new ReisInformatieProductDAS();

        $das->setVersie($element->getAttribute('Versie'));
        $timestamp = $element->getAttribute('TimeStamp');
        if ($timestamp) {
            $das->setTimestamp(new \DateTime($timestamp));
        }

        $ripAdministratieElement = $this->getChildNodeByName($element, 'RIPAdministratie');
        if ($ripAdministratieElement) {
            $das->setRIPAdministratie($this->parseRIPAdministratieNode($ripAdministratieElement));
        }

        $dynamischeAankomstStaatElement = $this->getChildNodeByName($element, 'DynamischeAankomstStaat');
        if ($dynamischeAankomstStaatElement) {
            $das->setDynamischeAankomstStaat($this->parseDynamischeAankomstStaatNode($dynamischeAankomstStaatElement));
        }

        return $das;
    }

    /**
     * @param \DOMElement $element
     * @return RIPAdministratie
     */
    public function parseRIPAdministratieNode(\DOMElement $element)
    {

        $ripAdministratie = new RIPAdministratie();

        $ripAdministratie->setReisInformatieProductID($this->getChildNodeValueByName($element, 'ReisInformatieProductID'));
        $ripAdministratie->setAbonnementId($this->getChildNodeValueByName($element, 'AbonnementId'));

        $tijdstip = $this->getChildNodeValueByName($element, 'ReisInformatieTijdstip');
        if ($tijdstip) {
            $ripAdministratie->setReisInformatieTijdstip(new \DateTime($tijdstip));
        }

        return $ripAdministratie;
    }

    /**
     * @param \DOMElement $element
     * @return DynamischeAankomstStaat
     */
    public function parseDynamischeAankomstStaatNode(\DOMElement $element)
    {
        $dynamischeAankomstStaat = new DynamischeAankomstStaat();

        $dynamischeAankomstStaat->setRitId($this->getChildNodeValueByName($element, 'RitId'));
        $ritDatum = $this->getChildNodeValueByName($element, 'RitDatum');
        if ($ritDatum) {
            $dynamischeAankomstStaat->setRitDatum(new \DateTime($ritDatum));
        }

        $ritStationElement = $this->getChildNodeByName($element, 'RitStation');
        if ($ritStationElement) {
            $dynamischeAankomstStaat->setRitStation($this->parseStationNode($ritStationElement));
        }

        $treinAankomstElement = $this->getChildNodeByName($element, 'TreinAankomst');
        if ($treinAankomstElement) {
            $dynamischeAankomstStaat->setTreinAankomst($this->parseTreinAankomstNode($treinAankomstElement));
        }

        return $dynamischeAankomstStaat;
    }

    /**
     * @param \DOMElement $element
     * @return Station
     */
    public function parseStationNode(\DOMElement $element)
    {
        $ritStation = new Station();

        $ritStation->setStationCode($this->getChildNodeValueByName($element, 'StationCode'));
        $ritStation->setType($this->getChildNodeValueByName($element, 'Type'));
        $ritStation->setKorteNaam($this->getChildNodeValueByName($element, 'KorteNaam'));
        $ritStation->setMiddelNaam($this->getChildNodeValueByName($element, 'MiddelNaam'));
        $ritStation->setLangeNaam($this->getChildNodeValueByName($element, 'LangeNaam'));
        $ritStation->setUICCode($this->getChildNodeValueByName($element, 'UICCode'));

        return $ritStation;
    }

    /**
     * @param \DOMElement $element
     * @return TreinAankomst
     */
    public function parseTreinAankomstNode(\DOMElement $element)
    {

        $treinAankomst = new TreinAankomst();

        $treinAankomst->setTreinNummer($this->getChildNodeValueByName($element, 'TreinNummer'));

        $treinsoortNode = $this->getChildNodeByName($element, 'TreinSoort');
        if ($treinsoortNode) {
            $treinAankomst->setTreinSoortCode($treinsoortNode->getAttribute('Code'));
            $treinAankomst->setTreinSoort($treinsoortNode->nodeValue);
        }

        $treinAankomst->setTreinStatus($this->getChildNodeValueByName($element, 'TreinStatus'));
        $treinAankomst->setVervoerder($this->getChildNodeValueByName($element, 'Vervoerder'));

        $treinherkomstNodes = $this->getChildNodesByName($element, 'TreinHerkomst');
        if ($treinherkomstNodes) {

            foreach ($treinherkomstNodes as $treinherkomstNode) {

                $infoStatus = $treinherkomstNode->getAttribute('InfoStatus');

                if (($infoStatus == 'Actueel') || ($infoStatus == 'Gepland')) {

                    $treinHerkomst = $this->parseStationNode($treinherkomstNode);

                    if ($treinHerkomst) {
                        if ($infoStatus == 'Actueel') {
                            $treinAankomst->setTreinHerkomstActueel($treinHerkomst);
                        } else {
                            $treinAankomst->setTreinHerkomstGepland($treinHerkomst);
                        }
                    }
                }
            }
        }

        $presentatieHerkomstNode = $this->getChildNodeByName($element, 'PresentatieTreinHerkomst');
        if ($presentatieHerkomstNode) {

            $uitingen = $this->parseUitingen($presentatieHerkomstNode);

            if ($uitingen) {
                $treinAankomst->setPresentatieTreinHerkomst($uitingen);
            }
        }

        $aankomstTijdNodes = $this->getChildNodesByName($element, 'AankomstTijd');

        if ($aankomstTijdNodes) {

            foreach ($aankomstTijdNodes as $aankomstTijdNode) {

                $infoStatus = $aankomstTijdNode->getAttribute('InfoStatus');

                if (($infoStatus == 'Actueel') || ($infoStatus == 'Gepland')) {

                    $aankomstTijd = new \DateTime($aankomstTijdNode->nodeValue);

                    if ($aankomstTijd) {
                        if ($infoStatus == 'Actueel') {
                            $treinAankomst->setAankomstTijdActueel($aankomstTijd);
                        } else {
                            $treinAankomst->setAankomstTijdGepland($aankomstTijd);
                        }
                    }
                }
            }
        }

        $treinAankomst->setExacteAankomstVertraging($this->getChildNodeValueByName($element, 'ExacteAankomstVertraging'));

        $presentatieAankomstVertragingNode = $this->getChildNodeByName($element, 'PresentatieAankomstVertraging');

        if ($presentatieAankomstVertragingNode) {
            $uitingen = $this->parseUitingen($presentatieAankomstVertragingNode);
            if ($uitingen) {
                $treinAankomst->setPresentatieAankomstVertraging($uitingen);
            }
        }

        $treinAankomst->setGedempteAankomstVertraging($this->getChildNodeValueByName($element, 'GedempteAankomstVertraging'));

        $treinAankomstSpoorNodes = $this->getChildNodesByName($element, 'TreinAankomstSpoor');
        if ($treinAankomstSpoorNodes) {
            foreach ($treinAankomstSpoorNodes as $treinAankomstSpoorNode) {
                $infoStatus = $treinAankomstSpoorNode->getAttribute('InfoStatus');
                if (($infoStatus == 'Actueel') || ($infoStatus == 'Gepland')) {
                    $spoor = $this->parseSpoorNode($treinAankomstSpoorNode);

                    if ($spoor) {
                        if ($infoStatus == 'Actueel') {
                            $treinAankomst->setTreinAankomstSpoorActueel($spoor);
                        } else {
                            $treinAankomst->setTreinAankomstSpoorGepland($spoor);
                        }
                    }
                }
            }
        }

        $presentatieTreinAankomstSpoorNode = $this->getChildNodeByName($element, 'PresentatieTreinAankomstSpoor');
        if ($presentatieTreinAankomstSpoorNode) {
            $uitingen = $this->parseUitingen($presentatieTreinAankomstSpoorNode);
            if ($uitingen) {
                $treinAankomst->setPresentatieTreinAankomstSporen($uitingen);
            }
        }

        $verkorteRouteHerkomstNodes = $this->getChildNodesByName($element, 'VerkorteRouteHerkomst');
        if ($verkorteRouteHerkomstNodes) {

            foreach ($verkorteRouteHerkomstNodes as $verkorteRouteHerkomstNode) {

                $infoStatus = $verkorteRouteHerkomstNode->getAttribute('InfoStatus');

                if (($infoStatus == 'Actueel') || ($infoStatus == 'Gepland')) {

                    $stations = $this->parseStationNodes($verkorteRouteHerkomstNode);

                    if ($stations) {
                        if ($infoStatus == 'Actueel') {
                            $treinAankomst->setVerkorteRouteHerkomstActueel($stations);
                        } else {
                            $treinAankomst->setVerkorteRouteHerkomstGepland($stations);
                        }
                    }
                }
            }
        }

        $presentatieVerkorteRouteHerkomstNode = $this->getChildNodeByName($element, 'PresentatieVerkorteRouteHerkomst');
        if ($presentatieVerkorteRouteHerkomstNode) {
            $uitingen = $this->parseUitingen($presentatieVerkorteRouteHerkomstNode);
            if ($uitingen) {
                $treinAankomst->setPresentatieVerkorteRouteHerkomst($uitingen);
            }
        }

        $wijzigingHerkomstNodes = $this->getChildNodesByName($element, 'WijzigingHerkomst');
        if ($wijzigingHerkomstNodes) {
            $wijzigingen = [];
            foreach ($wijzigingHerkomstNodes as $wijzigingHerkomstNode) {
                $wijziging = new WijzigingHerkomst();
                $wijziging->setWijzigingType($this->getChildNodeValueByName($wijzigingHerkomstNode, 'WijzigingType'));
                $wijziging->setWijzigingOorzaakKort($this->getChildNodeValueByName($wijzigingHerkomstNode, 'WijzigingOorzaakKort'));
                $wijziging->setWijzigingOorzaakLang($this->getChildNodeValueByName($wijzigingHerkomstNode, 'WijzigingOorzaakLang'));

                $wijzigingStationNode = $this->getChildNodeByName($wijzigingHerkomstNode, 'WijzigingStation');
                if ($wijzigingStationNode) {
                    $wijziging->setWijzigingenStationHerkomst($this->parseStationNode($wijzigingStationNode));
                }

                $wijziging->setTvvOmschrijving($this->getChildNodeValueByName($wijzigingHerkomstNode, 'TVVOmschrijving'));

                $wijzigingen[] = $wijziging;
            }

            if ($wijzigingen) {
                $treinAankomst->setWijzigingenHerkomst($wijzigingen);
            }
        }

        return $treinAankomst;
    }

    public function parseUitingen($element)
    {
        $uitingen = [];

        $uitingenNodes = $this->getChildNodesByName($element, 'Uitingen');

        if ($uitingenNodes) {
            foreach ($uitingenNodes as $uitingenNode) {

                $taal = $uitingenNode->getAttribute('Taal');

                $uitingNodes = $this->getChildNodesByName($uitingenNode, 'Uiting');

                if ($uitingNodes) {

                    foreach ($uitingNodes as $uitingNode) {
                        $uiting = new Uiting();
                        if ($taal) {
                            $uiting->setTaal($taal);
                        }
                        $uiting->setUiting($uitingNode->nodeValue);
                        $uitingen[] = $uiting;
                    }
                }
            }
        }
        return $uitingen;
    }

    /**
     * @param \DOMElement $element
     * @return Spoor
     */
    public function parseSpoorNode($element)
    {
        $spoor = new Spoor();

        $spoor->setSpoorNummer($this->getChildNodeValueByName($element, 'SpoorNummer'));
        $spoor->setSpoorFase($this->getChildNodeValueByName($element, 'SpoorFase'));

        return $spoor;
    }

    /**
     * @param \DOMElement $element
     * @return Station[]
     */
    public function parseStationNodes($element)
    {
        $stations = [];

        $stationNodes = $this->getChildNodesByName($element, 'Station');

        if ($stationNodes) {
            foreach ($stationNodes as $stationNode) {
                $station = $this->parseStationNode($stationNode);
                if ($station) {
                    $stations[] = $station;
                }
            }
        }

        return $stations;
    }
}
