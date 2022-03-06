<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Crypto;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $p1 = new User();
        $p2 = new User();
        $p3 = new User();
        $p4 = new User();
        $p5 = new User();

        $p1->setNom("DUPONT");
        $p2->setNom("LAHAYE");
        $p3->setNom("NECKER");
        $p4->setNom("BART");
        $p5->setNom("CHAMSON");

        $p1->setPrenom("Pierre");
        $p2->setPrenom("Sylvie");
        $p3->setPrenom("Pauline");
        $p4->setPrenom("Jean");
        $p5->setPrenom("Samuel");

        $p1->setUsername("pdupont");
        $p2->setUsername("slahaye");
        $p3->setUsername("pnecker");
        $p4->setUsername("jbart");
        $p5->setUsername("schamson");

        $p1->setPassword(sha1("pdupont"));
        $p2->setPassword(sha1("slahaye"));
        $p3->setPassword(sha1("pnecker"));
        $p4->setPassword(sha1("jbart"));
        $p5->setPassword(sha1("schamson"));

        $p1->setMail("pdupont@cryp.fr");
        $p2->setMail("slahaye@cryp.fr");
        $p3->setMail("pnecker@cryp.fr");
        $p4->setMail("jbart@cryp.fr");
        $p5->setMail("schamson@cryp.fr");

        $p1->setRoles("User");
        $p2->setRoles("User");
        $p3->setRoles("User");
        $p4->setRoles("Admin");
        $p5->setRoles("User");

        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);
        $manager->persist($p4);
        $manager->persist($p5);

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

        $co1 = new Commentaire();
        $co2 = new Commentaire();
        $co3 = new Commentaire();
        $co4 = new Commentaire();
        $co5 = new Commentaire();

        $co1->setAuteur($p1);
        $co2->setAuteur($p2);
        $co3->setAuteur($p3);
        $co4->setAuteur($p3);
        $co5->setAuteur($p2);

        $co1->setCrypto($c1);
        $co2->setCrypto($c2);
        $co3->setCrypto($c3);
        $co4->setCrypto($c4);
        $co5->setCrypto($c5);

        $co1->setContenu("C'est la crypto de base");
        $co2->setContenu("C'est une bonne crypto");
        $co3->setContenu("INCROYABLE");
        $co4->setContenu("Mouais");
        $co5->setContenu("Pas super comme crypto");

        $manager->persist($co1);
        $manager->persist($co2);
        $manager->persist($co3);
        $manager->persist($co4);
        $manager->persist($co5);

        $manager->flush();
    }
}
