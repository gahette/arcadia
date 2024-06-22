<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620122548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modification de l\'entité VetReport';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat DROP state');
        $this->addSql('ALTER TABLE vet_report ADD state VARCHAR(128) DEFAULT NULL, ADD food VARCHAR(128) DEFAULT NULL, ADD quantity INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat ADD state VARCHAR(128) DEFAULT NULL');
        $this->addSql('ALTER TABLE vet_report DROP state, DROP food, DROP quantity');
    }
}
