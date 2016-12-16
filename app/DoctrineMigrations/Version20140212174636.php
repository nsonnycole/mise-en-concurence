<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140212174636 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, salt VARCHAR(80) NOT NULL, password VARCHAR(80) NOT NULL, date_inscription DATETIME NOT NULL, email_validation_token VARCHAR(80) DEFAULT NULL, email_valide TINYINT(1) NOT NULL, reset_token VARCHAR(128) DEFAULT NULL, reset_date DATETIME DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE categories_organismes (id INT AUTO_INCREMENT NOT NULL, id_categorie_parent INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_58DE15058229FA7 (id_categorie_parent), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE categories_prestataires (id INT AUTO_INCREMENT NOT NULL, id_categorie_parent INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_48D3845958229FA7 (id_categorie_parent), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE consultations (id_consultation INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, id_organisme INT DEFAULT NULL, id_reponse_selectionne INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_limite DATETIME NOT NULL, prix_min INT DEFAULT NULL, prix_max INT DEFAULT NULL, periode_debut VARCHAR(255) DEFAULT NULL, date_debut DATETIME DEFAULT NULL, periode_livraison VARCHAR(255) DEFAULT NULL, date_livraison DATETIME DEFAULT NULL, experience_requises VARCHAR(255) DEFAULT NULL, certification_requise TINYINT(1) NOT NULL, certifications VARCHAR(255) DEFAULT NULL, statut INT NOT NULL, date_creation DATETIME NOT NULL, date_update DATETIME NOT NULL, INDEX IDX_242D8F53BCF5E72D (categorie_id), INDEX IDX_242D8F535D3AF914 (id_organisme), INDEX IDX_242D8F53FF1E199 (id_reponse_selectionne), PRIMARY KEY(id_consultation)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE consultations_documents (id_consultation INT NOT NULL, id_document INT NOT NULL, INDEX IDX_5D624B48B587F0D4 (id_consultation), INDEX IDX_5D624B4888B266E3 (id_document), PRIMARY KEY(id_consultation, id_document)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE documents (id_document INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) NOT NULL, date_upload DATETIME NOT NULL, PRIMARY KEY(id_document)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE invitations (id_invitation INT AUTO_INCREMENT NOT NULL, id_organisme INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_invitation DATETIME NOT NULL, token VARCHAR(32) NOT NULL, INDEX IDX_232710AE5D3AF914 (id_organisme), PRIMARY KEY(id_invitation)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE reponses_devis (id_reponse_devis INT AUTO_INCREMENT NOT NULL, id_reponse INT DEFAULT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, quantite INT NOT NULL, prix_unitaire INT NOT NULL, taux_tva VARCHAR(5) NOT NULL, INDEX IDX_DD56A3C6812B77B7 (id_reponse), PRIMARY KEY(id_reponse_devis)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE organismes (id INT NOT NULL, categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(14) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(50) NOT NULL, ville VARCHAR(255) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, mobile VARCHAR(15) DEFAULT NULL, prenom_contact VARCHAR(255) NOT NULL, nom_contact VARCHAR(255) NOT NULL, INDEX IDX_A403A158BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE organismes_prestataires (id_organisme INT NOT NULL, id_prestataire INT NOT NULL, INDEX IDX_25065C275D3AF914 (id_organisme), INDEX IDX_25065C2778B0A977 (id_prestataire), PRIMARY KEY(id_organisme, id_prestataire)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE prestataires (id INT NOT NULL, id_categorie INT DEFAULT NULL, id_urssaf INT DEFAULT NULL, id_impots INT DEFAULT NULL, id_kbis INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, perimetre_intervention VARCHAR(80) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, prenom_contact VARCHAR(255) NOT NULL, nom_contact VARCHAR(255) NOT NULL, INDEX IDX_F6D6EE4FC9486A13 (id_categorie), INDEX IDX_F6D6EE4FB8027C63 (id_urssaf), INDEX IDX_F6D6EE4F734749D5 (id_impots), INDEX IDX_F6D6EE4F70235C3A (id_kbis), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE reponses_questions (id_question INT AUTO_INCREMENT NOT NULL, id_reponse INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, date_question DATETIME NOT NULL, question LONGTEXT NOT NULL, date_reponse DATETIME DEFAULT NULL, reponse_organisme LONGTEXT DEFAULT NULL, INDEX IDX_56BFC6D4812B77B7 (id_reponse), PRIMARY KEY(id_question)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE reponses (id_reponse INT AUTO_INCREMENT NOT NULL, id_consultation INT DEFAULT NULL, id_prestataire INT DEFAULT NULL, id_devis INT DEFAULT NULL, date_reponse DATETIME DEFAULT NULL, periode_debut VARCHAR(255) DEFAULT NULL, date_debut DATETIME DEFAULT NULL, periode_livraison VARCHAR(255) DEFAULT NULL, date_livraison DATETIME DEFAULT NULL, certification_presente TINYINT(1) DEFAULT NULL, certification VARCHAR(255) DEFAULT NULL, montant_ht INT DEFAULT NULL, montant_ttc INT DEFAULT NULL, has_devis TINYINT(1) DEFAULT NULL, statut INT NOT NULL, INDEX IDX_1E512EC6B587F0D4 (id_consultation), INDEX IDX_1E512EC678B0A977 (id_prestataire), INDEX IDX_1E512EC665A2841B (id_devis), PRIMARY KEY(id_reponse)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE reponses_documents (id_reponse INT NOT NULL, id_document INT NOT NULL, INDEX IDX_7ED3E089812B77B7 (id_reponse), INDEX IDX_7ED3E08988B266E3 (id_document), PRIMARY KEY(id_reponse, id_document)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE categories_organismes ADD CONSTRAINT FK_58DE15058229FA7 FOREIGN KEY (id_categorie_parent) REFERENCES categories_organismes (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE categories_prestataires ADD CONSTRAINT FK_48D3845958229FA7 FOREIGN KEY (id_categorie_parent) REFERENCES categories_prestataires (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE consultations ADD CONSTRAINT FK_242D8F53BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories_prestataires (id)");
        $this->addSql("ALTER TABLE consultations ADD CONSTRAINT FK_242D8F535D3AF914 FOREIGN KEY (id_organisme) REFERENCES organismes (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE consultations ADD CONSTRAINT FK_242D8F53FF1E199 FOREIGN KEY (id_reponse_selectionne) REFERENCES reponses (id_reponse)");
        $this->addSql("ALTER TABLE consultations_documents ADD CONSTRAINT FK_5D624B48B587F0D4 FOREIGN KEY (id_consultation) REFERENCES consultations (id_consultation) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE consultations_documents ADD CONSTRAINT FK_5D624B4888B266E3 FOREIGN KEY (id_document) REFERENCES documents (id_document)");
        $this->addSql("ALTER TABLE invitations ADD CONSTRAINT FK_232710AE5D3AF914 FOREIGN KEY (id_organisme) REFERENCES organismes (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE reponses_devis ADD CONSTRAINT FK_DD56A3C6812B77B7 FOREIGN KEY (id_reponse) REFERENCES reponses (id_reponse)");
        $this->addSql("ALTER TABLE organismes ADD CONSTRAINT FK_A403A158BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories_organismes (id)");
        $this->addSql("ALTER TABLE organismes ADD CONSTRAINT FK_A403A158BF396750 FOREIGN KEY (id) REFERENCES utilisateurs (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE organismes_prestataires ADD CONSTRAINT FK_25065C275D3AF914 FOREIGN KEY (id_organisme) REFERENCES organismes (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE organismes_prestataires ADD CONSTRAINT FK_25065C2778B0A977 FOREIGN KEY (id_prestataire) REFERENCES prestataires (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4FC9486A13 FOREIGN KEY (id_categorie) REFERENCES categories_prestataires (id)");
        $this->addSql("ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4FB8027C63 FOREIGN KEY (id_urssaf) REFERENCES documents (id_document)");
        $this->addSql("ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4F734749D5 FOREIGN KEY (id_impots) REFERENCES documents (id_document)");
        $this->addSql("ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4F70235C3A FOREIGN KEY (id_kbis) REFERENCES documents (id_document)");
        $this->addSql("ALTER TABLE prestataires ADD CONSTRAINT FK_F6D6EE4FBF396750 FOREIGN KEY (id) REFERENCES utilisateurs (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE reponses_questions ADD CONSTRAINT FK_56BFC6D4812B77B7 FOREIGN KEY (id_reponse) REFERENCES reponses (id_reponse)");
        $this->addSql("ALTER TABLE reponses ADD CONSTRAINT FK_1E512EC6B587F0D4 FOREIGN KEY (id_consultation) REFERENCES consultations (id_consultation) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE reponses ADD CONSTRAINT FK_1E512EC678B0A977 FOREIGN KEY (id_prestataire) REFERENCES prestataires (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE reponses ADD CONSTRAINT FK_1E512EC665A2841B FOREIGN KEY (id_devis) REFERENCES documents (id_document)");
        $this->addSql("ALTER TABLE reponses_documents ADD CONSTRAINT FK_7ED3E089812B77B7 FOREIGN KEY (id_reponse) REFERENCES reponses (id_reponse) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE reponses_documents ADD CONSTRAINT FK_7ED3E08988B266E3 FOREIGN KEY (id_document) REFERENCES documents (id_document)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE organismes DROP FOREIGN KEY FK_A403A158BF396750");
        $this->addSql("ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4FBF396750");
        $this->addSql("ALTER TABLE categories_organismes DROP FOREIGN KEY FK_58DE15058229FA7");
        $this->addSql("ALTER TABLE organismes DROP FOREIGN KEY FK_A403A158BCF5E72D");
        $this->addSql("ALTER TABLE categories_prestataires DROP FOREIGN KEY FK_48D3845958229FA7");
        $this->addSql("ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F53BCF5E72D");
        $this->addSql("ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4FC9486A13");
        $this->addSql("ALTER TABLE consultations_documents DROP FOREIGN KEY FK_5D624B48B587F0D4");
        $this->addSql("ALTER TABLE reponses DROP FOREIGN KEY FK_1E512EC6B587F0D4");
        $this->addSql("ALTER TABLE consultations_documents DROP FOREIGN KEY FK_5D624B4888B266E3");
        $this->addSql("ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4FB8027C63");
        $this->addSql("ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4F734749D5");
        $this->addSql("ALTER TABLE prestataires DROP FOREIGN KEY FK_F6D6EE4F70235C3A");
        $this->addSql("ALTER TABLE reponses DROP FOREIGN KEY FK_1E512EC665A2841B");
        $this->addSql("ALTER TABLE reponses_documents DROP FOREIGN KEY FK_7ED3E08988B266E3");
        $this->addSql("ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F535D3AF914");
        $this->addSql("ALTER TABLE invitations DROP FOREIGN KEY FK_232710AE5D3AF914");
        $this->addSql("ALTER TABLE organismes_prestataires DROP FOREIGN KEY FK_25065C275D3AF914");
        $this->addSql("ALTER TABLE organismes_prestataires DROP FOREIGN KEY FK_25065C2778B0A977");
        $this->addSql("ALTER TABLE reponses DROP FOREIGN KEY FK_1E512EC678B0A977");
        $this->addSql("ALTER TABLE consultations DROP FOREIGN KEY FK_242D8F53FF1E199");
        $this->addSql("ALTER TABLE reponses_devis DROP FOREIGN KEY FK_DD56A3C6812B77B7");
        $this->addSql("ALTER TABLE reponses_questions DROP FOREIGN KEY FK_56BFC6D4812B77B7");
        $this->addSql("ALTER TABLE reponses_documents DROP FOREIGN KEY FK_7ED3E089812B77B7");
        $this->addSql("DROP TABLE utilisateurs");
        $this->addSql("DROP TABLE categories_organismes");
        $this->addSql("DROP TABLE categories_prestataires");
        $this->addSql("DROP TABLE consultations");
        $this->addSql("DROP TABLE consultations_documents");
        $this->addSql("DROP TABLE documents");
        $this->addSql("DROP TABLE invitations");
        $this->addSql("DROP TABLE reponses_devis");
        $this->addSql("DROP TABLE organismes");
        $this->addSql("DROP TABLE organismes_prestataires");
        $this->addSql("DROP TABLE prestataires");
        $this->addSql("DROP TABLE reponses_questions");
        $this->addSql("DROP TABLE reponses");
        $this->addSql("DROP TABLE reponses_documents");
    }
}
