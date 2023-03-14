<?php

use App\Entity\User;
use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserEntityTest extends WebTestCase
{
    public function testSetAndGetUsername()
    {
        $user = new User();
        $username = 'testuser';
        $user->setUsername($username);
        $this->assertEquals($username, $user->getUsername());
    }

    public function testGetUserIdentifier()
    {
        $user = new User();
        $username = 'testuser';
        $user->setUsername($username);
        $this->assertEquals($username, $user->getUserIdentifier());
    }

    public function testSetAndGetRoles()
    {
        $user = new User();
        $roles = ['ROLE_USER', 'ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertEquals($roles, $user->getRoles());
    }

    public function testSetAndGetPassword()
    {
        $user = new User();
        $password = 'testpassword';
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }

    public function testGetAndSetPicture()
    {
        $user = new User();
        $picture = 'testpicture.png';
        $user->setPicture($picture);
        $this->assertEquals($picture, $user->getPicture());
    }

    public function testGetAndSetPositionCompany()
    {
        $user = new User();
        $position_company = 'testpositioncompany';
        $user->setPositionCompany($position_company);
        $this->assertEquals($position_company, $user->getPositionCompany());
    }

    public function testGetAndSetConsent()
    {
        $user = new User();
        $consent = true;
        $user->setConsent($consent);
        $this->assertEquals($consent, $user->isConsent());
    }

    public function testSetAndGetContact()
    {
        $user = new User();
        $contact = new Contact();
        $user->setContact($contact);
        $this->assertEquals($contact, $user->getContact());
    }
}
