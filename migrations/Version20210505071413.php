<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505071413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE villes (id INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etat_des_lieux ADD villes_id INT DEFAULT NULL, ADD villes VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE etat_des_lieux ADD CONSTRAINT FK_F7210312286C17BC FOREIGN KEY (villes_id) REFERENCES villes (id)');
        $this->addSql('CREATE INDEX IDX_F7210312286C17BC ON etat_des_lieux (villes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etat_des_lieux DROP FOREIGN KEY FK_F7210312286C17BC');
        $this->addSql('DROP TABLE villes');
        $this->addSql('DROP INDEX IDX_F7210312286C17BC ON etat_des_lieux');
        $this->addSql('ALTER TABLE etat_des_lieux DROP villes_id, DROP villes');
    }
}
