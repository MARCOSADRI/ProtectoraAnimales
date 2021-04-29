<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403155623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enfermedad DROP historial');
        $this->addSql('ALTER TABLE revisiones DROP historial');
        $this->addSql('ALTER TABLE vacunas DROP historial');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enfermedad ADD historial INT DEFAULT NULL');
        $this->addSql('ALTER TABLE revisiones ADD historial INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vacunas ADD historial INT DEFAULT NULL');
    }
}
