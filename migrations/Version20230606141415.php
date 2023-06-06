<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606141415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE indicateur_tech_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE soft_skills_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE indicateur_tech (id INT NOT NULL, id_techno_id INT NOT NULL, id_user_id INT NOT NULL, evaluation_global_tech INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F83E2AB0D1C67D9B ON indicateur_tech (id_techno_id)');
        $this->addSql('CREATE INDEX IDX_F83E2AB079F37AE5 ON indicateur_tech (id_user_id)');
        $this->addSql('CREATE TABLE soft_skills (id INT NOT NULL, id_user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, credit INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9AA6932A79F37AE5 ON soft_skills (id_user_id)');
        $this->addSql('ALTER TABLE indicateur_tech ADD CONSTRAINT FK_F83E2AB0D1C67D9B FOREIGN KEY (id_techno_id) REFERENCES techno (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE indicateur_tech ADD CONSTRAINT FK_F83E2AB079F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE soft_skills ADD CONSTRAINT FK_9AA6932A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE test ALTER id_techno_id SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD link_linkedin VARCHAR(1500) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD link_slack VARCHAR(1500) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD eval_client_dev INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD objectif_mensuel_commercial VARCHAR(1000) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE indicateur_tech_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE soft_skills_id_seq CASCADE');
        $this->addSql('ALTER TABLE indicateur_tech DROP CONSTRAINT FK_F83E2AB0D1C67D9B');
        $this->addSql('ALTER TABLE indicateur_tech DROP CONSTRAINT FK_F83E2AB079F37AE5');
        $this->addSql('ALTER TABLE soft_skills DROP CONSTRAINT FK_9AA6932A79F37AE5');
        $this->addSql('DROP TABLE indicateur_tech');
        $this->addSql('DROP TABLE soft_skills');
        $this->addSql('ALTER TABLE "user" DROP link_linkedin');
        $this->addSql('ALTER TABLE "user" DROP link_slack');
        $this->addSql('ALTER TABLE "user" DROP eval_client_dev');
        $this->addSql('ALTER TABLE "user" DROP objectif_mensuel_commercial');
        $this->addSql('ALTER TABLE test ALTER id_techno_id DROP NOT NULL');
    }
}
