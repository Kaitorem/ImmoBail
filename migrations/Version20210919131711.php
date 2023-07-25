<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210919131711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_mise_ajour DATETIME DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045F64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_C47CF6EB64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_id INT DEFAULT NULL, nom DATETIME NOT NULL, type VARCHAR(255) NOT NULL, amenagement VARCHAR(255) DEFAULT NULL, surface_habitable DOUBLE PRECISION DEFAULT NULL, surface_terrain DOUBLE PRECISION DEFAULT NULL, nombre_piece INT DEFAULT NULL, classe_energetique VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, prix_loyer DOUBLE PRECISION DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postale INT DEFAULT NULL, ville VARCHAR(255) NOT NULL, archived TINYINT(1) NOT NULL, INDEX IDX_5E9E89CBA76ED395 (user_id), UNIQUE INDEX UNIQ_5E9E89CB3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loyer (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, mois VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_404562964D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, date_naissance DATE NOT NULL, sexe VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postale INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, archived TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EB64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE loyer ADD CONSTRAINT FK_404562964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB3DA5256D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F64D218E');
        $this->addSql('ALTER TABLE locataire DROP FOREIGN KEY FK_C47CF6EB64D218E');
        $this->addSql('ALTER TABLE loyer DROP FOREIGN KEY FK_404562964D218E');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBA76ED395');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE loyer');
        $this->addSql('DROP TABLE user');
    }
}
