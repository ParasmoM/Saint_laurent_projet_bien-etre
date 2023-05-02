<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502221101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Début de la relation entre image et providers';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD provider_logo_id INT DEFAULT NULL, ADD provider_photo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A9D7B6ED FOREIGN KEY (provider_logo_id) REFERENCES providers (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A36DC2265 FOREIGN KEY (provider_photo_id) REFERENCES providers (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A9D7B6ED ON images (provider_logo_id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A36DC2265 ON images (provider_photo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A9D7B6ED');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A36DC2265');
        $this->addSql('DROP INDEX IDX_E01FBE6A9D7B6ED ON images');
        $this->addSql('DROP INDEX IDX_E01FBE6A36DC2265 ON images');
        $this->addSql('ALTER TABLE images DROP provider_logo_id, DROP provider_photo_id');
    }
}
