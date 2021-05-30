<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529105958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, tamano_id INT DEFAULT NULL, raza_id INT DEFAULT NULL, especie_id INT DEFAULT NULL, ficha_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, nombre_a VARCHAR(100) DEFAULT NULL, sexo VARCHAR(100) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, edad INT DEFAULT NULL, INDEX IDX_6AAB231FA289E5D3 (tamano_id), INDEX IDX_6AAB231F8CCBB6A9 (raza_id), INDEX IDX_6AAB231FE70ED95B (especie_id), UNIQUE INDEX UNIQ_6AAB231F5030B25F (ficha_id), INDEX IDX_6AAB231FDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfermedad (id INT AUTO_INCREMENT NOT NULL, ficha_id INT DEFAULT NULL, nombre_e VARCHAR(150) DEFAULT NULL, INDEX IDX_DDB8B3565030B25F (ficha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE especie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ficha (id INT AUTO_INCREMENT NOT NULL, esterilizado TINYINT(1) DEFAULT NULL, fallecido TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE raza (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revision (id INT AUTO_INCREMENT NOT NULL, ficha_id INT DEFAULT NULL, enfermedad_id INT DEFAULT NULL, vacuna_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, diagnostico VARCHAR(255) DEFAULT NULL, INDEX IDX_6D6315CC5030B25F (ficha_id), INDEX IDX_6D6315CC422512A (enfermedad_id), INDEX IDX_6D6315CCA4D881B6 (vacuna_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tamano (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacuna (id INT AUTO_INCREMENT NOT NULL, ficha_id INT DEFAULT NULL, nombre_v VARCHAR(100) DEFAULT NULL, previene VARCHAR(100) DEFAULT NULL, fabricante VARCHAR(150) DEFAULT NULL, INDEX IDX_7289F4335030B25F (ficha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA289E5D3 FOREIGN KEY (tamano_id) REFERENCES tamano (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FE70ED95B FOREIGN KEY (especie_id) REFERENCES especie (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F5030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FDB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE enfermedad ADD CONSTRAINT FK_DDB8B3565030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CC5030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CC422512A FOREIGN KEY (enfermedad_id) REFERENCES enfermedad (id)');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CCA4D881B6 FOREIGN KEY (vacuna_id) REFERENCES vacuna (id)');
        $this->addSql('ALTER TABLE vacuna ADD CONSTRAINT FK_7289F4335030B25F FOREIGN KEY (ficha_id) REFERENCES ficha (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE revision DROP FOREIGN KEY FK_6D6315CC422512A');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FE70ED95B');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F5030B25F');
        $this->addSql('ALTER TABLE enfermedad DROP FOREIGN KEY FK_DDB8B3565030B25F');
        $this->addSql('ALTER TABLE revision DROP FOREIGN KEY FK_6D6315CC5030B25F');
        $this->addSql('ALTER TABLE vacuna DROP FOREIGN KEY FK_7289F4335030B25F');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8CCBB6A9');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA289E5D3');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FDB38439E');
        $this->addSql('ALTER TABLE revision DROP FOREIGN KEY FK_6D6315CCA4D881B6');
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
