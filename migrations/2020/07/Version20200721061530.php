<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200721061530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE MATERIALIZED VIEW category_materialized AS
            SELECT *
            FROM category;
        ');
        $this->addSql('CREATE INDEX category_materialized_category_id_index ON category_materialized(category_id)');


    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP MATERIALIZED VIEW IF EXISTS category_materialized CASCADE');
    }
}
