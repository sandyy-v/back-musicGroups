<?php

namespace App\DataFixtures;

use App\Entity\MusicGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        // Création d'une ligne dans la table MusicGroup
        $musicGroup = new MusicGroup;
        $musicGroup->setGroupName('Warrant');
        $musicGroup->setOrigin('Etats-Unis');
        $musicGroup->setCity('Los Angeles');
        $musicGroup->setStartYear(1983);
        $musicGroup->setEndYear(0);
        $musicGroup->setFounder('Erik Turner');
        $musicGroup->setMembers(5);
        $musicGroup->setMusicStyle('Hard-rock ');
        $musicGroup->setPresentation('Warrant est un groupe américain de hard-rock formé dans la région de Los Angeles en 1983.');
        $manager->persist($musicGroup);

        $manager->flush();
    }
}
