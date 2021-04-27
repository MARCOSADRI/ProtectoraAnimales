<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426185200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, raza_id INT DEFAULT NULL, especie_id INT DEFAULT NULL, tamano_id INT DEFAULT NULL, ficha_id INT DEFAULT NULL, adoptador_id INT DEFAULT NULL, nombre_animal VARCHAR(100) NOT NULL, INDEX IDX_6AAB231F8CCBB6A9 (raza_id), INDEX IDX_6AAB231FE70ED95B (especie_id), INDEX IDX_6AAB231FA289E5D3 (tamano_id), UNIQUE INDEX UNIQ_6AAB231F5030B25F (ficha_id), INDEX IDX_6AAB231F2D8A9E44 (adoptador_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfermedad (id INT AUTO_INCREMENT NOT NULL, ficha_id INT DEFAULT NULL, nombre_enfermedad VARCHAR(100) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, diagnostico_enfermedad VARCHAR(255) DEFAULT NULL, INDEX IDX_DDB8B3565030B25F (ficha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE especie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ficha (id INT AUTO_INCREMENT NOT NULL, esterilizado TINYINT(1) DEFAULT NULL, estado TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE raza (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revision (id INT AUTO_INCREMENT NOT NULL, ficha_id INT DEFAULT NULL, motivo VARCHAR(255) DEFAULT NULL, fecha DATE DEFAULT NULL, diagnostico VARCHAR(255) DEFAULT NULL, INDEX IDX_6D6315CC5030B25F (ficha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tamano (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacuna (id INT AUTO_INCREMENT NOT NULL, ficha_id INT DEFAULT NULL, nombre_vacuna VARCHAR(100) DEFAULT NULL, fabricante VARCHAR(100) DEFAULT NULL, previene VARCHAR(255) DEFAULT NULL, INDEX IDX_7289F4335030B25F (ficha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FE70ED95B FOREIGN KEY (especie_id) REFERENCES especie (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA289E5D3 FOREIGN KEY (tamano_id) REFERENCES tamano (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F5030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F2D8A9E44 FOREIGN KEY (adoptador_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE enfermedad ADD CONSTRAINT FK_DDB8B3565030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CC5030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('ALTER TABLE vacuna ADD CONSTRAINT FK_7289F4335030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FE70ED95B');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F5030B25F');
        $this->addSql('ALTER TABLE enfermedad DROP FOREIGN KEY FK_DDB8B3565030B25F');
        $this->addSql('ALTER TABLE revision DROP FOREIGN KEY FK_6D6315CC5030B25F');
        $this->addSql('ALTER TABLE vacuna DROP FOREIGN KEY FK_7289F4335030B25F');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8CCBB6A9');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA289E5D3');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F2D8A9E44');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE enfermedad');
        $this->addSql('DROP TABLE especie');
        $this->addSql('DROP TABLE ficha');
        $this->addSql('DROP TABLE raza');
        $this->addSql('DROP TABLE revision');
        $this->addSql('DROP TABLE tamano');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vacuna');
    }
}
