<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    // definition of const that are applied in ContactFixtures & UserContactFixtures
    const ATHELAS_COMPANY = 'athelas';
    const VISIONARY_COMPANY = 'visionary';
    const RESEAU_COMPANY = 'reseau';
    const MEGACORP_COMPANY = 'megacorp';
    const MASKITO_COMPANY = 'maskito';

    public function load(ObjectManager $manager): void
    {
        $company = new Company();

        $company->setName('Athelas');
        $company->setEmail('contact@athelas.fr');
        $company->setPhone('+33683971583');
        $company->setAddress('1 rue du futur');
        $company->setZipCode('67000');
        $company->setCity('Strasbourg');
        $company->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($company);
        $manager->flush();

        $this->setReference(self::ATHELAS_COMPANY, $company);

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER COMPANY  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $company = new Company();

        $company->setName('Visionary');
        $company->setEmail('contact@visionary.fr');
        $company->setPhone('+33388676711');
        $company->setAddress('8 rue de l\'aigle');
        $company->setZipCode('67000');
        $company->setCity('Strasbourg');
        $company->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($company);
        $manager->flush();

        $this->setReference(self::VISIONARY_COMPANY, $company);

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER COMPANY ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $company = new Company();

        $company->setName('Res-eau');
        $company->setEmail('contact@Res-eau.fr');
        $company->setPhone('+33388653201');
        $company->setAddress('5 rue des noisettiers');
        $company->setZipCode('67300');
        $company->setCity('Schiltigheim');
        $company->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($company);
        $manager->flush();

        $this->setReference(self::RESEAU_COMPANY, $company);

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER COMPANY ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $company = new Company();

        $company->setName('Megacorp');
        $company->setEmail('contact@megacorp.fr');
        $company->setPhone('+33787457572');
        $company->setAddress('34a rue de la chance');
        $company->setZipCode('67000');
        $company->setCity('Strasbourg');
        $company->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($company);
        $manager->flush();

        $this->setReference(self::MEGACORP_COMPANY, $company);

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER COMPANY ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $company = new Company();

        $company->setName('Maskito');
        $company->setEmail('contact@maskito.fr');
        $company->setPhone('+33758962548');
        $company->setAddress('6B boulevard du soleil');
        $company->setZipCode('67000');
        $company->setCity('Strasbourg');
        $company->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($company);
        $manager->flush();

        $this->setReference(self::MASKITO_COMPANY, $company);

    }
}
