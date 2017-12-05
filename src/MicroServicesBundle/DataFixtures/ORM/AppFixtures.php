<?php
namespace MicroServicesBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use MicroServicesBundle\Entity\Feed;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $feed = new Feed();
            $feed->setContent('content '.$i);
            $feed->setOwner(1);
            $feed->setPlatform('official');
            $feed->setCreationDate(new \DateTime());
            $manager->persist($feed);
        }

        $manager->flush();
    }
}