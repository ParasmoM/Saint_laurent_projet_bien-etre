<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503101307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Retation Provider à Promotion et de Promotion à Service';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotions ADD providers_id INT DEFAULT NULL, ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B3034D178A47B FOREIGN KEY (providers_id) REFERENCES providers (id)');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B3034ED5CA9E6 FOREIGN KEY (service_id) REFERENCES categories_of_services (id)');
        $this->addSql('CREATE INDEX IDX_EA1B3034D178A47B ON promotions (providers_id)');
        $this->addSql('CREATE INDEX IDX_EA1B3034ED5CA9E6 ON promotions (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B3034D178A47B');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B3034ED5CA9E6');
        $this->addSql('DROP INDEX IDX_EA1B3034D178A47B ON promotions');
        $this->addSql('DROP INDEX IDX_EA1B3034ED5CA9E6 ON promotions');
        $this->addSql('ALTER TABLE promotions DROP providers_id, DROP service_id');
    }
}
