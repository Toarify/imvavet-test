<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250611163344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66B03A8386 ON article (created_by_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66896DBBDE ON article (updated_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66B03A8386');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66896DBBDE');
        $this->addSql('DROP INDEX IDX_23A0E66B03A8386 ON article');
        $this->addSql('DROP INDEX IDX_23A0E66896DBBDE ON article');
        $this->addSql('ALTER TABLE article DROP created_by_id, DROP updated_by_id');
    }
}
