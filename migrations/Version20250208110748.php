<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208110748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, saison_id INT DEFAULT NULL, equipe_domicile_id INT DEFAULT NULL, equipe_exterieur_id INT DEFAULT NULL, date DATE NOT NULL, score_equipe_domicile INT DEFAULT NULL, score_equipe_exterieur INT DEFAULT NULL, type_rencontre VARCHAR(255) NOT NULL, INDEX IDX_460C35EDF965414C (saison_id), INDEX IDX_460C35ED5FE1AEAD (equipe_domicile_id), INDEX IDX_460C35ED21ECD755 (equipe_exterieur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35EDF965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED5FE1AEAD FOREIGN KEY (equipe_domicile_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED21ECD755 FOREIGN KEY (equipe_exterieur_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe ADD logo LONGTEXT DEFAULT NULL, ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user ADD position VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35EDF965414C');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED5FE1AEAD');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED21ECD755');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('ALTER TABLE equipe DROP logo, DROP updated_at');
        $this->addSql('ALTER TABLE user DROP position');
    }
}
