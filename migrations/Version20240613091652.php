<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613091652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '2 - Création de l\'entité image';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, habitat_id INT NOT NULL, user_id INT NOT NULL, priority INT DEFAULT NULL, path VARCHAR(128) NOT NULL, size DOUBLE PRECISION NOT NULL, INDEX IDX_C53D045F8E962C16 (animal_id), INDEX IDX_C53D045FAFFE2D26 (habitat_id), INDEX IDX_C53D045FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F8E962C16');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FAFFE2D26');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FA76ED395');
        $this->addSql('DROP TABLE image');
    }
}
