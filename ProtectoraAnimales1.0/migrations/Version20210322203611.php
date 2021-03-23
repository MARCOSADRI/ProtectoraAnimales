<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322203611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animales ADD adoptador_id INT DEFAULT NULL, ADD ficha_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animales ADD CONSTRAINT FK_FF62B8DC2D8A9E44 FOREIGN KEY (adoptador_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE animales ADD CONSTRAINT FK_FF62B8DC5030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('CREATE INDEX IDX_FF62B8DC2D8A9E44 ON animales (adoptador_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF62B8DC5030B25F ON animales (ficha_id)');
        $this->addSql('ALTER TABLE enfermedad ADD ficha_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enfermedad ADD CONSTRAINT FK_DDB8B3565030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('CREATE INDEX IDX_DDB8B3565030B25F ON enfermedad (ficha_id)');
        $this->addSql('ALTER TABLE revisiones ADD ficha_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE revisiones ADD CONSTRAINT FK_9ACDBC515030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('CREATE INDEX IDX_9ACDBC515030B25F ON revisiones (ficha_id)');
        $this->addSql('ALTER TABLE vacunas ADD ficha_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vacunas ADD CONSTRAINT FK_A4AC27E95030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('CREATE INDEX IDX_A4AC27E95030B25F ON vacunas (ficha_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animales DROP FOREIGN KEY FK_FF62B8DC2D8A9E44');
        $this->addSql('ALTER TABLE animales DROP FOREIGN KEY FK_FF62B8DC5030B25F');
        $this->addSql('DROP INDEX IDX_FF62B8DC2D8A9E44 ON animales');
        $this->addSql('DROP INDEX UNIQ_FF62B8DC5030B25F ON animales');
        $this->addSql('ALTER TABLE animales DROP adoptador_id, DROP ficha_id');
        $this->addSql('ALTER TABLE enfermedad DROP FOREIGN KEY FK_DDB8B3565030B25F');
        $this->addSql('DROP INDEX IDX_DDB8B3565030B25F ON enfermedad');
        $this->addSql('ALTER TABLE enfermedad DROP ficha_id');
        $this->addSql('ALTER TABLE revisiones DROP FOREIGN KEY FK_9ACDBC515030B25F');
        $this->addSql('DROP INDEX IDX_9ACDBC515030B25F ON revisiones');
        $this->addSql('ALTER TABLE revisiones DROP ficha_id');
        $this->addSql('ALTER TABLE vacunas DROP FOREIGN KEY FK_A4AC27E95030B25F');
        $this->addSql('DROP INDEX IDX_A4AC27E95030B25F ON vacunas');
        $this->addSql('ALTER TABLE vacunas DROP ficha_id');
    }
}
