<?php
    namespace App\DataFixtures;

    use App\Entity\User;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;

    class UserFixtures extends Fixture
    {
        /**
         * @param ObjectManager $manager
         *
         * @return void
         */
        public function load(ObjectManager $manager) : void
        {
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

            $p1->setMail("pdupont@cryp.fr");
            $p2->setMail("slahaye@cryp.fr");
            $p3->setMail("pnecker@cryp.fr");
            $p4->setMail("jbart@cryp.fr");
            $p5->setMail("schamson@cryp.fr");

            $p1->setRole("User");
            $p2->setRole("User");
            $p3->setRole("User");
            $p4->setRole("Admin");
            $p5->setRole("User");

            $manager->persist($p1);
            $manager->persist($p2);
            $manager->persist($p3);
            $manager->persist($p4);
            $manager->persist($p5);

            $manager->flush();
        }
    }