<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311143830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kart (id INT AUTO_INCREMENT NOT NULL, no VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD kart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649293A83D8 FOREIGN KEY (kart_id) REFERENCES kart (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649293A83D8 ON user (kart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649293A83D8');
        $this->addSql('DROP TABLE kart');
        $this->addSql('DROP INDEX UNIQ_8D93D649293A83D8 ON user');
        $this->addSql('ALTER TABLE user DROP kart_id');
    }
}
