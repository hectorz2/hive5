<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125190510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Country rows insert.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Andorra', 'Andorra')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('United Arab Emirates', 'دولة الإمارات العربية المتحدة')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Afghanistan', 'افغانستان')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Antigua and Barbuda', 'Antigua and Barbuda')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Anguilla', 'Anguilla')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Albania', 'Shqipëria')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Armenia', 'Հայաստան')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Angola', 'Angola')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Antarctica', 'Antarctica')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Argentina', 'Argentina')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('American Samoa', 'American Samoa')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Austria', 'Österreich')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Australia', 'Australia')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Aruba', 'Aruba')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Åland', 'Åland')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Azerbaijan', 'Azərbaycan')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bosnia and Herzegovina', 'Bosna i Hercegovina')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Barbados', 'Barbados')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bangladesh', 'Bangladesh')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Belgium', 'België')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Burkina Faso', 'Burkina Faso')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bulgaria', 'България')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bahrain', '‏البحرين')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Burundi', 'Burundi')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Benin', 'Bénin')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Saint Barthélemy', 'Saint-Barthélemy')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bermuda', 'Bermuda')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Brunei', 'Negara Brunei Darussalam')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bolivia', 'Bolivia')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bonaire', 'Bonaire')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Brazil', 'Brasil')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bahamas', 'Bahamas')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Bhutan', 'ʼbrug-yul')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Botswana', 'Botswana')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Belarus', 'Белару́сь')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Belize', 'Belize')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Canada', 'Canada')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Cocos [Keeling] Islands', 'Cocos (Keeling) Islands')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Democratic Republic of the Congo', 'République démocratique du Congo')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Central African Republic', 'Ködörösêse tî Bêafrîka')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Republic of the Congo', 'République du Congo')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Switzerland', 'Schweiz')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Ivory Coast', 'Côte d\'Ivoire')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Cook Islands', 'Cook Islands')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Chile', 'Chile')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Cameroon', 'Cameroon')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('China', '中国')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Colombia', 'Colombia')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Costa Rica', 'Costa Rica')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Cuba', 'Cuba')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Cape Verde', 'Cabo Verde')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Curacao', 'Curaçao')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Christmas Island', 'Christmas Island')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Cyprus', 'Κύπρος')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Czech Republic', 'Česká republika')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Germany', 'Deutschland')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Djibouti', 'Djibouti')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Denmark', 'Danmark')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Dominica', 'Dominica')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Dominican Republic', 'República Dominicana')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Algeria', 'الجزائر')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Ecuador', 'Ecuador')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Estonia', 'Eesti')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Egypt', 'مصر‎')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Western Sahara', 'الصحراء الغربية')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Eritrea', 'ኤርትራ')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Spain', 'España')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Ethiopia', 'ኢትዮጵያ')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Finland', 'Suomi')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Fiji', 'Fiji')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Falkland Islands', 'Falkland Islands')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Micronesia', 'Micronesia')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Faroe Islands', 'Føroyar')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('France', 'France')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Gabon', 'Gabon')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('United Kingdom', 'United Kingdom')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Grenada', 'Grenada')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Georgia', 'საქართველო')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('French Guiana', 'Guyane française')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Guernsey', 'Guernsey')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Ghana', 'Ghana')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Gibraltar', 'Gibraltar')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Greenland', 'Kalaallit Nunaat')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Gambia', 'Gambia')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Guinea', 'Guinée')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Guadeloupe', 'Guadeloupe')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Equatorial Guinea', 'Guinea Ecuatorial')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Greece', 'Ελλάδα')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('South Georgia and the South Sandwich Islands', 'South Georgia')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Guatemala', 'Guatemala')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Guam', 'Guam')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Guinea-Bissau', 'Guiné-Bissau')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Guyana', 'Guyana')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Hong Kong', '香港')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Honduras', 'Honduras')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Croatia', 'Hrvatska')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Haiti', 'Haïti')");
        $this->addSql("INSERT INTO country (english_name, native_name) VALUES ('Hungary', 'Magyarország')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM country");
    }
}
