<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $message = new Message();
        $message->setName("Gábor Eckstein");
        $message->setEmail("eckstein.gabor@t-online-hu");
        $message->setMessage("Próba üzenet 1");
        $manager->persist($message);

        $message2 = new Message();
        $message2->setName("Milán Eckstein");
        $message2->setEmail("eckstein.milan@t-online-hu");
        $message2->setMessage("Próba üzenet 2");
        $manager->persist($message2);

        $manager->flush();
    }
}
