<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019184334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locataire DROP FOREIGN KEY FK_C47CF6EB64D218E');
        $this->addSql('DROP INDEX IDX_C47CF6EB64D218E ON locataire');
        $this->addSql('ALTER TABLE locataire DROP location_id');
        $this->addSql('ALTER TABLE location ADD locataire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBD8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E9E89CBD8A38199 ON location (locataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locataire ADD location_id INT NOT NULL');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EB64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_C47CF6EB64D218E ON locataire (location_id)');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBD8A38199');
        $this->addSql('DROP INDEX UNIQ_5E9E89CBD8A38199 ON location');
        $this->addSql('ALTER TABLE location DROP locataire_id');
    }
}
