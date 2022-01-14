<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220107225844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonne (id INT AUTO_INCREMENT NOT NULL, formule_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, tel_mobile VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, num_permis VARCHAR(255) NOT NULL, lieu_permis VARCHAR(255) NOT NULL, date_permis VARCHAR(255) NOT NULL, paiement_adhesion VARCHAR(255) NOT NULL, paiement_caution VARCHAR(255) NOT NULL, rib_fourni VARCHAR(255) NOT NULL, INDEX IDX_76328BF02A68F4D1 (formule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_vehicule (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formule (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, frais_adhesion NUMERIC(10, 2) NOT NULL, tarif_mensuel NUMERIC(10, 2) NOT NULL, part_sociale NUMERIC(10, 2) NOT NULL, depot_garantie NUMERIC(10, 2) NOT NULL, caution NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tranche_horaire (id INT AUTO_INCREMENT NOT NULL, duree DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tranche_km (id INT AUTO_INCREMENT NOT NULL, min_km BIGINT NOT NULL, max_km BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonne ADD CONSTRAINT FK_76328BF02A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonne DROP FOREIGN KEY FK_76328BF02A68F4D1');
        $this->addSql('DROP TABLE abonne');
        $this->addSql('DROP TABLE categorie_vehicule');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE tranche_horaire');
        $this->addSql('DROP TABLE tranche_km');
    }
}
