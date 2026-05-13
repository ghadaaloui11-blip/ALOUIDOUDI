<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260510115941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, instit_id INT NOT NULL, INDEX IDX_717E22E377E42A6C (instit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE groupe_utilisateur (groupe_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_92C1107D7A45358C (groupe_id), INDEX IDX_92C1107DFB88E14F (utilisateur_id), PRIMARY KEY(groupe_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE institut (id INT AUTO_INCREMENT NOT NULL, nomi VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nomp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E377E42A6C FOREIGN KEY (instit_id) REFERENCES institut (id)');
        $this->addSql('ALTER TABLE groupe_utilisateur ADD CONSTRAINT FK_92C1107D7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_utilisateur ADD CONSTRAINT FK_92C1107DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E377E42A6C');
        $this->addSql('ALTER TABLE groupe_utilisateur DROP FOREIGN KEY FK_92C1107D7A45358C');
        $this->addSql('ALTER TABLE groupe_utilisateur DROP FOREIGN KEY FK_92C1107DFB88E14F');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_utilisateur');
        $this->addSql('DROP TABLE institut');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
