<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150209134556 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE prestataire_tag (prestataire_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_3DE6C48DBE3DB2B7 (prestataire_id), INDEX IDX_3DE6C48DBAD26311 (tag_id), PRIMARY KEY(prestataire_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE prestataire_tag ADD CONSTRAINT FK_3DE6C48DBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataires (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE prestataire_tag ADD CONSTRAINT FK_3DE6C48DBAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE organismes ADD complement_adresse VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE prestataire_tag DROP FOREIGN KEY FK_3DE6C48DBAD26311");
        $this->addSql("DROP TABLE prestataire_tag");
        $this->addSql("DROP TABLE tags");
        $this->addSql("ALTER TABLE organismes DROP complement_adresse");
    }
}
