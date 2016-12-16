<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150220000054 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE organismes ADD siren VARCHAR(9) DEFAULT NULL, ADD ape VARCHAR(255) DEFAULT NULL, ADD rna VARCHAR(255) DEFAULT NULL, CHANGE siret siret VARCHAR(14) DEFAULT NULL");
        $this->addSql("ALTER TABLE prestataires ADD id_presentation_doc INT DEFAULT NULL, ADD tva_intracommunautaire VARCHAR(255) NOT NULL, ADD presentation VARCHAR(255) NOT NULL, ADD refs VARCHAR(255) NOT NULL, ADD siren VARCHAR(9) NOT NULL, ADD ape VARCHAR(255) NOT NULL, ADD complement_adresse VARCHAR(255) DEFAULT NULL, CHANGE siret siret VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4F74DEF8F0 FOREIGN KEY (id_presentation_doc) REFERENCES documents (id_document)");
        $this->addSql("CREATE INDEX IDX_F6D6EE4F74DEF8F0 ON prestataires (id_presentation_doc)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE organismes DROP siren, DROP ape, DROP rna, CHANGE siret siret VARCHAR(14) NOT NULL");
        $this->addSql("ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4F74DEF8F0");
        $this->addSql("DROP INDEX IDX_F6D6EE4F74DEF8F0 ON prestataires");
        $this->addSql("ALTER TABLE prestataires DROP id_presentation_doc, DROP tva_intracommunautaire, DROP presentation, DROP refs, DROP siren, DROP ape, DROP complement_adresse, CHANGE siret siret VARCHAR(255) NOT NULL");
    }
}
