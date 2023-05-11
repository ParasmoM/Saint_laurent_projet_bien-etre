<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511004549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Pour rendre certains champs de Internships nullable';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internships CHANGE display_from_date display_from_date DATE DEFAULT NULL, CHANGE display_until_date display_until_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internships CHANGE display_from_date display_from_date DATE NOT NULL, CHANGE display_until_date display_until_date DATE NOT NULL');
    }
}
