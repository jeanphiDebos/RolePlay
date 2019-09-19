<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190917093616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE capacity_hs (lvl INT NOT NULL, capacity INT DEFAULT 0 NOT NULL, max_type_item_craft INT DEFAULT 0 NOT NULL, PRIMARY KEY(lvl)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, shortname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_character (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', player_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(255) NOT NULL, lvl INT DEFAULT 1 NOT NULL, resource INT DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_939A3DD0F85E0677 (username), UNIQUE INDEX UNIQ_939A3DD099E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE craft (id INT AUTO_INCREMENT NOT NULL, item_source_one_id INT NOT NULL, item_source_two_id INT NOT NULL, item_result_id INT NOT NULL, operation enum(\'OR\', \'AND\'), INDEX IDX_F45C4A84A1C9432E (item_source_one_id), INDEX IDX_F45C4A84CA95A4E1 (item_source_two_id), INDEX IDX_F45C4A84B7DA0B3 (item_result_id), UNIQUE INDEX craft_unique (item_source_one_id, item_source_two_id, operation, item_result_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory (id INT AUTO_INCREMENT NOT NULL, character_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', item_id INT NOT NULL, INDEX IDX_B12D4A361136BE75 (character_id), INDEX IDX_B12D4A36126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cost INT NOT NULL, image VARCHAR(255) NOT NULL, isvisible TINYINT(1) DEFAULT \'0\' NOT NULL, isvalid TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_type (item_id INT NOT NULL, type_item_id INT NOT NULL, INDEX IDX_8B32F9AF126F525E (item_id), INDEX IDX_8B32F9AF3A4E3DAB (type_item_id), PRIMARY KEY(item_id, type_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', weapon_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', skill_parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, cost INT NOT NULL, enable TINYINT(1) NOT NULL, INDEX IDX_5E3DE47795B82273 (weapon_id), INDEX IDX_5E3DE477218BF12D (skill_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_item (id INT AUTO_INCREMENT NOT NULL, category_item_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, shortname VARCHAR(255) NOT NULL, INDEX IDX_C814E016D5B71220 (category_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', weapon_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', character_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', email VARCHAR(180) NOT NULL, name VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6495E237E06 (name), UNIQUE INDEX UNIQ_8D93D64995B82273 (weapon_id), UNIQUE INDEX UNIQ_8D93D6491136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visibility_craft_item (id INT AUTO_INCREMENT NOT NULL, character_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', craft_id INT NOT NULL, isvalid TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_C65A6C3D1136BE75 (character_id), INDEX IDX_C65A6C3DE836CCC8 (craft_id), UNIQUE INDEX visibility_craft_item_unique (character_id, craft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', player_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6933A7E699E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD099E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A84A1C9432E FOREIGN KEY (item_source_one_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A84CA95A4E1 FOREIGN KEY (item_source_two_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A84B7DA0B3 FOREIGN KEY (item_result_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A361136BE75 FOREIGN KEY (character_id) REFERENCES user_character (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE items_type ADD CONSTRAINT FK_8B32F9AF126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE items_type ADD CONSTRAINT FK_8B32F9AF3A4E3DAB FOREIGN KEY (type_item_id) REFERENCES type_item (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47795B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477218BF12D FOREIGN KEY (skill_parent_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE type_item ADD CONSTRAINT FK_C814E016D5B71220 FOREIGN KEY (category_item_id) REFERENCES category_item (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64995B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491136BE75 FOREIGN KEY (character_id) REFERENCES user_character (id)');
        $this->addSql('ALTER TABLE visibility_craft_item ADD CONSTRAINT FK_C65A6C3D1136BE75 FOREIGN KEY (character_id) REFERENCES user_character (id)');
        $this->addSql('ALTER TABLE visibility_craft_item ADD CONSTRAINT FK_C65A6C3DE836CCC8 FOREIGN KEY (craft_id) REFERENCES craft (id)');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E699E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_item DROP FOREIGN KEY FK_C814E016D5B71220');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A361136BE75');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491136BE75');
        $this->addSql('ALTER TABLE visibility_craft_item DROP FOREIGN KEY FK_C65A6C3D1136BE75');
        $this->addSql('ALTER TABLE visibility_craft_item DROP FOREIGN KEY FK_C65A6C3DE836CCC8');
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A84A1C9432E');
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A84CA95A4E1');
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A84B7DA0B3');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A36126F525E');
        $this->addSql('ALTER TABLE items_type DROP FOREIGN KEY FK_8B32F9AF126F525E');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477218BF12D');
        $this->addSql('ALTER TABLE items_type DROP FOREIGN KEY FK_8B32F9AF3A4E3DAB');
        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD099E6F5DF');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E699E6F5DF');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47795B82273');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64995B82273');
        $this->addSql('DROP TABLE capacity_hs');
        $this->addSql('DROP TABLE category_item');
        $this->addSql('DROP TABLE user_character');
        $this->addSql('DROP TABLE craft');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE items_type');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE type_item');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visibility_craft_item');
        $this->addSql('DROP TABLE weapon');
    }
}
