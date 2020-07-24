<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200721072845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE FUNCTION category_materialized() RETURNS trigger
                           LANGUAGE plpgsql AS
                        $$BEGIN
                           IF TG_OP = \'INSERT\' THEN
                              REFRESH MATERIALIZED VIEW category_materialized;
                               
                              RETURN NEW;
                           ELSE
                              REFRESH MATERIALIZED VIEW category_materialized;
                              
                              RETURN NULL;
                           END IF;
                        END;$$');

        $this->addSql('CREATE CONSTRAINT TRIGGER category_materialized_mod
                           AFTER INSERT OR DELETE ON category
                           DEFERRABLE INITIALLY DEFERRED
                           FOR EACH ROW EXECUTE PROCEDURE category_materialized()');
        $this->addSql('CREATE TRIGGER category_materialized_trunc AFTER TRUNCATE ON category
                           FOR EACH STATEMENT EXECUTE PROCEDURE category_materialized()');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TRIGGER IF EXISTS category_materialized_trunc on category');
        $this->addSql('DROP TRIGGER IF EXISTS category_materialized_mod on category');
        $this->addSql('DROP FUNCTION IF EXISTS category_materialized()');

    }
}
