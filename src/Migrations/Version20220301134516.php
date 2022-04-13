<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301134516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_bestiary (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, shortname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pathfinder_bestiars_type (pathfinder_bestiary_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', type_bestiary_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_5E3B5FC7E5439273 (pathfinder_bestiary_id), INDEX IDX_5E3B5FC72F7F7398 (type_bestiary_id), PRIMARY KEY(pathfinder_bestiary_id, type_bestiary_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_bestiary (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', category_bestiary_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, shortname VARCHAR(255) NOT NULL, INDEX IDX_5992CE03D3FDE662 (category_bestiary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pathfinder_bestiars_type ADD CONSTRAINT FK_5E3B5FC7E5439273 FOREIGN KEY (pathfinder_bestiary_id) REFERENCES pathfinder_bestiary (id)');
        $this->addSql('ALTER TABLE pathfinder_bestiars_type ADD CONSTRAINT FK_5E3B5FC72F7F7398 FOREIGN KEY (type_bestiary_id) REFERENCES type_bestiary (id)');
        $this->addSql('ALTER TABLE type_bestiary ADD CONSTRAINT FK_5992CE03D3FDE662 FOREIGN KEY (category_bestiary_id) REFERENCES category_bestiary (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_bestiary DROP FOREIGN KEY FK_5992CE03D3FDE662');
        $this->addSql('ALTER TABLE pathfinder_bestiars_type DROP FOREIGN KEY FK_5E3B5FC72F7F7398');
        $this->addSql('DROP TABLE category_bestiary');
        $this->addSql('DROP TABLE pathfinder_bestiars_type');
        $this->addSql('DROP TABLE type_bestiary');
    }
}
