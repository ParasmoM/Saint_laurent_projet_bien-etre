<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502004828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cette migration modifie les colonnes "featured" et "validated" de la table "categories_of_services" en TINYINT(1) avec une valeur par défaut de NULL.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_of_services CHANGE featured featured TINYINT(1) DEFAULT NULL, CHANGE validated validated TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_of_services CHANGE featured featured TINYINT(1) NOT NULL, CHANGE validated validated TINYINT(1) NOT NULL');
    }
}
