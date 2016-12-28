<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160126230518 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE administrateurs (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprises (id INT AUTO_INCREMENT NOT NULL, siren VARCHAR(9) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_categories_prestataires (presta_id INT NOT NULL, cat_presta_id INT NOT NULL, INDEX IDX_E8EAF14DBA2F97F0 (presta_id), INDEX IDX_E8EAF14D5578AF9F (cat_presta_id), PRIMARY KEY(presta_id, cat_presta_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateurs ADD CONSTRAINT FK_B5ED4E13BF396750 FOREIGN KEY (id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_categories_prestataires ADD CONSTRAINT FK_E8EAF14DBA2F97F0 FOREIGN KEY (presta_id) REFERENCES prestataires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_categories_prestataires ADD CONSTRAINT FK_E8EAF14D5578AF9F FOREIGN KEY (cat_presta_id) REFERENCES categories_prestataires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateurs ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AE5D3AF914');
        $this->addSql('DROP INDEX IDX_232710AE5D3AF914 ON invitations');
        $this->addSql('ALTER TABLE invitations ADD type_invitation SMALLINT NOT NULL, ADD status SMALLINT NOT NULL, CHANGE id_organisme id_utilisateur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AE50EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_232710AE50EAE44 ON invitations (id_utilisateur)');
        $this->addSql('ALTER TABLE organismes ADD entreprise_id INT DEFAULT NULL, DROP siren');
        $this->addSql('ALTER TABLE organismes ADD CONSTRAINT FK_A403A158A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
        $this->addSql('CREATE INDEX IDX_A403A158A4AEAFEA ON organismes (entreprise_id)');
        $this->addSql('ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4FC9486A13');
        $this->addSql('DROP INDEX IDX_F6D6EE4FC9486A13 ON prestataires');
        $this->addSql('ALTER TABLE prestataires DROP siren, CHANGE id_categorie entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
        $this->addSql('CREATE INDEX IDX_F6D6EE4FA4AEAFEA ON prestataires (entreprise_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE organismes DROP FOREIGN KEY FK_A403A158A4AEAFEA');
        $this->addSql('ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4FA4AEAFEA');
        $this->addSql('DROP TABLE administrateurs');
        $this->addSql('DROP TABLE entreprises');
        $this->addSql('DROP TABLE liste_categories_prestataires');
        $this->addSql('ALTER TABLE invitations DROP FOREIGN KEY FK_232710AE50EAE44');
        $this->addSql('DROP INDEX IDX_232710AE50EAE44 ON invitations');
        $this->addSql('ALTER TABLE invitations DROP type_invitation, DROP status, CHANGE id_utilisateur id_organisme INT DEFAULT NULL');
        $this->addSql('ALTER TABLE invitations ADD CONSTRAINT FK_232710AE5D3AF914 FOREIGN KEY (id_organisme) REFERENCES organismes (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_232710AE5D3AF914 ON invitations (id_organisme)');
        $this->addSql('DROP INDEX IDX_A403A158A4AEAFEA ON organismes');
        $this->addSql('ALTER TABLE organismes ADD siren VARCHAR(9) DEFAULT NULL COLLATE utf8_unicode_ci, DROP entreprise_id');
        $this->addSql('DROP INDEX IDX_F6D6EE4FA4AEAFEA ON prestataires');
        $this->addSql('ALTER TABLE prestataires ADD siren VARCHAR(9) NOT NULL COLLATE utf8_unicode_ci, CHANGE entreprise_id id_categorie INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4FC9486A13 FOREIGN KEY (id_categorie) REFERENCES categories_prestataires (id)');
        $this->addSql('CREATE INDEX IDX_F6D6EE4FC9486A13 ON prestataires (id_categorie)');
        $this->addSql('ALTER TABLE utilisateurs DROP roles');
    }
}
