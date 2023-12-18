<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218141744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD ticket_id INT DEFAULT NULL, ADD comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89700047D2 ON picture (ticket_id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89F8697D13 ON picture (comment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89700047D2');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89F8697D13');
        $this->addSql('DROP INDEX IDX_16DB4F89700047D2 ON picture');
        $this->addSql('DROP INDEX IDX_16DB4F89F8697D13 ON picture');
        $this->addSql('ALTER TABLE picture DROP ticket_id, DROP comment_id');
    }
}
