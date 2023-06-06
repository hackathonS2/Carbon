<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606130812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE techno_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE test_results_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE techno (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE test (id INT NOT NULL, id_techno_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, difficulte INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D87F7E0CD1C67D9B ON test (id_techno_id)');
        $this->addSql('CREATE TABLE test_results (id INT NOT NULL, id_test_id INT NOT NULL, id_user_id INT NOT NULL, result INT DEFAULT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_43E230DCC0C0AD29 ON test_results (id_test_id)');
        $this->addSql('CREATE INDEX IDX_43E230DC79F37AE5 ON test_results (id_user_id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CD1C67D9B FOREIGN KEY (id_techno_id) REFERENCES techno (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE test_results ADD CONSTRAINT FK_43E230DCC0C0AD29 FOREIGN KEY (id_test_id) REFERENCES test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE test_results ADD CONSTRAINT FK_43E230DC79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE techno_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE test_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE test_results_id_seq CASCADE');
        $this->addSql('ALTER TABLE test DROP CONSTRAINT FK_D87F7E0CD1C67D9B');
        $this->addSql('ALTER TABLE test_results DROP CONSTRAINT FK_43E230DCC0C0AD29');
        $this->addSql('ALTER TABLE test_results DROP CONSTRAINT FK_43E230DC79F37AE5');
        $this->addSql('DROP TABLE techno');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE test_results');
    }
}
