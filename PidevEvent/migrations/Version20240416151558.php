<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416151558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE evenement ADD imgurl VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE chemin_image chemin_image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reserver_event CHANGE date_reservation date_reservation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE reserver_event RENAME INDEX id_evenement TO IDX_299CC9A38B13D439');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, prenom VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, gender TINYINT(1) DEFAULT NULL, profession VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, EnLigne TINYINT(1) DEFAULT NULL, verif TINYINT(1) DEFAULT NULL, email VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, mdp VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE evenement DROP imgurl, CHANGE nom nom VARCHAR(256) NOT NULL, CHANGE description description VARCHAR(256) NOT NULL, CHANGE chemin_image chemin_image VARCHAR(256) NOT NULL');
        $this->addSql('ALTER TABLE reserver_event CHANGE date_reservation date_reservation DATE NOT NULL');
        $this->addSql('ALTER TABLE reserver_event RENAME INDEX idx_299cc9a38b13d439 TO id_evenement');
    }
}
