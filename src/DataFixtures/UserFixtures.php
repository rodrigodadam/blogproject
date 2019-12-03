<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;

    }

    public function load(ObjectManager $manager)
    {

        foreach ($this->getUserData() as [$name, $last_name, $email, $password, $roles])
        {
            $user = new User();
            $user->setFirstName($name);
            $user->setLastName($last_name);
            $user->setEmail($email);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setRoles($roles);

            $manager->persist($user);
        }


        $manager->flush();
    }

    private function getUserData(): array
    {
        return [

            ['Rodrigo', 'Wayne', 'rodrigo@gmail.com', '123456', ['ROLE_ADMIN']],
            ['Leticia', 'Wayne', 'leticia@gmail.com', '123456', ['ROLE_ADMIN']],
            ['Larissa', 'Doe', 'larissa@gmail.com', '123456', ['ROLE_USER']]

        ];
    }

}
