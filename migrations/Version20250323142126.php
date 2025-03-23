<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250323142126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assistance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, but_id INT DEFAULT NULL, INDEX IDX_1B4F85F2A76ED395 (user_id), INDEX IDX_1B4F85F2B8914BA4 (but_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE assistance ADD CONSTRAINT FK_1B4F85F2B8914BA4 FOREIGN KEY (but_id) REFERENCES but (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F2A76ED395');
        $this->addSql('ALTER TABLE assistance DROP FOREIGN KEY FK_1B4F85F2B8914BA4');
        $this->addSql('DROP TABLE assistance');
    }
}
