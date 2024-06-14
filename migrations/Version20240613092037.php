<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613092037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '3 - Complément de l\'entité Image';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD name VARCHAR(128) NOT NULL, ADD slug VARCHAR(128) NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F989D9B62 ON image (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C53D045F989D9B62 ON image');
        $this->addSql('ALTER TABLE image DROP name, DROP slug, DROP description, DROP created_at, DROP updated_at');
    }
}
