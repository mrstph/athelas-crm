<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserContactFixtures extends Fixture
{
    // definition of const that are applied in EventFixtures
    const ADMIN_USER = 'admin';

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
        $contact->setPhone('+33667890987');
        $contact->setAddress('1 rue du château d\'eau');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Administrateur');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        $this->addReference(self::ADMIN_USER, $contact);

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Tamara');
        $contact->setLastname('Smith');
        $contact->setEmail('tamara.smith@athelas.fr');
        $contact->setPhone('+33687848956');
        $contact->setAddress('3 avenue de la forêt');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('tsmith');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Directrice Marketing');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Samantha');
        $contact->setLastname('Taglia');
        $contact->setEmail('samantha.taglia@athelas.fr');
        $contact->setPhone('+33665129057');
        $contact->setAddress('3 rue des mésanges');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('stalglia');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Responsable Ressources Humaines');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('John');
        $contact->setLastname('Douglas');
        $contact->setEmail('john.douglas@athelas.fr');
        $contact->setPhone('+33689453518');
        $contact->setAddress('4 avenue des cigales');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('jdouglas');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Directeur Informatique');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Louis');
        $contact->setLastname('Cailot');
        $contact->setEmail('louis.cailot@athelas.fr');
        $contact->setPhone('+33612235645');
        $contact->setAddress('150 route du Rhin');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('lcailot');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Designer');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Gilles');
        $contact->setLastname('Audet');
        $contact->setEmail('gilles.audet@athelas.fr');
        $contact->setPhone('+33678127895');
        $contact->setAddress('78 rue de la rue');
        $contact->setZipCode('67000');
        $contact->setCity('Illkirch-Graffenstaden');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('gaudet');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Responsable Qualité');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Victor');
        $contact->setLastname('Schmidt');
        $contact->setEmail('victor.schmidt@athelas.fr');
        $contact->setPhone('+33714586821');
        $contact->setAddress('4 avenue du bassin');
        $contact->setZipCode('67000');
        $contact->setCity('Bischheim');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('vschmidt');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Responsable Production');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER EMPLOYEE ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Pauline');
        $contact->setLastname('Chesnay');
        $contact->setEmail('pauline.chesnay@athelas.fr');
        $contact->setPhone('+33799689639');
        $contact->setAddress('1 rue de la Haute');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Collaborateur');
        $contact->setCompany($this->getReference(CompanyFixtures::ATHELAS_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);

        $user = new User();
        $user->setUsername('pchesnay');
        $user->setRoles(['ROLE_USER']);
        $password = $this->hasher->hashPassword($user,'pass_1234');
        $user->setPassword($password);
        $user->setConsent(true);
        $user->setPositionCompany('Responsable Ventes');
        $user->setContact($contact);

        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
