<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704112106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3DA21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_55AE4A3DA21214B7 ON collecte (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte DROP FOREIGN KEY FK_55AE4A3DA21214B7');
        $this->addSql('DROP INDEX IDX_55AE4A3DA21214B7 ON collecte');
        $this->addSql('ALTER TABLE collecte DROP categories_id');
    }
}
