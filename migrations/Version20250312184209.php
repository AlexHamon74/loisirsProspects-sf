<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250312184209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, rencontre_id INT DEFAULT NULL, INDEX IDX_1B4F85F2A76ED395 (user_id), INDEX IDX_1B4F85F26CFC0818 (rencontre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE but (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, rencontre_id INT DEFAULT NULL, INDEX IDX_B132FECAA76ED395 (user_id), INDEX IDX_B132FECA6CFC0818 (rencontre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, rencontre_id INT DEFAULT NULL, INDEX IDX_AB55E24FA76ED395 (user_id), INDEX IDX_AB55E24F6CFC0818 (rencontre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F26CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE but ADD CONSTRAINT FK_B132FECA6CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F6CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F2A76ED395');
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F26CFC0818');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECAA76ED395');
        $this->addSql('ALTER TABLE but DROP FOREIGN KEY FK_B132FECA6CFC0818');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FA76ED395');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F6CFC0818');
        $this->addSql('DROP TABLE assistance');
        $this->addSql('DROP TABLE but');
        $this->addSql('DROP TABLE participation');
    }
}
