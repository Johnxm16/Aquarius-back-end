<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704111341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorie_collecte');
        $this->addSql('ALTER TABLE collecte DROP inventaire');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_collecte (categorie_id INT NOT NULL, collecte_id INT NOT NULL, INDEX IDX_6D290B57710A9AC6 (collecte_id), INDEX IDX_6D290B57BCF5E72D (categorie_id), PRIMARY KEY(categorie_id, collecte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_collecte ADD CONSTRAINT FK_6D290B57BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_collecte ADD CONSTRAINT FK_6D290B57710A9AC6 FOREIGN KEY (collecte_id) REFERENCES collecte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collecte ADD inventaire VARCHAR(100) DEFAULT NULL');
    }
}
