<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240622142838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Complément entité User';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FA76ED395 ON animal (user_id)');
        $this->addSql('ALTER TABLE food_consumption ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food_consumption ADD CONSTRAINT FK_8D49FB37A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_8D49FB37A76ED395 ON food_consumption (user_id)');
        $this->addSql('ALTER TABLE habitat ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E8A76ED395 ON habitat (user_id)');
        $this->addSql('ALTER TABLE opening_hour ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE opening_hour ADD CONSTRAINT FK_969BD765A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_969BD765A76ED395 ON opening_hour (user_id)');
        $this->addSql('ALTER TABLE service ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2A76ED395 ON service (user_id)');
        $this->addSql('ALTER TABLE testimonial ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E6BDCDF7A76ED395 ON testimonial (user_id)');
        $this->addSql('ALTER TABLE vet_report ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vet_report ADD CONSTRAINT FK_86438951A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_86438951A76ED395 ON vet_report (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA76ED395');
        $this->addSql('DROP INDEX IDX_6AAB231FA76ED395 ON animal');
        $this->addSql('ALTER TABLE animal DROP user_id');
        $this->addSql('ALTER TABLE vet_report DROP FOREIGN KEY FK_86438951A76ED395');
        $this->addSql('DROP INDEX IDX_86438951A76ED395 ON vet_report');
        $this->addSql('ALTER TABLE vet_report DROP user_id');
        $this->addSql('ALTER TABLE testimonial DROP FOREIGN KEY FK_E6BDCDF7A76ED395');
        $this->addSql('DROP INDEX IDX_E6BDCDF7A76ED395 ON testimonial');
        $this->addSql('ALTER TABLE testimonial DROP user_id');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2A76ED395');
        $this->addSql('DROP INDEX IDX_E19D9AD2A76ED395 ON service');
        $this->addSql('ALTER TABLE service DROP user_id');
        $this->addSql('ALTER TABLE opening_hour DROP FOREIGN KEY FK_969BD765A76ED395');
        $this->addSql('DROP INDEX IDX_969BD765A76ED395 ON opening_hour');
        $this->addSql('ALTER TABLE opening_hour DROP user_id');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8A76ED395');
        $this->addSql('DROP INDEX IDX_3B37B2E8A76ED395 ON habitat');
        $this->addSql('ALTER TABLE habitat DROP user_id');
        $this->addSql('ALTER TABLE food_consumption DROP FOREIGN KEY FK_8D49FB37A76ED395');
        $this->addSql('DROP INDEX IDX_8D49FB37A76ED395 ON food_consumption');
        $this->addSql('ALTER TABLE food_consumption DROP user_id');
    }
}
