<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629133231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collecteur (id INT AUTO_INCREMENT NOT NULL, telephone BIGINT NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, genre VARCHAR(100) NOT NULL, matricule VARCHAR(50) DEFAULT NULL, agence VARCHAR(100) DEFAULT NULL, nombre_collecte BIGINT DEFAULT NULL, UNIQUE INDEX UNIQ_517B3AC2450FF010 (telephone), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collecte ADD collecteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D1614F182 FOREIGN KEY (collecteur_id) REFERENCES collecteur (id)');
        $this->addSql('CREATE INDEX IDX_55AE4A3D1614F182 ON collecte (collecteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D1614F182');
        $this->addSql('DROP TABLE collecteur');
        $this->addSql('DROP INDEX IDX_55AE4A3D1614F182 ON collecte');
        $this->addSql('ALTER TABLE collecte DROP collecteur_id');
    }
}
