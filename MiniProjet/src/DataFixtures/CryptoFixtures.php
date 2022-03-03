<?php

namespace App\DataFixtures;

use App\Entity\Crypto;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class CryptoFixtures extends AppFixtures
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $c1 = new Crypto();
        $c2 = new Crypto();
        $c3 = new Crypto();
        $c4 = new Crypto();
        $c5 = new Crypto();

        $c1->setNom("Bitcoin");
        $c2->setNom("Ethereum");
        $c3->setNom("Cardano");
        $c4->setNom("Bitcoin Cash");
        $c5->setNom("Ripple");

        $d1 = new \DateTime('03-01-2009');
        $d2 = new \DateTime('30-07-2015');
        $d3 = new \DateTime('29-09-2017');
        $d4 = new \DateTime('01-08-2017');
        $d5 = new \DateTime('01-01-2012');

        $c1->setDateCrea($d1);
        $c2->setDateCrea($d2);
        $c3->setDateCrea($d3);
        $c4->setDateCrea($d4);
        $c5->setDateCrea($d5);

        $c1->setEquiUSD(36629);
        $c2->setEquiUSD(2397);
        $c3->setEquiUSD(1);
        $c4->setEquiUSD(286);
        $c5->setEquiUSD(1);

        $c1->setAlgo("SHA-256");
        $c2->setAlgo("Ethash");
        $c3->setAlgo("Ouroboros");
        $c4->setAlgo("SHA-256");
        $c5->setAlgo("ECDSA");

        $c1->setQteEmise(18);
        $c2->setQteEmise(115);
        $c3->setQteEmise(31);
        $c4->setQteEmise(18);
        $c5->setQteEmise(44000);

        $c1->setQteMax("21 millions");
        $c2->setQteMax("sans limites");
        $c3->setQteMax("45 milliards");
        $c4->setQteMax("21 millions");
        $c5->setQteMax("100 milliards");

        $manager->persist($c1);
        $manager->persist($c2);
        $manager->persist($c3);
        $manager->persist($c4);
        $manager->persist($c5);

        $manager->flush();
    }
}