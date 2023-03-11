<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserContactFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        // ~~~~~~~~~~~~~~
        // ~~~ ADMIN  ~~~
        // ~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Admin');
        $contact->setLastname('Athelas');
        $contact->setEmail('admin@athelas.fr');
        $contact->setPhone('+33567890987');
        $contact->setAddress('1 rue du château d\'eau');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Administrateur');
        // $contact->setCompany('Athelas');
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Administrateur');
        $user->setPicture('placeholder');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Tamara');
        $contact->setLastname('Smith');
        $contact->setEmail('tamara.smith@athelas.fr');
        $contact->setPhone('+336878489526');
        $contact->setAddress('3 avenue de la forêt');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('tsmith');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Directrice Marketing');
        $user->setPicture('placeholder');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();
    }
}
