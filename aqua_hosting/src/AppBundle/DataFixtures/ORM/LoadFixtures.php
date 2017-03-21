<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\VpsOs;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function vpsosname()
    {
        $genera = [
            'Linux Centos 5.x 64 Bit',
            'Windows 2008 R2 64 Bit Datacenter',
            'Linux Ubuntu 10.10 64 Bit',
            'Linux Centos 6.x 64 Bit',
            'Linux Debian 6.x 64 Bit',
            'Linux Centos 5.x 32 Bit',
            'Linux Centos 6.x 32 Bit',
            'Linux Debian 6.x 32 Bit',
            'Linux Ubuntu 10.10 32 Bit',
            'Linux Ubuntu 12.04 64 Bit',
            'Linux Ubuntu 12.04 32 Bit',
            'Linux Ubuntu 10.04 64 Bit',
            'Linux Ubuntu 10.04 32 Bit',
            'Windows 2012 64 Bit Datacenter',
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }
}
