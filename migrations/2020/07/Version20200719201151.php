<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200719201151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Table to save data from api';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, category_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, is_first_level BOOLEAN NOT NULL, sub_categories_ids  TEXT DEFAULT NULL, icon_prefix VARCHAR(255) NOT NULL, icon_suffix VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.sub_categories_ids IS \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX category_category_id ON category(category_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
    }
}
