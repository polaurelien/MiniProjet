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
        }
    }