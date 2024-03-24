<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240316155246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE awards_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cash_price_contributions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cash_prices_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE games_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE leaderboards_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE platforms_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE registrations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE results_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_awards_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE teams_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tournaments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_awards_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_platforms_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE video_games_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE awards (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cash_price_contributions (id INT NOT NULL, contributor_id INT NOT NULL, tournament_id INT NOT NULL, amount NUMERIC(5, 2) NOT NULL, contributed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4D6EBCD77A19A357 ON cash_price_contributions (contributor_id)');
        $this->addSql('CREATE INDEX IDX_4D6EBCD733D1A3E7 ON cash_price_contributions (tournament_id)');
        $this->addSql('COMMENT ON COLUMN cash_price_contributions.contributed_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE cash_prices (id INT NOT NULL, tournament_id INT NOT NULL, initial_amount NUMERIC(10, 2) NOT NULL, total_amount NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D6203F2133D1A3E7 ON cash_prices (tournament_id)');
        $this->addSql('CREATE TABLE games (id INT NOT NULL, tournament_id INT NOT NULL, team_home_id INT NOT NULL, team_away_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(255) NOT NULL, livestream_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FF232B3133D1A3E7 ON games (tournament_id)');
        $this->addSql('CREATE INDEX IDX_FF232B31D7B4B9AB ON games (team_home_id)');
        $this->addSql('CREATE INDEX IDX_FF232B31729679A8 ON games (team_away_id)');
        $this->addSql('COMMENT ON COLUMN games.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE leaderboards (id INT NOT NULL, tournament_id INT NOT NULL, team_id INT NOT NULL, points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E974E11733D1A3E7 ON leaderboards (tournament_id)');
        $this->addSql('CREATE INDEX IDX_E974E117296CD8AE ON leaderboards (team_id)');
        $this->addSql('CREATE TABLE platforms (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE registrations (id INT NOT NULL, user_id INT NOT NULL, team_id INT NOT NULL, tournament_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_53DE51E7A76ED395 ON registrations (user_id)');
        $this->addSql('CREATE INDEX IDX_53DE51E7296CD8AE ON registrations (team_id)');
        $this->addSql('CREATE INDEX IDX_53DE51E733D1A3E7 ON registrations (tournament_id)');
        $this->addSql('COMMENT ON COLUMN registrations.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE results (id INT NOT NULL, game_id INT NOT NULL, winner_id INT NOT NULL, score_team_home INT NOT NULL, score_team_away INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FA3E414E48FD905 ON results (game_id)');
        $this->addSql('CREATE INDEX IDX_9FA3E4145DFCD4B8 ON results (winner_id)');
        $this->addSql('CREATE TABLE team_awards (id INT NOT NULL, team_id INT NOT NULL, award_id INT NOT NULL, received_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_53F1A427296CD8AE ON team_awards (team_id)');
        $this->addSql('CREATE INDEX IDX_53F1A4273D5282CF ON team_awards (award_id)');
        $this->addSql('COMMENT ON COLUMN team_awards.received_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE teams (id INT NOT NULL, captain_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_96C222583346729B ON teams (captain_id)');
        $this->addSql('CREATE TABLE tournaments (id INT NOT NULL, video_game_id INT NOT NULL, platform_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, format VARCHAR(255) NOT NULL, rules TEXT NOT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E4BCFAC316230A8 ON tournaments (video_game_id)');
        $this->addSql('CREATE INDEX IDX_E4BCFAC3FFE6496F ON tournaments (platform_id)');
        $this->addSql('COMMENT ON COLUMN tournaments.start_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_awards (id INT NOT NULL, user_id INT NOT NULL, award_id INT NOT NULL, received_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_40B8F8C3A76ED395 ON user_awards (user_id)');
        $this->addSql('CREATE INDEX IDX_40B8F8C33D5282CF ON user_awards (award_id)');
        $this->addSql('COMMENT ON COLUMN user_awards.received_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_platforms (id INT NOT NULL, user_id INT NOT NULL, platform_id INT NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17610B07A76ED395 ON user_platforms (user_id)');
        $this->addSql('CREATE INDEX IDX_17610B07FFE6496F ON user_platforms (platform_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, team_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, birthday DATE NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1483A5E9296CD8AE ON users (team_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON users (email)');
        $this->addSql('CREATE TABLE video_games (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_video_games (video_game_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(video_game_id, user_id))');
        $this->addSql('CREATE INDEX IDX_D95AEB0616230A8 ON user_video_games (video_game_id)');
        $this->addSql('CREATE INDEX IDX_D95AEB06A76ED395 ON user_video_games (user_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE cash_price_contributions ADD CONSTRAINT FK_4D6EBCD77A19A357 FOREIGN KEY (contributor_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cash_price_contributions ADD CONSTRAINT FK_4D6EBCD733D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cash_prices ADD CONSTRAINT FK_D6203F2133D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B3133D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B31D7B4B9AB FOREIGN KEY (team_home_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B31729679A8 FOREIGN KEY (team_away_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE leaderboards ADD CONSTRAINT FK_E974E11733D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE leaderboards ADD CONSTRAINT FK_E974E117296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E7296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE registrations ADD CONSTRAINT FK_53DE51E733D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E414E48FD905 FOREIGN KEY (game_id) REFERENCES games (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E4145DFCD4B8 FOREIGN KEY (winner_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_awards ADD CONSTRAINT FK_53F1A427296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE team_awards ADD CONSTRAINT FK_53F1A4273D5282CF FOREIGN KEY (award_id) REFERENCES awards (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C222583346729B FOREIGN KEY (captain_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournaments ADD CONSTRAINT FK_E4BCFAC316230A8 FOREIGN KEY (video_game_id) REFERENCES video_games (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tournaments ADD CONSTRAINT FK_E4BCFAC3FFE6496F FOREIGN KEY (platform_id) REFERENCES platforms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_awards ADD CONSTRAINT FK_40B8F8C3A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_awards ADD CONSTRAINT FK_40B8F8C33D5282CF FOREIGN KEY (award_id) REFERENCES awards (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_platforms ADD CONSTRAINT FK_17610B07A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_platforms ADD CONSTRAINT FK_17610B07FFE6496F FOREIGN KEY (platform_id) REFERENCES platforms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_video_games ADD CONSTRAINT FK_D95AEB0616230A8 FOREIGN KEY (video_game_id) REFERENCES video_games (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_video_games ADD CONSTRAINT FK_D95AEB06A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE awards_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cash_price_contributions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cash_prices_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE games_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE leaderboards_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE platforms_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE registrations_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE results_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_awards_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE teams_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tournaments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_awards_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_platforms_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE video_games_id_seq CASCADE');
        $this->addSql('ALTER TABLE cash_price_contributions DROP CONSTRAINT FK_4D6EBCD77A19A357');
        $this->addSql('ALTER TABLE cash_price_contributions DROP CONSTRAINT FK_4D6EBCD733D1A3E7');
        $this->addSql('ALTER TABLE cash_prices DROP CONSTRAINT FK_D6203F2133D1A3E7');
        $this->addSql('ALTER TABLE games DROP CONSTRAINT FK_FF232B3133D1A3E7');
        $this->addSql('ALTER TABLE games DROP CONSTRAINT FK_FF232B31D7B4B9AB');
        $this->addSql('ALTER TABLE games DROP CONSTRAINT FK_FF232B31729679A8');
        $this->addSql('ALTER TABLE leaderboards DROP CONSTRAINT FK_E974E11733D1A3E7');
        $this->addSql('ALTER TABLE leaderboards DROP CONSTRAINT FK_E974E117296CD8AE');
        $this->addSql('ALTER TABLE registrations DROP CONSTRAINT FK_53DE51E7A76ED395');
        $this->addSql('ALTER TABLE registrations DROP CONSTRAINT FK_53DE51E7296CD8AE');
        $this->addSql('ALTER TABLE registrations DROP CONSTRAINT FK_53DE51E733D1A3E7');
        $this->addSql('ALTER TABLE results DROP CONSTRAINT FK_9FA3E414E48FD905');
        $this->addSql('ALTER TABLE results DROP CONSTRAINT FK_9FA3E4145DFCD4B8');
        $this->addSql('ALTER TABLE team_awards DROP CONSTRAINT FK_53F1A427296CD8AE');
        $this->addSql('ALTER TABLE team_awards DROP CONSTRAINT FK_53F1A4273D5282CF');
        $this->addSql('ALTER TABLE teams DROP CONSTRAINT FK_96C222583346729B');
        $this->addSql('ALTER TABLE tournaments DROP CONSTRAINT FK_E4BCFAC316230A8');
        $this->addSql('ALTER TABLE tournaments DROP CONSTRAINT FK_E4BCFAC3FFE6496F');
        $this->addSql('ALTER TABLE user_awards DROP CONSTRAINT FK_40B8F8C3A76ED395');
        $this->addSql('ALTER TABLE user_awards DROP CONSTRAINT FK_40B8F8C33D5282CF');
        $this->addSql('ALTER TABLE user_platforms DROP CONSTRAINT FK_17610B07A76ED395');
        $this->addSql('ALTER TABLE user_platforms DROP CONSTRAINT FK_17610B07FFE6496F');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9296CD8AE');
        $this->addSql('ALTER TABLE user_video_games DROP CONSTRAINT FK_D95AEB0616230A8');
        $this->addSql('ALTER TABLE user_video_games DROP CONSTRAINT FK_D95AEB06A76ED395');
        $this->addSql('DROP TABLE awards');
        $this->addSql('DROP TABLE cash_price_contributions');
        $this->addSql('DROP TABLE cash_prices');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE leaderboards');
        $this->addSql('DROP TABLE platforms');
        $this->addSql('DROP TABLE registrations');
        $this->addSql('DROP TABLE results');
        $this->addSql('DROP TABLE team_awards');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE tournaments');
        $this->addSql('DROP TABLE user_awards');
        $this->addSql('DROP TABLE user_platforms');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE video_games');
        $this->addSql('DROP TABLE user_video_games');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
