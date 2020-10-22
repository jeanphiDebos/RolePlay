<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003132550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bestiary (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', universe_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, hide TINYINT(1) NOT NULL, INDEX IDX_946DE9FF5CD9AF2 (universe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capacity_hs (lvl INT NOT NULL, capacity INT DEFAULT 0 NOT NULL, max_type_item_craft INT DEFAULT 0 NOT NULL, PRIMARY KEY(lvl)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_item (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, shortname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_character (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', player_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(150) NOT NULL, lvl INT DEFAULT 1 NOT NULL, resource INT DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_939A3DD0F85E0677 (username), UNIQUE INDEX UNIQ_939A3DD099E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration_field (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', universe_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_C5F4838D5CD9AF2 (universe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE craft (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', item_source_one_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', item_source_two_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', item_result_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', operation enum(\'OR\', \'AND\'), INDEX IDX_F45C4A84A1C9432E (item_source_one_id), INDEX IDX_F45C4A84CA95A4E1 (item_source_two_id), INDEX IDX_F45C4A84B7DA0B3 (item_result_id), UNIQUE INDEX craft_unique (item_source_one_id, item_source_two_id, operation, item_result_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field_bestiary (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', configuration_field_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', bestiary_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', value VARCHAR(255) DEFAULT NULL, INDEX IDX_42556E3225D2B0AB (configuration_field_id), INDEX IDX_42556E326466A409 (bestiary_id), UNIQUE INDEX field_player_unique (configuration_field_id, bestiary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field_player (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', configuration_field_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', player_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', value VARCHAR(255) DEFAULT NULL, INDEX IDX_B25DF66725D2B0AB (configuration_field_id), INDEX IDX_B25DF66799E6F5DF (player_id), UNIQUE INDEX field_player_unique (configuration_field_id, player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventory (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', character_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', item_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_B12D4A361136BE75 (character_id), INDEX IDX_B12D4A36126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cost INT NOT NULL, image VARCHAR(255) NOT NULL, isvisible TINYINT(1) DEFAULT \'0\' NOT NULL, isvalid TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_type (item_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', type_item_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_8B32F9AF126F525E (item_id), INDEX IDX_8B32F9AF3A4E3DAB (type_item_id), PRIMARY KEY(item_id, type_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', universe_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, display TINYINT(1) NOT NULL, vertical_axis INT NOT NULL, horizontal_axis INT NOT NULL, INDEX IDX_93ADAABB5CD9AF2 (universe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mapping_map (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', map_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', vertical_axis INT NOT NULL, horizontal_axis INT NOT NULL, INDEX IDX_6A51F7C453C55F64 (map_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', universe_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, INDEX IDX_98197A655CD9AF2 (universe_id), INDEX IDX_98197A65A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', weapon_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', skill_parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, cost INT NOT NULL, enable TINYINT(1) NOT NULL, INDEX IDX_5E3DE47795B82273 (weapon_id), INDEX IDX_5E3DE477218BF12D (skill_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_item (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', category_item_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, shortname VARCHAR(255) NOT NULL, INDEX IDX_C814E016D5B71220 (category_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE universe (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, display TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', weapon_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', character_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', email VARCHAR(180) NOT NULL, name VARCHAR(150) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6495E237E06 (name), UNIQUE INDEX UNIQ_8D93D64995B82273 (weapon_id), UNIQUE INDEX UNIQ_8D93D6491136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visibility_craft_item (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', character_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', craft_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', isvalid TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX IDX_C65A6C3D1136BE75 (character_id), INDEX IDX_C65A6C3DE836CCC8 (craft_id), UNIQUE INDEX visibility_craft_item_unique (character_id, craft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', player_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6933A7E699E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE whisper (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', for_player_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', to_player_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', whisp VARCHAR(255) NOT NULL, isread TINYINT(1) NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_4FDC41006A1A67FE (for_player_id), INDEX IDX_4FDC4100A84522AE (to_player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bestiary ADD CONSTRAINT FK_946DE9FF5CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id)');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD099E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE configuration_field ADD CONSTRAINT FK_C5F4838D5CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id)');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A84A1C9432E FOREIGN KEY (item_source_one_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A84CA95A4E1 FOREIGN KEY (item_source_two_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A84B7DA0B3 FOREIGN KEY (item_result_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE field_bestiary ADD CONSTRAINT FK_42556E3225D2B0AB FOREIGN KEY (configuration_field_id) REFERENCES configuration_field (id)');
        $this->addSql('ALTER TABLE field_bestiary ADD CONSTRAINT FK_42556E326466A409 FOREIGN KEY (bestiary_id) REFERENCES bestiary (id)');
        $this->addSql('ALTER TABLE field_player ADD CONSTRAINT FK_B25DF66725D2B0AB FOREIGN KEY (configuration_field_id) REFERENCES configuration_field (id)');
        $this->addSql('ALTER TABLE field_player ADD CONSTRAINT FK_B25DF66799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A361136BE75 FOREIGN KEY (character_id) REFERENCES user_character (id)');
        $this->addSql('ALTER TABLE inventory ADD CONSTRAINT FK_B12D4A36126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE items_type ADD CONSTRAINT FK_8B32F9AF126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE items_type ADD CONSTRAINT FK_8B32F9AF3A4E3DAB FOREIGN KEY (type_item_id) REFERENCES type_item (id)');
        $this->addSql('ALTER TABLE map ADD CONSTRAINT FK_93ADAABB5CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id)');
        $this->addSql('ALTER TABLE mapping_map ADD CONSTRAINT FK_6A51F7C453C55F64 FOREIGN KEY (map_id) REFERENCES map (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A655CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47795B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477218BF12D FOREIGN KEY (skill_parent_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE type_item ADD CONSTRAINT FK_C814E016D5B71220 FOREIGN KEY (category_item_id) REFERENCES category_item (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64995B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491136BE75 FOREIGN KEY (character_id) REFERENCES user_character (id)');
        $this->addSql('ALTER TABLE visibility_craft_item ADD CONSTRAINT FK_C65A6C3D1136BE75 FOREIGN KEY (character_id) REFERENCES user_character (id)');
        $this->addSql('ALTER TABLE visibility_craft_item ADD CONSTRAINT FK_C65A6C3DE836CCC8 FOREIGN KEY (craft_id) REFERENCES craft (id)');
        $this->addSql('ALTER TABLE weapon ADD CONSTRAINT FK_6933A7E699E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE whisper ADD CONSTRAINT FK_4FDC41006A1A67FE FOREIGN KEY (for_player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE whisper ADD CONSTRAINT FK_4FDC4100A84522AE FOREIGN KEY (to_player_id) REFERENCES player (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE field_bestiary DROP FOREIGN KEY FK_42556E326466A409');
        $this->addSql('ALTER TABLE type_item DROP FOREIGN KEY FK_C814E016D5B71220');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A361136BE75');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491136BE75');
        $this->addSql('ALTER TABLE visibility_craft_item DROP FOREIGN KEY FK_C65A6C3D1136BE75');
        $this->addSql('ALTER TABLE field_bestiary DROP FOREIGN KEY FK_42556E3225D2B0AB');
        $this->addSql('ALTER TABLE field_player DROP FOREIGN KEY FK_B25DF66725D2B0AB');
        $this->addSql('ALTER TABLE visibility_craft_item DROP FOREIGN KEY FK_C65A6C3DE836CCC8');
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A84A1C9432E');
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A84CA95A4E1');
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A84B7DA0B3');
        $this->addSql('ALTER TABLE inventory DROP FOREIGN KEY FK_B12D4A36126F525E');
        $this->addSql('ALTER TABLE items_type DROP FOREIGN KEY FK_8B32F9AF126F525E');
        $this->addSql('ALTER TABLE mapping_map DROP FOREIGN KEY FK_6A51F7C453C55F64');
        $this->addSql('ALTER TABLE field_player DROP FOREIGN KEY FK_B25DF66799E6F5DF');
        $this->addSql('ALTER TABLE whisper DROP FOREIGN KEY FK_4FDC41006A1A67FE');
        $this->addSql('ALTER TABLE whisper DROP FOREIGN KEY FK_4FDC4100A84522AE');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477218BF12D');
        $this->addSql('ALTER TABLE items_type DROP FOREIGN KEY FK_8B32F9AF3A4E3DAB');
        $this->addSql('ALTER TABLE bestiary DROP FOREIGN KEY FK_946DE9FF5CD9AF2');
        $this->addSql('ALTER TABLE configuration_field DROP FOREIGN KEY FK_C5F4838D5CD9AF2');
        $this->addSql('ALTER TABLE map DROP FOREIGN KEY FK_93ADAABB5CD9AF2');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A655CD9AF2');
        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD099E6F5DF');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65A76ED395');
        $this->addSql('ALTER TABLE weapon DROP FOREIGN KEY FK_6933A7E699E6F5DF');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47795B82273');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64995B82273');
        $this->addSql('DROP TABLE bestiary');
        $this->addSql('DROP TABLE capacity_hs');
        $this->addSql('DROP TABLE category_item');
        $this->addSql('DROP TABLE user_character');
        $this->addSql('DROP TABLE configuration_field');
        $this->addSql('DROP TABLE craft');
        $this->addSql('DROP TABLE field_bestiary');
        $this->addSql('DROP TABLE field_player');
        $this->addSql('DROP TABLE inventory');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE items_type');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE mapping_map');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE type_item');
        $this->addSql('DROP TABLE universe');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visibility_craft_item');
        $this->addSql('DROP TABLE weapon');
        $this->addSql('DROP TABLE whisper');
    }
}
