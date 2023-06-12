<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609133600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_C53D045F8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE city DROP image');
        $this->addSql('ALTER TABLE country ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C9663DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C9663DA5256D ON country (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C9663DA5256D');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F8BAC62AF');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE city ADD image VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_5373C9663DA5256D ON country');
        $this->addSql('ALTER TABLE country ADD image VARCHAR(255) NOT NULL, DROP image_id');
    }
}
