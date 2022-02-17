<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214151648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pathfinder_bestiary (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, level INT NOT NULL, life_point INT NOT NULL, initiation INT NOT NULL, xp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pathfinder_player (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, life_point INT NOT NULL, initiation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE craft CHANGE operation operation enum(\'OR\', \'AND\')');
        $this->addSql('ALTER TABLE map CHANGE type_affichage type_affichage ENUM(\'mapper\', \'cacher\', \'visible\')');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pathfinder_bestiary');
        $this->addSql('DROP TABLE pathfinder_player');
        $this->addSql('ALTER TABLE craft CHANGE operation operation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE map CHANGE type_affichage type_affichage VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles TEXT NOT NULL');
    }
}
