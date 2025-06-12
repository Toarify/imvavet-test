<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250605084151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about (id INT AUTO_INCREMENT NOT NULL, presentation LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, type VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, abstract LONGTEXT NOT NULL, first_athor LONGTEXT NOT NULL, other_author LONGTEXT NOT NULL, url LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_details (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, authors VARCHAR(255) NOT NULL, publication_date DATE NOT NULL, UNIQUE INDEX UNIQ_9FF44F3D7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_image (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B28A764E7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_source (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, pdf_name VARCHAR(255) DEFAULT NULL, pdf_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_354DE8F37294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccine (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, game LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccine2 (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccine_details (id INT AUTO_INCREMENT NOT NULL, vaccine_id INT DEFAULT NULL, autorisation VARCHAR(255) DEFAULT NULL, presentation LONGTEXT NOT NULL, farmacetical_form LONGTEXT DEFAULT NULL, composition_dose LONGTEXT DEFAULT NULL, inication_contre LONGTEXT DEFAULT NULL, second_effect LONGTEXT DEFAULT NULL, manual LONGTEXT DEFAULT NULL, indication LONGTEXT DEFAULT NULL, precation_use LONGTEXT DEFAULT NULL, concervation LONGTEXT DEFAULT NULL, wait_time LONGTEXT DEFAULT NULL, rappel LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_9F5D06852BFE75C3 (vaccine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccine_image (id INT AUTO_INCREMENT NOT NULL, vaccine_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_479C25A22BFE75C3 (vaccine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_details ADD CONSTRAINT FK_9FF44F3D7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_image ADD CONSTRAINT FK_B28A764E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_source ADD CONSTRAINT FK_354DE8F37294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vaccine_details ADD CONSTRAINT FK_9F5D06852BFE75C3 FOREIGN KEY (vaccine_id) REFERENCES vaccine (id)');
        $this->addSql('ALTER TABLE vaccine_image ADD CONSTRAINT FK_479C25A22BFE75C3 FOREIGN KEY (vaccine_id) REFERENCES vaccine (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_details DROP FOREIGN KEY FK_9FF44F3D7294869C');
        $this->addSql('ALTER TABLE article_image DROP FOREIGN KEY FK_B28A764E7294869C');
        $this->addSql('ALTER TABLE article_source DROP FOREIGN KEY FK_354DE8F37294869C');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE vaccine_details DROP FOREIGN KEY FK_9F5D06852BFE75C3');
        $this->addSql('ALTER TABLE vaccine_image DROP FOREIGN KEY FK_479C25A22BFE75C3');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_details');
        $this->addSql('DROP TABLE article_image');
        $this->addSql('DROP TABLE article_source');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vaccine');
        $this->addSql('DROP TABLE vaccine2');
        $this->addSql('DROP TABLE vaccine_details');
        $this->addSql('DROP TABLE vaccine_image');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
