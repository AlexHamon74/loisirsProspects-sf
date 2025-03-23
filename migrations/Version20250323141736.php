<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250323141736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F26CFC0818');
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F2A76ED395');
        $this->addSql('DROP TABLE assistance');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, rencontre_id INT DEFAULT NULL, INDEX IDX_1B4F85F26CFC0818 (rencontre_id), INDEX IDX_1B4F85F2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F26CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
