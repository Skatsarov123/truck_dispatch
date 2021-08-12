<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013120925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cargo (id INT AUTO_INCREMENT NOT NULL, drivers_id INT DEFAULT NULL, truck_id VARCHAR(255) NOT NULL, loading_address VARCHAR(255) NOT NULL, loading_date DATETIME NOT NULL, unloading_address VARCHAR(255) NOT NULL, unloading_date DATETIME NOT NULL, price_per_km NUMERIC(10, 0) NOT NULL, INDEX IDX_3BEE57719E6E47B8 (drivers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, names VARCHAR(255) NOT NULL, trailer VARCHAR(255) NOT NULL, driver_license VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, bank_name VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, egn VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cargo ADD CONSTRAINT FK_3BEE57719E6E47B8 FOREIGN KEY (drivers_id) REFERENCES driver (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cargo DROP FOREIGN KEY FK_3BEE57719E6E47B8');
        $this->addSql('DROP TABLE cargo');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE user');
    }
}
