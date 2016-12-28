<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141123181855 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F53FF1E199");
        $this->addSql("ALTER TABLE consultations ADD CONSTRAINT FK_242D8F53FF1E199 FOREIGN KEY (id_reponse_selectionne) REFERENCES reponses (id_reponse) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F53FF1E199");
        $this->addSql("ALTER TABLE consultations ADD CONSTRAINT FK_242D8F53FF1E199 FOREIGN KEY (id_reponse_selectionne) REFERENCES reponses (id_reponse)");
    }
}
