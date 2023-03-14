<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314125035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE companies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(100) DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(50) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, job_position VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_33401573E7927C74 (email), INDEX IDX_33401573979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_event (contact_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_16841AA8E7A1254A (contact_id), INDEX IDX_16841AA871F7E88B (event_id), PRIMARY KEY(contact_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, all_day TINYINT(1) DEFAULT NULL, background_color VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, location VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invites (id INT AUTO_INCREMENT NOT NULL, contact_id INT NOT NULL, contact_invited_id INT NOT NULL, event_id INT NOT NULL, invite_status VARCHAR(100) NOT NULL, INDEX IDX_37E6A6CE7A1254A (contact_id), INDEX IDX_37E6A6C5541ED0 (contact_invited_id), INDEX IDX_37E6A6C71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, contact_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, position_company VARCHAR(255) DEFAULT NULL, consent TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_33401573979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA8E7A1254A FOREIGN KEY (contact_id) REFERENCES contacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_event ADD CONSTRAINT FK_16841AA871F7E88B FOREIGN KEY (event_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invites ADD CONSTRAINT FK_37E6A6CE7A1254A FOREIGN KEY (contact_id) REFERENCES contacts (id)');
        $this->addSql('ALTER TABLE invites ADD CONSTRAINT FK_37E6A6C5541ED0 FOREIGN KEY (contact_invited_id) REFERENCES contacts (id)');
        $this->addSql('ALTER TABLE invites ADD CONSTRAINT FK_37E6A6C71F7E88B FOREIGN KEY (event_id) REFERENCES events (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9E7A1254A FOREIGN KEY (contact_id) REFERENCES contacts (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_33401573979B1AD6');
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA8E7A1254A');
        $this->addSql('ALTER TABLE contact_event DROP FOREIGN KEY FK_16841AA871F7E88B');
        $this->addSql('ALTER TABLE invites DROP FOREIGN KEY FK_37E6A6CE7A1254A');
        $this->addSql('ALTER TABLE invites DROP FOREIGN KEY FK_37E6A6C5541ED0');
        $this->addSql('ALTER TABLE invites DROP FOREIGN KEY FK_37E6A6C71F7E88B');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9E7A1254A');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE contact_event');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE invites');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
