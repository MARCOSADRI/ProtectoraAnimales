<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523184507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE revision ADD enfermedad_id INT DEFAULT NULL, ADD vacuna_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CC422512A FOREIGN KEY (enfermedad_id) REFERENCES enfermedad (id)');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CCA4D881B6 FOREIGN KEY (vacuna_id) REFERENCES vacuna (id)');
        $this->addSql('CREATE INDEX IDX_6D6315CC422512A ON revision (enfermedad_id)');
        $this->addSql('CREATE INDEX IDX_6D6315CCA4D881B6 ON revision (vacuna_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE revision DROP FOREIGN KEY FK_6D6315CC422512A');
        $this->addSql('ALTER TABLE revision DROP FOREIGN KEY FK_6D6315CCA4D881B6');
        $this->addSql('DROP INDEX IDX_6D6315CC422512A ON revision');
        $this->addSql('DROP INDEX IDX_6D6315CCA4D881B6 ON revision');
        $this->addSql('ALTER TABLE revision DROP enfermedad_id, DROP vacuna_id');
    }
}
