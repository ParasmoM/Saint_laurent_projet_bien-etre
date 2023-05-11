<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511003612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la rélation entre Providers à Internships';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internships ADD providers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE internships ADD CONSTRAINT FK_12A85290D178A47B FOREIGN KEY (providers_id) REFERENCES providers (id)');
        $this->addSql('CREATE INDEX IDX_12A85290D178A47B ON internships (providers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internships DROP FOREIGN KEY FK_12A85290D178A47B');
        $this->addSql('DROP INDEX IDX_12A85290D178A47B ON internships');
        $this->addSql('ALTER TABLE internships DROP providers_id');
    }
}
