<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609093717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP image');
        $this->addSql('ALTER TABLE image ADD city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F8BAC62AF ON image (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F8BAC62AF');
        $this->addSql('DROP INDEX IDX_C53D045F8BAC62AF ON image');
        $this->addSql('ALTER TABLE image DROP city_id');
    }
}
