<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511195859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Pour changer providerPhoto et providerLogo de OneToMany pour OneToOne';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP INDEX IDX_E01FBE6A36DC2265, ADD UNIQUE INDEX UNIQ_E01FBE6A36DC2265 (provider_photo_id)');
        $this->addSql('ALTER TABLE images DROP INDEX IDX_E01FBE6A9D7B6ED, ADD UNIQUE INDEX UNIQ_E01FBE6A9D7B6ED (provider_logo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP INDEX UNIQ_E01FBE6A9D7B6ED, ADD INDEX IDX_E01FBE6A9D7B6ED (provider_logo_id)');
        $this->addSql('ALTER TABLE images DROP INDEX UNIQ_E01FBE6A36DC2265, ADD INDEX IDX_E01FBE6A36DC2265 (provider_photo_id)');
    }
}
