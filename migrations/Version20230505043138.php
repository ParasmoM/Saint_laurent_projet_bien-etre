<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505043138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la relation entre Users vers PostalCodes Localities Towns en ManyToOne';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP INDEX UNIQ_1483A5E988823A92, ADD INDEX IDX_1483A5E988823A92 (locality_id)');
        $this->addSql('ALTER TABLE users DROP INDEX UNIQ_1483A5E975E23604, ADD INDEX IDX_1483A5E975E23604 (town_id)');
        $this->addSql('ALTER TABLE users DROP INDEX UNIQ_1483A5E9BDBA6A61, ADD INDEX IDX_1483A5E9BDBA6A61 (postal_code_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP INDEX IDX_1483A5E975E23604, ADD UNIQUE INDEX UNIQ_1483A5E975E23604 (town_id)');
        $this->addSql('ALTER TABLE users DROP INDEX IDX_1483A5E988823A92, ADD UNIQUE INDEX UNIQ_1483A5E988823A92 (locality_id)');
        $this->addSql('ALTER TABLE users DROP INDEX IDX_1483A5E9BDBA6A61, ADD UNIQUE INDEX UNIQ_1483A5E9BDBA6A61 (postal_code_id)');
    }
}
