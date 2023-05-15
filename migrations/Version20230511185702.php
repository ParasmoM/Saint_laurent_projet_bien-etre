<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511185702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Cette migration effectue des modifications sur les tables 'images' et 'internet_users' :- Dans la table 'images', elle ajoute une colonne 'internet_user_id' avec une clé étrangère vers la table 'internet_users'. - Elle supprime une contrainte de clé étrangère existante dans la table 'internet_users'. - Dans la table 'internet_users', elle supprime une colonne appelée 'image_profile_id'. - Lors de l'annulation de la migration, elle effectue les opérations inverses : suppression de la clé étrangère dans la table 'images' et réajout de la colonne et de la contrainte dans la table 'internet_users'.";
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD internet_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AA185D2B0 FOREIGN KEY (internet_user_id) REFERENCES internet_users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6AA185D2B0 ON images (internet_user_id)');
        $this->addSql('ALTER TABLE internet_users DROP FOREIGN KEY FK_C8A2E213A024058E');
        $this->addSql('DROP INDEX UNIQ_C8A2E213A024058E ON internet_users');
        $this->addSql('ALTER TABLE internet_users DROP image_profile_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AA185D2B0');
        $this->addSql('DROP INDEX UNIQ_E01FBE6AA185D2B0 ON images');
        $this->addSql('ALTER TABLE images DROP internet_user_id');
        $this->addSql('ALTER TABLE internet_users ADD image_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE internet_users ADD CONSTRAINT FK_C8A2E213A024058E FOREIGN KEY (image_profile_id) REFERENCES images (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C8A2E213A024058E ON internet_users (image_profile_id)');
    }
}
