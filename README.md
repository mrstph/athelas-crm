# CRM

## First school project using Symfony

### Subject :

I need to develop a CRM with Symfony that must contain :

* 1 login, register and password reset page/modal
* 1 contact book page listing all company contacts 
* 1 dashboard page listing contacts, calendar events, reminders or other relevant ideas
* 1 profile page (view and edit)
* 1 calendar page
* 1 contact page (CRUD)

------------

## Development environment

### Prerequisites :

* PHP 8.1
* Composer
* nodejs and npm

You can check prerequisites with the following command:

```bash
composer require symfony/requirements-checker
```

### Launch dev environment :

```bash
composer install
npm install
npm run build
```

You also need to create an .env file based on the .env.example file