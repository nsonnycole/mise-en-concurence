<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150409131841 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE organismes CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(50) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE prenom_contact prenom_contact VARCHAR(255) DEFAULT NULL, CHANGE nom_contact nom_contact VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE organismes CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE code_postal code_postal VARCHAR(50) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE prenom_contact prenom_contact VARCHAR(255) NOT NULL, CHANGE nom_contact nom_contact VARCHAR(255) NOT NULL");
    }
}
