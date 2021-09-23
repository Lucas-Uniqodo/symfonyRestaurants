<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921130229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu (menuId INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, restaurantId INT DEFAULT NULL, INDEX IDX_7D053A9381DAF313 (restaurantId), PRIMARY KEY(menuId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menuItem (menuItemId INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, menuId INT DEFAULT NULL, INDEX IDX_6AE35DE8B6DD3E9C (menuId), PRIMARY KEY(menuItemId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (restaurantId INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, imageLink VARCHAR(255) NOT NULL, PRIMARY KEY(restaurantId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9381DAF313 FOREIGN KEY (restaurantId) REFERENCES restaurant (restaurantId)');
        $this->addSql('ALTER TABLE menuItem ADD CONSTRAINT FK_6AE35DE8B6DD3E9C FOREIGN KEY (menuId) REFERENCES menu (menuId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menuItem DROP FOREIGN KEY FK_6AE35DE8B6DD3E9C');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9381DAF313');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menuItem');
        $this->addSql('DROP TABLE restaurant');
    }
}
