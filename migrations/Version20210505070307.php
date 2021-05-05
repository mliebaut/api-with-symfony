<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505070307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etat_des_lieux (id INT AUTO_INCREMENT NOT NULL, types_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, villes VARCHAR(255) DEFAULT NULL, nb_pieces VARCHAR(255) DEFAULT NULL, surface VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_F72103128EB23357 (types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etat_des_lieux ADD CONSTRAINT FK_F72103128EB23357 FOREIGN KEY (types_id) REFERENCES types (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etat_des_lieux DROP FOREIGN KEY FK_F72103128EB23357');
        $this->addSql('DROP TABLE etat_des_lieux');
        $this->addSql('DROP TABLE types');
    }
}
