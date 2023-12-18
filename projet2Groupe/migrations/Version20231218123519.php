<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218123519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language_ticket (language_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_8BB394C582F1BAF4 (language_id), INDEX IDX_8BB394C5700047D2 (ticket_id), PRIMARY KEY(language_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture_ticket (picture_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_6441BB3EE45BDBF (picture_id), INDEX IDX_6441BB3700047D2 (ticket_id), PRIMARY KEY(picture_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture_comment (picture_id INT NOT NULL, comment_id INT NOT NULL, INDEX IDX_8952A6BEEE45BDBF (picture_id), INDEX IDX_8952A6BEF8697D13 (comment_id), PRIMARY KEY(picture_id, comment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language_ticket ADD CONSTRAINT FK_8BB394C582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_ticket ADD CONSTRAINT FK_8BB394C5700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_ticket ADD CONSTRAINT FK_6441BB3EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_ticket ADD CONSTRAINT FK_6441BB3700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_comment ADD CONSTRAINT FK_8952A6BEEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_comment ADD CONSTRAINT FK_8952A6BEF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD users_id INT DEFAULT NULL, ADD ticket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C67B3B43D FOREIGN KEY (users_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('CREATE INDEX IDX_9474526C67B3B43D ON comment (users_id)');
        $this->addSql('CREATE INDEX IDX_9474526C700047D2 ON comment (ticket_id)');
        $this->addSql('ALTER TABLE ticket ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA367B3B43D FOREIGN KEY (users_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA367B3B43D ON ticket (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language_ticket DROP FOREIGN KEY FK_8BB394C582F1BAF4');
        $this->addSql('ALTER TABLE language_ticket DROP FOREIGN KEY FK_8BB394C5700047D2');
        $this->addSql('ALTER TABLE picture_ticket DROP FOREIGN KEY FK_6441BB3EE45BDBF');
        $this->addSql('ALTER TABLE picture_ticket DROP FOREIGN KEY FK_6441BB3700047D2');
        $this->addSql('ALTER TABLE picture_comment DROP FOREIGN KEY FK_8952A6BEEE45BDBF');
        $this->addSql('ALTER TABLE picture_comment DROP FOREIGN KEY FK_8952A6BEF8697D13');
        $this->addSql('DROP TABLE language_ticket');
        $this->addSql('DROP TABLE picture_ticket');
        $this->addSql('DROP TABLE picture_comment');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C67B3B43D');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C700047D2');
        $this->addSql('DROP INDEX IDX_9474526C67B3B43D ON comment');
        $this->addSql('DROP INDEX IDX_9474526C700047D2 ON comment');
        $this->addSql('ALTER TABLE comment DROP users_id, DROP ticket_id');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA367B3B43D');
        $this->addSql('DROP INDEX IDX_97A0ADA367B3B43D ON ticket');
        $this->addSql('ALTER TABLE ticket DROP users_id');
    }
}
