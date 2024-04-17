<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240402062457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id_com INT AUTO_INCREMENT NOT NULL, id_topic INT NOT NULL, text VARCHAR(255) NOT NULL, id_user INT NOT NULL, date_com DATETIME NOT NULL, INDEX IDX_67F068BC73C59F2B (id_topic), PRIMARY KEY(id_com)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC73C59F2B FOREIGN KEY (id_topic) REFERENCES topic (id_topic)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC73C59F2B');
        $this->addSql('DROP TABLE commentaire');
    }
}
