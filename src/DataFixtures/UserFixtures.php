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

        foreach ($this->getUserData() as [$name, $last_name, $about, $email, $password, $roles, $image])
        {
            $user = new User();
            $user->setFirstName($name);
            $user->setLastName($last_name);
            $user->setEmail($email);
            $user->setAbout($about);
            $user->setImageUrl($image);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setRoles($roles);

            $manager->persist($user);
        }


        $manager->flush();
    }

    private function getUserData(): array
    {
        return [

            ['Rodrigo', 'Wayne', 'about user', 'rodrigo@gmail.com', '123456', ['ROLE_ADMIN'], 'image'],
            ['Leticia', 'Wayne', 'about user', 'leticia@gmail.com', '123456', ['ROLE_ADMIN'], 'image'],
            ['Larissa', 'Doe', 'about user', 'larissa@gmail.com', '123456', ['ROLE_USER'], 'image']

        ];
    }

}
