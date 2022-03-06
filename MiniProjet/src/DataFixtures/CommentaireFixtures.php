<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Crypto;

class CommentaireFixtures extends AppFixtures
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