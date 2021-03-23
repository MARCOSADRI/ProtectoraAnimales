<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322202906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animales (id INT AUTO_INCREMENT NOT NULL, especie VARCHAR(50) DEFAULT NULL, raza VARCHAR(50) DEFAULT NULL, tamano VARCHAR(50) DEFAULT NULL, edad INT DEFAULT NULL, nombre_a VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfermedad (id INT AUTO_INCREMENT NOT NULL, historial INT DEFAULT NULL, enfermedad VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ficha (id INT AUTO_INCREMENT NOT NULL, animal INT DEFAULT NULL, historial INT DEFAULT NULL, esterilizado TINYINT(1) DEFAULT NULL, estado TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revisiones (id INT AUTO_INCREMENT NOT NULL, historial INT DEFAULT NULL, fecha DATE DEFAULT NULL, diagnostico VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacunas (id INT AUTO_INCREMENT NOT NULL, historial INT DEFAULT NULL, nombre_v VARCHAR(50) DEFAULT NULL, previene VARCHAR(50) DEFAULT NULL, fabricante VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animales');
        $this->addSql('DROP TABLE enfermedad');
        $this->addSql('DROP TABLE ficha');
        $this->addSql('DROP TABLE revisiones');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vacunas');
    }
}
