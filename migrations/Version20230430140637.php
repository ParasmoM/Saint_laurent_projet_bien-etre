<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430140637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "J'ai changé quelques champs dans user pour accepter les valeurs null";
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users CHANGE address_street address_street VARCHAR(255) DEFAULT NULL, CHANGE adress_number adress_number VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users CHANGE address_street address_street VARCHAR(255) NOT NULL, CHANGE adress_number adress_number VARCHAR(255) NOT NULL');
    }
}
