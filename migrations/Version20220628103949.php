<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628103949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annuler_collecte (id INT AUTO_INCREMENT NOT NULL, raison VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, note INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_collecte (categorie_id INT NOT NULL, collecte_id INT NOT NULL, INDEX IDX_6D290B57BCF5E72D (categorie_id), INDEX IDX_6D290B57710A9AC6 (collecte_id), PRIMARY KEY(categorie_id, collecte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collecte (id INT AUTO_INCREMENT NOT NULL, utilisateurs_id INT DEFAULT NULL, annuler_collecte_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, inventaire VARCHAR(100) DEFAULT NULL, detail_adresse VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delete_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', accouting_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_55AE4A3D1E969C5 (utilisateurs_id), INDEX IDX_55AE4A3D8E01E29E (annuler_collecte_id), INDEX IDX_55AE4A3D4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, quantite INT NOT NULL, INDEX IDX_52743D7BA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supprimer_compte (id INT AUTO_INCREMENT NOT NULL, utilsateur_id INT DEFAULT NULL, raison VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_EB8CE7D593D451B3 (utilsateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, grade_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, genre VARCHAR(100) NOT NULL, telephone BIGINT NOT NULL, login VARCHAR(100) NOT NULL, point INT DEFAULT NULL, adresse VARCHAR(100) NOT NULL, nombre_collecte DOUBLE PRECISION DEFAULT NULL, matricule VARCHAR(100) DEFAULT NULL, agence VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B3450FF010 (telephone), INDEX IDX_1D1C63B3CCFA12B8 (profile_id), INDEX IDX_1D1C63B3FE19A1A8 (grade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_collecte ADD CONSTRAINT FK_6D290B57BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_collecte ADD CONSTRAINT FK_6D290B57710A9AC6 FOREIGN KEY (collecte_id) REFERENCES collecte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D8E01E29E FOREIGN KEY (annuler_collecte_id) REFERENCES annuler_collecte (id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BA21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE supprimer_compte ADD CONSTRAINT FK_EB8CE7D593D451B3 FOREIGN KEY (utilsateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D4DE7DC5C');
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D8E01E29E');
        $this->addSql('ALTER TABLE categorie_collecte DROP FOREIGN KEY FK_6D290B57BCF5E72D');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BA21214B7');
        $this->addSql('ALTER TABLE categorie_collecte DROP FOREIGN KEY FK_6D290B57710A9AC6');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3FE19A1A8');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3CCFA12B8');
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D1E969C5');
        $this->addSql('ALTER TABLE supprimer_compte DROP FOREIGN KEY FK_EB8CE7D593D451B3');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE annuler_collecte');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_collecte');
        $this->addSql('DROP TABLE collecte');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE supprimer_compte');
        $this->addSql('DROP TABLE utilisateur');
    }
}
