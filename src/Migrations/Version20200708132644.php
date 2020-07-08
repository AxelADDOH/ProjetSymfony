<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200708132644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(255) NOT NULL, prenom_client VARCHAR(255) NOT NULL, adresse_client VARCHAR(255) NOT NULL, telephone_client VARCHAR(255) NOT NULL, email_client VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date_commande DATETIME NOT NULL, mode_payement_commande VARCHAR(255) NOT NULL, prix_commande_ht DOUBLE PRECISION NOT NULL, cout_commande_ttc DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE livre_auteur');
        $this->addSql('ALTER TABLE editeur CHANGE nom_editeur nom_editeur VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99C31B77B2');
        $this->addSql('DROP INDEX IDX_AC634F99C31B77B2 ON livre');
        $this->addSql('ALTER TABLE livre DROP fk_editeur_id, CHANGE titre_livre titre_livre VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE livre_auteur (livre_id INT NOT NULL, auteur_id INT NOT NULL, INDEX IDX_A11876B560BB6FE6 (auteur_id), INDEX IDX_A11876B537D925CB (livre_id), PRIMARY KEY(livre_id, auteur_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B560BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE editeur CHANGE nom_editeur nom_editeur VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE livre ADD fk_editeur_id INT NOT NULL, CHANGE titre_livre titre_livre VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99C31B77B2 FOREIGN KEY (fk_editeur_id) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_AC634F99C31B77B2 ON livre (fk_editeur_id)');
    }
}
