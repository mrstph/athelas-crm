<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();

        $contact->setFirstname('Amy');
        $contact->setLastname('Straut');
        $contact->setEmail('astraut@visionary.fr');
        $contact->setPhone('+33712457814');
        $contact->setAddress('7 rue des singes');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Prestataire');
        $contact->setCompany($this->getReference(CompanyFixtures::VISIONARY_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Antoine');
        $contact->setLastname('Bauza');
        $contact->setEmail('abauza@visionary.fr');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Prestataire');
        $contact->setCompany($this->getReference(CompanyFixtures::VISIONARY_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Pascal');
        $contact->setLastname('Muller');
        $contact->setEmail('pmuller@visionary.fr');
        $contact->setPhone('+33678564514');
        $contact->setJobPosition('Prestataire');
        $contact->setCompany($this->getReference(CompanyFixtures::VISIONARY_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~

        $contact = new Contact();

        $contact->setFirstname('Vincent');
        $contact->setLastname('Pavlovic');
        $contact->setEmail('vpavlovic@visionary.fr');
        $contact->setPhone('+33789124728');
        $contact->setAddress('48 Boulevard de Lyon');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Prestataire');
        $contact->setCompany($this->getReference(CompanyFixtures::VISIONARY_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Elisabeth');
        $contact->setLastname('Martin');
        $contact->setEmail('elisabeth.martin@res-eau.fr');
        $contact->setPhone('+33614782846');
        $contact->setAddress('12 rue du Parc');
        $contact->setZipCode('67500');
        $contact->setCity('Haguenau');
        $contact->setCountry('France');
        $contact->setJobPosition('Fournisseur');
        $contact->setCompany($this->getReference(CompanyFixtures::RESEAU_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Patricia');
        $contact->setLastname('Schlegel');
        $contact->setEmail('p.schlegel@res-eau.fr');
        $contact->setAddress('40 rue de l\'Abbé Dédé');
        $contact->setZipCode('67500');
        $contact->setCity('Haguenau');
        $contact->setCountry('France');
        $contact->setJobPosition('Fournisseur');
        $contact->setCompany($this->getReference(CompanyFixtures::RESEAU_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Isaac');
        $contact->setLastname('Fontaine');
        $contact->setEmail('isaac.fontaine@megacorp.fr');
        $contact->setJobPosition('Prestataire');
        $contact->setCompany($this->getReference(CompanyFixtures::MEGACORP_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Romain');
        $contact->setLastname('Dubois');
        $contact->setEmail('romain.dubois@megacorp.fr');
        $contact->setJobPosition('Prestataire');
        $contact->setCompany($this->getReference(CompanyFixtures::MEGACORP_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Marie-Jeanne');
        $contact->setLastname('Bourbon');
        $contact->setEmail('mjbourbon@maskito.fr');
        $contact->setPhone('+33700000028');
        $contact->setZipCode('67500');
        $contact->setCity('Haguenau');
        $contact->setCountry('France');
        $contact->setJobPosition('Client');
        $contact->setCompany($this->getReference(CompanyFixtures::MASKITO_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Maurice');
        $contact->setLastname('Bourbon');
        $contact->setEmail('mbourbon@maskito.fr');
        $contact->setPhone('+33748747416');
        $contact->setZipCode('67500');
        $contact->setCity('Haguenau');
        $contact->setCountry('France');
        $contact->setJobPosition('Client');
        $contact->setCompany($this->getReference(CompanyFixtures::MASKITO_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Philippe');
        $contact->setLastname('Schneider');
        $contact->setEmail('pschneider@maskito.fr');
        $contact->setZipCode('67500');
        $contact->setCity('Haguenau');
        $contact->setCountry('France');
        $contact->setJobPosition('Client');
        $contact->setCompany($this->getReference(CompanyFixtures::MASKITO_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Marc');
        $contact->setLastname('Orwell');
        $contact->setEmail('morwell@maskito.fr');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Client');
        $contact->setCompany($this->getReference(CompanyFixtures::MASKITO_COMPANY));
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Frédéric');
        $contact->setLastname('Saltz');
        $contact->setEmail('frederic.saltz@gmail.com');
        $contact->setPhone('+33614112321');
        $contact->setAddress('7 avenue des Remparts');
        $contact->setZipCode('67500');
        $contact->setCity('Haguenau');
        $contact->setCountry('France');
        $contact->setJobPosition('Client');
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Benoît');
        $contact->setLastname('Meyer');
        $contact->setEmail('benoit.meyer@gmail.com');
        $contact->setPhone('+33678289712');
        $contact->setAddress('2 Place de l\'étoile');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Client');
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

        // ~~~~~~~~~~~~~~~~~~~~~~~~
        // ~~~ ANOTHER CLIENT  ~~~
        // ~~~~~~~~~~~~~~~~~~~~~~~~
        
        $contact = new Contact();

        $contact->setFirstname('Emmanuel');
        $contact->setLastname('Barbier');
        $contact->setEmail('emmanuel.barbier@ccicampus.fr');
        $contact->setPhone('+33645781245');
        $contact->setAddress('10 place de la Bourse');
        $contact->setZipCode('67000');
        $contact->setCity('Strasbourg');
        $contact->setCountry('France');
        $contact->setJobPosition('Prestataire');
        $contact->setCreatedAt(new \DateTimeImmutable());
    
        $manager->persist($contact);
        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            CompanyFixtures::class,
        ];
    }
}
