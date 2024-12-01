<?php

/**
 * @license MIT
 * @author Erik Hoogeboom
 */

use Bigtree\InfoPlus\DAS\Service\NodeParser;
use PHPUnit\Framework\TestCase;

class DasNodeParserTest extends TestCase
{
    public function loadXml($file)
    {
        $testsDir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
        $testFilesDir = $testsDir . 'testfiles' . DIRECTORY_SEPARATOR;
        $xml = file_get_contents($testFilesDir . $file);
        $dom = new \DOMDocument();
        $dom->loadXML($xml);
        return $dom;
    }

    public function testParseReisInformatieProductDasElement20241128Rit9053Mp()
    {
        $doc = $this->loadXml('das-2024-11-28-9053-MP.xml');
        $this->assertNotNull($doc);

        $dasNode = $doc->getElementsByTagName('ReisInformatieProductDAS')->item(0);
        $this->assertNotNull($dasNode);

        $parser = new NodeParser();
        $parsed = $parser->parseReisInformatieProductDASElement($dasNode);

        $this->assertNotNull($parsed);

        $this->assertEquals('6.1', $parsed->getVersie());
        $timestamp = $parsed->getTimestamp();
        $this->assertNotNull($timestamp);
        $this->assertEquals('2024-11-28T15:15:52+00:00', $timestamp->format('c'));

        $ripAdministratie = $parsed->getRIPAdministratie();
        $this->assertNotNull($ripAdministratie);

        $this->assertEquals('7333009053435025', $ripAdministratie->getReisInformatieProductID());
        $this->assertEquals('55', $ripAdministratie->getAbonnementId());
        $this->assertEquals('2024-11-28T15:11:00+00:00', $ripAdministratie->getReisInformatieTijdstip()->format('c'));

        $dynamischeAankomstStaat = $parsed->getDynamischeAankomstStaat();
        $this->assertNotNull($dynamischeAankomstStaat);

        $this->assertEquals('9053', $dynamischeAankomstStaat->getRitId());
        $this->assertEquals('2024-11-28', $dynamischeAankomstStaat->getRitDatum()->format('Y-m-d'));

        $ritStation = $dynamischeAankomstStaat->getRitStation();
        $this->assertNotNull($ritStation);

        $this->assertEquals('MP', $ritStation->getStationCode());
        $this->assertEquals('1', $ritStation->getType());
        $this->assertEquals('Meppel', $ritStation->getKorteNaam());
        $this->assertEquals('Meppel', $ritStation->getMiddelNaam());
        $this->assertEquals('Meppel', $ritStation->getLangeNaam());
        $this->assertEquals('8400435', $ritStation->getUICCode());

        $treinAankomst = $dynamischeAankomstStaat->getTreinAankomst();
        $this->assertNotNull($treinAankomst);

        $this->assertEquals('9053', $treinAankomst->getTreinNummer());
        $this->assertEquals('SPR', $treinAankomst->getTreinSoortCode());
        $this->assertEquals('Sprinter', $treinAankomst->getTreinSoort());
        $this->assertEquals('2', $treinAankomst->getTreinStatus());
        $this->assertEquals('NS', $treinAankomst->getVervoerder());

        $treinherkomstGepland = $treinAankomst->getTreinHerkomstGepland();
        $this->assertNotNull($treinherkomstGepland);

        $this->assertEquals('LLS', $treinherkomstGepland->getStationCode());
        $this->assertEquals('5', $treinherkomstGepland->getType());
        $this->assertEquals('Lelystad C', $treinherkomstGepland->getKorteNaam());
        $this->assertEquals('Lelystad C.', $treinherkomstGepland->getMiddelNaam());
        $this->assertEquals('Lelystad Centrum', $treinherkomstGepland->getLangeNaam());
        $this->assertEquals('8400394', $treinherkomstGepland->getUICCode());

        $treinAankomstActueel = $treinAankomst->getTreinHerkomstActueel();
        $this->assertNotNull($treinAankomstActueel);

        $this->assertEquals('LLS', $treinAankomstActueel->getStationCode());
        $this->assertEquals('5', $treinAankomstActueel->getType());
        $this->assertEquals('Lelystad C', $treinAankomstActueel->getKorteNaam());
        $this->assertEquals('Lelystad C.', $treinAankomstActueel->getMiddelNaam());
        $this->assertEquals('Lelystad Centrum', $treinAankomstActueel->getLangeNaam());
        $this->assertEquals('8400394', $treinAankomstActueel->getUICCode());

        $presentatieTreinHerkomst = $treinAankomst->getPresentatieTreinHerkomst();
        $this->assertNotNull($presentatieTreinHerkomst);
        $this->assertCount(1, $presentatieTreinHerkomst);

        $uiting = $presentatieTreinHerkomst[0];
        $this->assertNotNull($uiting);

        $this->assertNull($uiting->getTaal());
        $this->assertEquals('Lelystad C.', $uiting->getUiting());

        $aankomsttijdGepland = $treinAankomst->getAankomstTijdGepland();
        $this->assertNotNull($aankomsttijdGepland);
        $this->assertEquals('2024-11-28T15:11:00+00:00', $aankomsttijdGepland->format('c'));

        $aankomsttijdActueel = $treinAankomst->getAankomstTijdActueel();
        $this->assertNotNull($aankomsttijdActueel);
        $this->assertEquals('2024-11-28T15:16:28+00:00', $aankomsttijdActueel->format('c'));

        $exacteAankomstVertraging = $treinAankomst->getExacteAankomstVertraging();
        $this->assertNotNull($exacteAankomstVertraging);
        $this->assertEquals('PT5M28S', $exacteAankomstVertraging);

        $this->assertEquals('2024-11-28T15:16:28+00:00', $treinAankomst->getAankomstTijdActueel()->format('c'));

        $presentatieAankomstVertraging = $treinAankomst->getPresentatieAankomstVertraging();
        $this->assertNotNull($presentatieAankomstVertraging);
        $this->assertCount(1, $presentatieAankomstVertraging);

        $uiting = $presentatieAankomstVertraging[0];
        $this->assertNotNull($uiting);

        $this->assertNull($uiting->getTaal());
        $this->assertEquals('+5 min.', $uiting->getUiting());

        $gedempteAankomstVertraging = $treinAankomst->getGedempteAankomstVertraging();
        $this->assertNotNull($gedempteAankomstVertraging);
        $this->assertEquals('PT5M', $gedempteAankomstVertraging);

        $treinAankomstSpoorGepland = $treinAankomst->getTreinAankomstSpoorGepland();
        $this->assertNotNull($treinAankomstSpoorGepland);
        $this->assertEquals('3', $treinAankomstSpoorGepland->getSpoorNummer());
        $this->assertEquals(null, $treinAankomstSpoorGepland->getSpoorFase());

        $treinAankomstSpoorActueel = $treinAankomst->getTreinAankomstSpoorActueel();
        $this->assertNotNull($treinAankomstSpoorActueel);
        $this->assertEquals('3', $treinAankomstSpoorActueel->getSpoorNummer());
        $this->assertEquals(null, $treinAankomstSpoorActueel->getSpoorFase());

        $presentatieTreinAankomstSporen = $treinAankomst->getPresentatieTreinAankomstSporen();
        $this->assertNotNull($presentatieTreinAankomstSporen);
        $this->assertCount(2, $presentatieTreinAankomstSporen);

        $uiting = $presentatieTreinAankomstSporen[0];
        $this->assertNotNull($uiting);
        $this->assertEquals('en', $uiting->getTaal());
        $this->assertEquals('3', $uiting->getUiting());

        $uiting = $presentatieTreinAankomstSporen[1];
        $this->assertNotNull($uiting);
        $this->assertEquals('nl', $uiting->getTaal());
        $this->assertEquals('3', $uiting->getUiting());

        $verkorteRouteHerkomstGepland = $treinAankomst->getVerkorteRouteHerkomstGepland();
        $this->assertNotNull($verkorteRouteHerkomstGepland);
        $this->assertCount(3, $verkorteRouteHerkomstGepland);

        $station = $verkorteRouteHerkomstGepland[0];
        $this->assertNotNull($station);
        $this->assertEquals('DRON', $station->getStationCode());
        $this->assertEquals('0', $station->getType());
        $this->assertEquals('Dronten', $station->getKorteNaam());
        $this->assertEquals('Dronten', $station->getMiddelNaam());
        $this->assertEquals('Dronten', $station->getLangeNaam());
        $this->assertEquals('8400198', $station->getUICCode());

        $station = $verkorteRouteHerkomstGepland[1];
        $this->assertNotNull($station);
        $this->assertEquals('KPNZ', $station->getStationCode());
        $this->assertEquals('0', $station->getType());
        $this->assertEquals('Kampen Z', $station->getKorteNaam());
        $this->assertEquals('Kampen Zuid', $station->getMiddelNaam());
        $this->assertEquals('Kampen Zuid', $station->getLangeNaam());
        $this->assertEquals('8400360', $station->getUICCode());

        $station = $verkorteRouteHerkomstGepland[2];
        $this->assertNotNull($station);
        $this->assertEquals('ZL', $station->getStationCode());
        $this->assertEquals('5', $station->getType());
        $this->assertEquals('Zwolle', $station->getKorteNaam());
        $this->assertEquals('Zwolle', $station->getMiddelNaam());
        $this->assertEquals('Zwolle', $station->getLangeNaam());
        $this->assertEquals('8400747', $station->getUICCode());

        $verkorteRouteHerkomstActueel = $treinAankomst->getVerkorteRouteHerkomstActueel();
        $this->assertNotNull($verkorteRouteHerkomstActueel);
        $this->assertCount(3, $verkorteRouteHerkomstActueel);

        $station = $verkorteRouteHerkomstActueel[0];
        $this->assertNotNull($station);
        $this->assertEquals('DRON', $station->getStationCode());
        $this->assertEquals('0', $station->getType());
        $this->assertEquals('Dronten', $station->getKorteNaam());
        $this->assertEquals('Dronten', $station->getMiddelNaam());
        $this->assertEquals('Dronten', $station->getLangeNaam());
        $this->assertEquals('8400198', $station->getUICCode());

        $station = $verkorteRouteHerkomstActueel[1];
        $this->assertNotNull($station);
        $this->assertEquals('KPNZ', $station->getStationCode());
        $this->assertEquals('0', $station->getType());
        $this->assertEquals('Kampen Z', $station->getKorteNaam());
        $this->assertEquals('Kampen Zuid', $station->getMiddelNaam());
        $this->assertEquals('Kampen Zuid', $station->getLangeNaam());
        $this->assertEquals('8400360', $station->getUICCode());

        $station = $verkorteRouteHerkomstActueel[2];
        $this->assertNotNull($station);
        $this->assertEquals('ZL', $station->getStationCode());
        $this->assertEquals('5', $station->getType());
        $this->assertEquals('Zwolle', $station->getKorteNaam());
        $this->assertEquals('Zwolle', $station->getMiddelNaam());
        $this->assertEquals('Zwolle', $station->getLangeNaam());
        $this->assertEquals('8400747', $station->getUICCode());

        $presentatieVerkorteRouteHerkomst = $treinAankomst->getPresentatieVerkorteRouteHerkomst();
        $this->assertNotNull($presentatieVerkorteRouteHerkomst);
        $this->assertCount(1, $presentatieVerkorteRouteHerkomst);

        $uiting = $presentatieVerkorteRouteHerkomst[0];
        $this->assertNotNull($uiting);
        $this->assertNull($uiting->getTaal());
        $this->assertEquals('Dronten, Kampen Zuid, Zwolle', $uiting->getUiting());

        $wijzigingenHerkomst = $treinAankomst->getWijzigingenHerkomst();
        $this->assertNotNull($wijzigingenHerkomst);
        $this->assertCount(1, $wijzigingenHerkomst);

        $wijziging = $wijzigingenHerkomst[0];
        $this->assertNotNull($wijziging);
        $this->assertEquals('11', $wijziging->getWijzigingType());
        $this->assertEquals(null, $wijziging->getWijzigingOorzaakKort());
        $this->assertEquals(null, $wijziging->getWijzigingOorzaakLang());
        $this->assertEquals(null, $wijziging->getWijzigingenStationHerkomst());
        $this->assertEquals(null, $wijziging->getTvvOmschrijving());
    }

    public function testParseReisInformatieProductDasElement20241201Rit18939Eghm()
    {
        $doc = $this->loadXml('dvs-2024-12-01-18939-EGHM.xml');
        $this->assertNotNull($doc);

        $dasNode = $doc->getElementsByTagName('ReisInformatieProductDAS')->item(0);
        $this->assertNotNull($dasNode);

        $parser = new NodeParser();
        $parsed = $parser->parseReisInformatieProductDASElement($dasNode);

        $this->assertNotNull($parsed);

        $this->assertEquals('6.1', $parsed->getVersie());
        $timestamp = $parsed->getTimestamp();
        $this->assertNotNull($timestamp);
        $this->assertEquals('2024-12-01T13:00:01+00:00', $timestamp->format('c'));

        $ripAdministratie = $parsed->getRIPAdministratie();
        $this->assertNotNull($ripAdministratie);

        $this->assertEquals('7336018939234007', $ripAdministratie->getReisInformatieProductID());
        $this->assertEquals('55', $ripAdministratie->getAbonnementId());
        $this->assertEquals('2024-12-01T12:55:00+00:00', $ripAdministratie->getReisInformatieTijdstip()->format('c'));

        $dynamischeAankomstStaat = $parsed->getDynamischeAankomstStaat();
        $this->assertNotNull($dynamischeAankomstStaat);

        $this->assertEquals('18939', $dynamischeAankomstStaat->getRitId());
        $this->assertEquals('2024-12-01', $dynamischeAankomstStaat->getRitDatum()->format('Y-m-d'));

        $ritStation = $dynamischeAankomstStaat->getRitStation();
        $this->assertNotNull($ritStation);

        $this->assertEquals('EGHM', $ritStation->getStationCode());
        $this->assertEquals('0', $ritStation->getType());
        $this->assertEquals('Eygelsh M', $ritStation->getKorteNaam());
        $this->assertEquals('Eygelshoven Mrkt', $ritStation->getMiddelNaam());
        $this->assertEquals('Eygelshoven Markt', $ritStation->getLangeNaam());
        $this->assertEquals('8400234', $ritStation->getUICCode());

        $treinAankomst = $dynamischeAankomstStaat->getTreinAankomst();
        $this->assertNotNull($treinAankomst);

        $this->assertEquals('18939', $treinAankomst->getTreinNummer());
        $this->assertEquals('S', $treinAankomst->getTreinSoortCode());
        $this->assertEquals('Sneltrein', $treinAankomst->getTreinSoort());
        $this->assertEquals('5', $treinAankomst->getTreinStatus());
        $this->assertEquals('Arriva', $treinAankomst->getVervoerder());

        $treinherkomstGepland = $treinAankomst->getTreinHerkomstGepland();
        $this->assertNotNull($treinherkomstGepland);

        $this->assertEquals('MT', $treinherkomstGepland->getStationCode());
        $this->assertEquals('5', $treinherkomstGepland->getType());
        $this->assertEquals('Maastricht', $treinherkomstGepland->getKorteNaam());
        $this->assertEquals('Maastricht', $treinherkomstGepland->getMiddelNaam());
        $this->assertEquals('Maastricht', $treinherkomstGepland->getLangeNaam());
        $this->assertEquals('8400424', $treinherkomstGepland->getUICCode());

        $treinAankomstActueel = $treinAankomst->getTreinHerkomstActueel();
        $this->assertNotNull($treinAankomstActueel);

        $this->assertEquals('HRL', $treinAankomstActueel->getStationCode());
        $this->assertEquals('5', $treinAankomstActueel->getType());
        $this->assertEquals('Heerlen', $treinAankomstActueel->getKorteNaam());
        $this->assertEquals('Heerlen', $treinAankomstActueel->getMiddelNaam());
        $this->assertEquals('Heerlen', $treinAankomstActueel->getLangeNaam());
        $this->assertEquals('8400307', $treinAankomstActueel->getUICCode());

        $presentatieTreinHerkomst = $treinAankomst->getPresentatieTreinHerkomst();
        $this->assertNotNull($presentatieTreinHerkomst);
        $this->assertCount(1, $presentatieTreinHerkomst);

        $uiting = $presentatieTreinHerkomst[0];
        $this->assertNotNull($uiting);

        $this->assertNull($uiting->getTaal());
        $this->assertEquals('Maastricht', $uiting->getUiting());

        $aankomsttijdGepland = $treinAankomst->getAankomstTijdGepland();
        $this->assertNotNull($aankomsttijdGepland);
        $this->assertEquals('2024-12-01T12:55:00+00:00', $aankomsttijdGepland->format('c'));

        $aankomsttijdActueel = $treinAankomst->getAankomstTijdActueel();
        $this->assertNotNull($aankomsttijdActueel);
        $this->assertEquals('2024-12-01T12:57:36+00:00', $aankomsttijdActueel->format('c'));

        $exacteAankomstVertraging = $treinAankomst->getExacteAankomstVertraging();
        $this->assertNotNull($exacteAankomstVertraging);
        $this->assertEquals('PT2M36S', $exacteAankomstVertraging);

        $this->assertEquals('2024-12-01T12:57:36+00:00', $treinAankomst->getAankomstTijdActueel()->format('c'));

        $presentatieAankomstVertraging = $treinAankomst->getPresentatieAankomstVertraging();
        $this->assertNotNull($presentatieAankomstVertraging);
        $this->assertCount(1, $presentatieAankomstVertraging);

        $uiting = $presentatieAankomstVertraging[0];
        $this->assertNotNull($uiting);

        $this->assertNull($uiting->getTaal());
        $this->assertEquals('+2 min.', $uiting->getUiting());

        $gedempteAankomstVertraging = $treinAankomst->getGedempteAankomstVertraging();
        $this->assertNotNull($gedempteAankomstVertraging);
        $this->assertEquals('PT5M', $gedempteAankomstVertraging);

        $treinAankomstSpoorGepland = $treinAankomst->getTreinAankomstSpoorGepland();
        $this->assertNotNull($treinAankomstSpoorGepland);
        $this->assertEquals('1', $treinAankomstSpoorGepland->getSpoorNummer());
        $this->assertEquals(null, $treinAankomstSpoorGepland->getSpoorFase());

        $treinAankomstSpoorActueel = $treinAankomst->getTreinAankomstSpoorActueel();
        $this->assertNotNull($treinAankomstSpoorActueel);
        $this->assertEquals('1', $treinAankomstSpoorActueel->getSpoorNummer());
        $this->assertEquals(null, $treinAankomstSpoorActueel->getSpoorFase());

        $presentatieTreinAankomstSporen = $treinAankomst->getPresentatieTreinAankomstSporen();
        $this->assertNotNull($presentatieTreinAankomstSporen);
        $this->assertCount(2, $presentatieTreinAankomstSporen);

        $uiting = $presentatieTreinAankomstSporen[0];
        $this->assertNotNull($uiting);
        $this->assertEquals('en', $uiting->getTaal());
        $this->assertEquals('1', $uiting->getUiting());

        $uiting = $presentatieTreinAankomstSporen[1];
        $this->assertNotNull($uiting);
        $this->assertEquals('nl', $uiting->getTaal());
        $this->assertEquals('1', $uiting->getUiting());

        $verkorteRouteHerkomstGepland = $treinAankomst->getVerkorteRouteHerkomstGepland();
        $this->assertNotNull($verkorteRouteHerkomstGepland);
        $this->assertCount(4, $verkorteRouteHerkomstGepland);

        $station = $verkorteRouteHerkomstGepland[0];
        $this->assertNotNull($station);
        $this->assertEquals('MES', $station->getStationCode());
        $this->assertEquals('2', $station->getType());
        $this->assertEquals('Meerssen', $station->getKorteNaam());
        $this->assertEquals('Meerssen', $station->getMiddelNaam());
        $this->assertEquals('Meerssen', $station->getLangeNaam());
        $this->assertEquals('8400434', $station->getUICCode());

        $station = $verkorteRouteHerkomstGepland[1];
        $this->assertNotNull($station);
        $this->assertEquals('VK', $station->getStationCode());
        $this->assertEquals('3', $station->getType());
        $this->assertEquals('Valkenburg', $station->getKorteNaam());
        $this->assertEquals('Valkenburg', $station->getMiddelNaam());
        $this->assertEquals('Valkenburg', $station->getLangeNaam());
        $this->assertEquals('8400632', $station->getUICCode());

        $station = $verkorteRouteHerkomstGepland[2];
        $this->assertNotNull($station);
        $this->assertEquals('HRL', $station->getStationCode());
        $this->assertEquals('5', $station->getType());
        $this->assertEquals('Heerlen', $station->getKorteNaam());
        $this->assertEquals('Heerlen', $station->getMiddelNaam());
        $this->assertEquals('Heerlen', $station->getLangeNaam());
        $this->assertEquals('8400307', $station->getUICCode());

        $station = $verkorteRouteHerkomstGepland[3];
        $this->assertNotNull($station);
        $this->assertEquals('LG', $station->getStationCode());
        $this->assertEquals('1', $station->getType());
        $this->assertEquals('Landgraaf', $station->getKorteNaam());
        $this->assertEquals('Landgraaf', $station->getMiddelNaam());
        $this->assertEquals('Landgraaf', $station->getLangeNaam());
        $this->assertEquals('8400548', $station->getUICCode());

        $verkorteRouteHerkomstActueel = $treinAankomst->getVerkorteRouteHerkomstActueel();
        $this->assertNotNull($verkorteRouteHerkomstActueel);
        $this->assertCount(1, $verkorteRouteHerkomstActueel);

        $station = $verkorteRouteHerkomstActueel[0];
        $this->assertNotNull($station);
        $this->assertEquals('LG', $station->getStationCode());
        $this->assertEquals('1', $station->getType());
        $this->assertEquals('Landgraaf', $station->getKorteNaam());
        $this->assertEquals('Landgraaf', $station->getMiddelNaam());
        $this->assertEquals('Landgraaf', $station->getLangeNaam());
        $this->assertEquals('8400548', $station->getUICCode());

        $presentatieVerkorteRouteHerkomst = $treinAankomst->getPresentatieVerkorteRouteHerkomst();
        $this->assertNotNull($presentatieVerkorteRouteHerkomst);
        $this->assertCount(1, $presentatieVerkorteRouteHerkomst);

        $uiting = $presentatieVerkorteRouteHerkomst[0];
        $this->assertNotNull($uiting);
        $this->assertNull($uiting->getTaal());
        $this->assertEquals('Landgraaf', $uiting->getUiting());

        $wijzigingenHerkomst = $treinAankomst->getWijzigingenHerkomst();
        $this->assertNotNull($wijzigingenHerkomst);
        $this->assertCount(2, $wijzigingenHerkomst);

        $wijziging = $wijzigingenHerkomst[0];
        $this->assertNotNull($wijziging);
        $this->assertEquals('11', $wijziging->getWijzigingType());
        $this->assertEquals("tekort personeel", $wijziging->getWijzigingOorzaakKort());
        $this->assertEquals("door een tekort aan personeel", $wijziging->getWijzigingOorzaakLang());
        $this->assertEquals(null, $wijziging->getWijzigingenStationHerkomst());
        $this->assertEquals(null, $wijziging->getTvvOmschrijving());

        $wijziging = $wijzigingenHerkomst[1];
        $this->assertNotNull($wijziging);
        $this->assertEquals('36', $wijziging->getWijzigingType());
        $this->assertEquals("tekort personeel", $wijziging->getWijzigingOorzaakKort());
        $this->assertEquals('door een tekort aan personeel', $wijziging->getWijzigingOorzaakLang());
        $this->assertEquals(null, $wijziging->getWijzigingenStationHerkomst());
        $this->assertEquals(null, $wijziging->getTvvOmschrijving());
    }
}
