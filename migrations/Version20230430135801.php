<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430135801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '
        J\'ai ajouté l\'authentification et créé la relation entre les entités "Users", "Internaute" et "Provider". ';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD internet_users_id INT DEFAULT NULL, ADD providers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E92CB18B7B FOREIGN KEY (internet_users_id) REFERENCES internet_users (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D178A47B FOREIGN KEY (providers_id) REFERENCES providers (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E92CB18B7B ON users (internet_users_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9D178A47B ON users (providers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E92CB18B7B');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9D178A47B');
        $this->addSql('DROP INDEX IDX_1483A5E92CB18B7B ON users');
        $this->addSql('DROP INDEX IDX_1483A5E9D178A47B ON users');
        $this->addSql('ALTER TABLE users DROP internet_users_id, DROP providers_id');
    }
}
