<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221025161421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32EB52E8AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annuler_collecte (id INT AUTO_INCREMENT NOT NULL, raison VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, note INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chartjs (id INT AUTO_INCREMENT NOT NULL, month INT DEFAULT NULL, ncbm INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collecte (id INT AUTO_INCREMENT NOT NULL, utilisateurs_id INT DEFAULT NULL, annuler_collecte_id INT DEFAULT NULL, collecteur_id INT DEFAULT NULL, detail_adresse VARCHAR(255) DEFAULT NULL, create_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', accouting_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', month INT DEFAULT NULL, collected_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', statut VARCHAR(100) DEFAULT NULL, sac JSON DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, INDEX IDX_55AE4A3D1E969C5 (utilisateurs_id), INDEX IDX_55AE4A3D8E01E29E (annuler_collecte_id), INDEX IDX_55AE4A3D1614F182 (collecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collecteur (id INT AUTO_INCREMENT NOT NULL, telephone VARCHAR(50) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, genre VARCHAR(100) NOT NULL, matricule VARCHAR(50) DEFAULT NULL, agence VARCHAR(100) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_517B3AC2450FF010 (telephone), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE save (id INT AUTO_INCREMENT NOT NULL, ncbd INT DEFAULT NULL, date_collecte DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supprimer_compte (id INT AUTO_INCREMENT NOT NULL, utilsateur_id INT DEFAULT NULL, raison VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_EB8CE7D593D451B3 (utilsateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, grade_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, genre VARCHAR(100) NOT NULL, telephone BIGINT NOT NULL, login VARCHAR(100) NOT NULL, point INT DEFAULT NULL, adresse VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3450FF010 (telephone), INDEX IDX_1D1C63B3CCFA12B8 (profile_id), INDEX IDX_1D1C63B3FE19A1A8 (grade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D8E01E29E FOREIGN KEY (annuler_collecte_id) REFERENCES annuler_collecte (id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D1614F182 FOREIGN KEY (collecteur_id) REFERENCES collecteur (id)');
        $this->addSql('ALTER TABLE supprimer_compte ADD CONSTRAINT FK_EB8CE7D593D451B3 FOREIGN KEY (utilsateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D1E969C5');
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D8E01E29E');
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D1614F182');
        $this->addSql('ALTER TABLE supprimer_compte DROP FOREIGN KEY FK_EB8CE7D593D451B3');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3CCFA12B8');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3FE19A1A8');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE annuler_collecte');
        $this->addSql('DROP TABLE chartjs');
        $this->addSql('DROP TABLE collecte');
        $this->addSql('DROP TABLE collecteur');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE save');
        $this->addSql('DROP TABLE supprimer_compte');
        $this->addSql('DROP TABLE utilisateur');
    }
}
