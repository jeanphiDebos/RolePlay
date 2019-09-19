<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * password Encoder.
     *
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('jean.philippe.debos@gmail.com');
        $user->setName('admin');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setPlainPassword('admin');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $user->getPlainPassword()
            )
        );
        $manager->persist($user);

        $manager->flush();
    }
}
