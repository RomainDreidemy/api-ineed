<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116084231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE arrondissement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, postal_code INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre_de_sante (id INT AUTO_INCREMENT NOT NULL, arrondissement_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, telephone INT NOT NULL, website LONGTEXT DEFAULT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, INDEX IDX_1A01B9AA407DBC11 (arrondissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre_de_sante_profil (centre_de_sante_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_C33F05C2F0AE38FB (centre_de_sante_id), INDEX IDX_C33F05C2275ED078 (profil_id), PRIMARY KEY(centre_de_sante_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hopital (id INT AUTO_INCREMENT NOT NULL, arrondissement_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, telephone INT NOT NULL, INDEX IDX_8718F2C407DBC11 (arrondissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horraire (id INT AUTO_INCREMENT NOT NULL, centre_de_sante_id INT NOT NULL, specialite_id INT NOT NULL, jour VARCHAR(255) NOT NULL, time_start TIME NOT NULL, time_end TIME NOT NULL, INDEX IDX_3A67A964F0AE38FB (centre_de_sante_id), INDEX IDX_3A67A9642195E0F0 (specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maladie_chronique (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, profil_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9A9C723A275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, telephone INT DEFAULT NULL, telecopie INT NOT NULL, latitude VARCHAR(255) NOT NULL, longitude VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie_profil (pharmacie_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_82255E9FBC6D351B (pharmacie_id), INDEX IDX_82255E9F275ED078 (profil_id), PRIMARY KEY(pharmacie_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, maladie_chronique_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, birth_date DATE NOT NULL, blood_type VARCHAR(3) NOT NULL, picture LONGTEXT DEFAULT NULL, information LONGTEXT DEFAULT NULL, INDEX IDX_E6D6B297A76ED395 (user_id), INDEX IDX_E6D6B297A16109E0 (maladie_chronique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite_centre_de_sante (specialite_id INT NOT NULL, centre_de_sante_id INT NOT NULL, INDEX IDX_394FC1F22195E0F0 (specialite_id), INDEX IDX_394FC1F2F0AE38FB (centre_de_sante_id), PRIMARY KEY(specialite_id, centre_de_sante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE centre_de_sante ADD CONSTRAINT FK_1A01B9AA407DBC11 FOREIGN KEY (arrondissement_id) REFERENCES arrondissement (id)');
        $this->addSql('ALTER TABLE centre_de_sante_profil ADD CONSTRAINT FK_C33F05C2F0AE38FB FOREIGN KEY (centre_de_sante_id) REFERENCES centre_de_sante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE centre_de_sante_profil ADD CONSTRAINT FK_C33F05C2275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hopital ADD CONSTRAINT FK_8718F2C407DBC11 FOREIGN KEY (arrondissement_id) REFERENCES arrondissement (id)');
        $this->addSql('ALTER TABLE horraire ADD CONSTRAINT FK_3A67A964F0AE38FB FOREIGN KEY (centre_de_sante_id) REFERENCES centre_de_sante (id)');
        $this->addSql('ALTER TABLE horraire ADD CONSTRAINT FK_3A67A9642195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE pharmacie_profil ADD CONSTRAINT FK_82255E9FBC6D351B FOREIGN KEY (pharmacie_id) REFERENCES pharmacie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_profil ADD CONSTRAINT FK_82255E9F275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297A16109E0 FOREIGN KEY (maladie_chronique_id) REFERENCES maladie_chronique (id)');
        $this->addSql('ALTER TABLE specialite_centre_de_sante ADD CONSTRAINT FK_394FC1F22195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_centre_de_sante ADD CONSTRAINT FK_394FC1F2F0AE38FB FOREIGN KEY (centre_de_sante_id) REFERENCES centre_de_sante (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE centre_de_sante DROP FOREIGN KEY FK_1A01B9AA407DBC11');
        $this->addSql('ALTER TABLE hopital DROP FOREIGN KEY FK_8718F2C407DBC11');
        $this->addSql('ALTER TABLE centre_de_sante_profil DROP FOREIGN KEY FK_C33F05C2F0AE38FB');
        $this->addSql('ALTER TABLE horraire DROP FOREIGN KEY FK_3A67A964F0AE38FB');
        $this->addSql('ALTER TABLE specialite_centre_de_sante DROP FOREIGN KEY FK_394FC1F2F0AE38FB');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297A16109E0');
        $this->addSql('ALTER TABLE pharmacie_profil DROP FOREIGN KEY FK_82255E9FBC6D351B');
        $this->addSql('ALTER TABLE centre_de_sante_profil DROP FOREIGN KEY FK_C33F05C2275ED078');
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A275ED078');
        $this->addSql('ALTER TABLE pharmacie_profil DROP FOREIGN KEY FK_82255E9F275ED078');
        $this->addSql('ALTER TABLE horraire DROP FOREIGN KEY FK_3A67A9642195E0F0');
        $this->addSql('ALTER TABLE specialite_centre_de_sante DROP FOREIGN KEY FK_394FC1F22195E0F0');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297A76ED395');
        $this->addSql('DROP TABLE arrondissement');
        $this->addSql('DROP TABLE centre_de_sante');
        $this->addSql('DROP TABLE centre_de_sante_profil');
        $this->addSql('DROP TABLE hopital');
        $this->addSql('DROP TABLE horraire');
        $this->addSql('DROP TABLE maladie_chronique');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE pharmacie');
        $this->addSql('DROP TABLE pharmacie_profil');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE specialite_centre_de_sante');
        $this->addSql('DROP TABLE user');
    }
}
