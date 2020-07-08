<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200708150256 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE livre_auteur (livre_id INT NOT NULL, auteur_id INT NOT NULL, INDEX IDX_A11876B537D925CB (livre_id), INDEX IDX_A11876B560BB6FE6 (auteur_id), PRIMARY KEY(livre_id, auteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_client (livre_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_6306C3A037D925CB (livre_id), INDEX IDX_6306C3A019EB6921 (client_id), PRIMARY KEY(livre_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_commande (livre_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_22140D437D925CB (livre_id), INDEX IDX_22140D482EA2E54 (commande_id), PRIMARY KEY(livre_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B560BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_client ADD CONSTRAINT FK_6306C3A037D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_client ADD CONSTRAINT FK_6306C3A019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_commande ADD CONSTRAINT FK_22140D437D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_commande ADD CONSTRAINT FK_22140D482EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie ADD livre_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD63437D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('CREATE INDEX IDX_497DD63437D925CB ON categorie (livre_id)');
        $this->addSql('ALTER TABLE livre ADD fk_editeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99C31B77B2 FOREIGN KEY (fk_editeur_id) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_AC634F99C31B77B2 ON livre (fk_editeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE livre_auteur');
        $this->addSql('DROP TABLE livre_client');
        $this->addSql('DROP TABLE livre_commande');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD63437D925CB');
        $this->addSql('DROP INDEX IDX_497DD63437D925CB ON categorie');
        $this->addSql('ALTER TABLE categorie DROP livre_id');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99C31B77B2');
        $this->addSql('DROP INDEX IDX_AC634F99C31B77B2 ON livre');
        $this->addSql('ALTER TABLE livre DROP fk_editeur_id');
    }
}
