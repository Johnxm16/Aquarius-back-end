<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726101213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collecte (id INT AUTO_INCREMENT NOT NULL, utilisateurs_id INT DEFAULT NULL, annuler_collecte_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, collecteur_id INT DEFAULT NULL, detail_adresse VARCHAR(255) DEFAULT NULL, create_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', accouting_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', month INT DEFAULT NULL, collected_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_55AE4A3D1E969C5 (utilisateurs_id), INDEX IDX_55AE4A3D8E01E29E (annuler_collecte_id), INDEX IDX_55AE4A3D4DE7DC5C (adresse_id), INDEX IDX_55AE4A3D1614F182 (collecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D8E01E29E FOREIGN KEY (annuler_collecte_id) REFERENCES annuler_collecte (id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D1614F182 FOREIGN KEY (collecteur_id) REFERENCES collecteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE collecte');
    }
}
