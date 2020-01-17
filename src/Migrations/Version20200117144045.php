<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200117144045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medicament CHANGE profil_id profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pharmacie ADD arrondissement_id INT DEFAULT NULL, CHANGE telephone telephone INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pharmacie ADD CONSTRAINT FK_5FC19434407DBC11 FOREIGN KEY (arrondissement_id) REFERENCES arrondissement (id)');
        $this->addSql('CREATE INDEX IDX_5FC19434407DBC11 ON pharmacie (arrondissement_id)');
        $this->addSql('ALTER TABLE profil CHANGE maladie_chronique_id maladie_chronique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medicament CHANGE profil_id profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pharmacie DROP FOREIGN KEY FK_5FC19434407DBC11');
        $this->addSql('DROP INDEX IDX_5FC19434407DBC11 ON pharmacie');
        $this->addSql('ALTER TABLE pharmacie DROP arrondissement_id, CHANGE telephone telephone INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil CHANGE maladie_chronique_id maladie_chronique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
