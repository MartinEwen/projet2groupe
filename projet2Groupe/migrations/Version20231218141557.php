<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218141557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture_comment DROP FOREIGN KEY FK_8952A6BEEE45BDBF');
        $this->addSql('ALTER TABLE picture_comment DROP FOREIGN KEY FK_8952A6BEF8697D13');
        $this->addSql('ALTER TABLE picture_ticket DROP FOREIGN KEY FK_6441BB3700047D2');
        $this->addSql('ALTER TABLE picture_ticket DROP FOREIGN KEY FK_6441BB3EE45BDBF');
        $this->addSql('DROP TABLE picture_comment');
        $this->addSql('DROP TABLE picture_ticket');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE picture_comment (picture_id INT NOT NULL, comment_id INT NOT NULL, INDEX IDX_8952A6BEEE45BDBF (picture_id), INDEX IDX_8952A6BEF8697D13 (comment_id), PRIMARY KEY(picture_id, comment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE picture_ticket (picture_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_6441BB3700047D2 (ticket_id), INDEX IDX_6441BB3EE45BDBF (picture_id), PRIMARY KEY(picture_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE picture_comment ADD CONSTRAINT FK_8952A6BEEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_comment ADD CONSTRAINT FK_8952A6BEF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_ticket ADD CONSTRAINT FK_6441BB3700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_ticket ADD CONSTRAINT FK_6441BB3EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
