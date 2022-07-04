<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701110845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3DE4D14BD8');
        $this->addSql('DROP INDEX IDX_55AE4A3DE4D14BD8 ON collecte');
        $this->addSql('ALTER TABLE collecte CHANGE collecteurs_id collecteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D1614F182 FOREIGN KEY (collecteur_id) REFERENCES collecteur (id)');
        $this->addSql('CREATE INDEX IDX_55AE4A3D1614F182 ON collecte (collecteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3D1614F182');
        $this->addSql('DROP INDEX IDX_55AE4A3D1614F182 ON collecte');
        $this->addSql('ALTER TABLE collecte CHANGE collecteur_id collecteurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3DE4D14BD8 FOREIGN KEY (collecteurs_id) REFERENCES collecteur (id)');
        $this->addSql('CREATE INDEX IDX_55AE4A3DE4D14BD8 ON collecte (collecteurs_id)');
    }
}
