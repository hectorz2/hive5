<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125191344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Language rows insert.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Bislama', 'Bislama', 'bi')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Amharic', 'አማርኛ', 'am')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Greek', 'Ελληνικά', 'el')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Dzongkha', 'ཇོང་ཁ', 'dz')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Afrikaans', 'Afrikaans', 'af')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Chamorro', 'Chamoru', 'ch')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Spanish', 'Español', 'es')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Catalan', 'Català', 'ca')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Belarusian', 'Беларуская', 'be')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('German', 'Deutsch', 'de')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Aymara', 'Aymar', 'ay')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('English', 'English', 'en')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Bulgarian', 'Български', 'bg')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Czech', 'Česky', 'cs')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Bengali', 'বাংলা', 'bn')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Arabic', 'العربية', 'ar')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Divehi', 'ދިވެހިބަސް', 'dv')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Azerbaijani', 'Azərbaycanca / آذربايجان', 'az')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Bosnian', 'Bosanski', 'bs')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Danish', 'Dansk', 'da')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Estonian', 'Eesti', 'et')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Persian', 'فارسی', 'fa')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Peul', 'Fulfulde', 'ff')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Finnish', 'Suomi', 'fi')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Fijian', 'Na Vosa Vakaviti', 'fj')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Faroese', 'Føroyskt', 'fo')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('French', 'Français', 'fr')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Galician', 'Galego', 'gl')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Guarani', 'Avañe\'ẽ', 'gn')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Manx', 'Gaelg', 'gv')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Hebrew', 'עברית', 'he')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Croatian', 'Hrvatski', 'hr')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Hungarian', 'Magyar', 'hu')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Haitian', 'Krèyol ayisyen', 'ht')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Armenian', 'Հայերեն', 'hy')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Basque', 'Euskara', 'eu')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Icelandic', 'Íslenska', 'is')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Irish', 'Gaeilge', 'ga')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Hindi', 'हिन्दी', 'hi')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Indonesian', 'Bahasa Indonesia', 'id')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Japanese', '日本語', 'ja')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Georgian', 'ქართული', 'ka')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Kongo', 'KiKongo', 'kg')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Kazakh', 'Қазақша', 'kk')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Korean', '한국어', 'ko')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Cambodian', 'ភាសាខ្មែរ', 'km')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Kurdish', 'Kurdî / كوردی', 'ku')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Kirghiz', 'Kırgızca / Кыргызча', 'ky')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Italian', 'Italiano', 'it')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Lingala', 'Lingála', 'ln')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Luxembourgish', 'Lëtzebuergesch', 'lb')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Laotian', 'ລາວ / Pha xa lao', 'lo')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Lithuanian', 'Lietuvių', 'lt')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Latvian', 'Latviešu', 'lv')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Malagasy', 'Malagasy', 'mg')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Marshallese', 'Kajin Majel / Ebon', 'mh')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Maori', 'Māori', 'mi')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Greenlandic', 'Kalaallisut', 'kl')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Latin', 'Latina', 'la')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Luba-Katanga', 'Tshiluba', 'lu')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Macedonian', 'Македонски', 'mk')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Mongolian', 'Монгол', 'mn')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Malay', 'Bahasa Melayu', 'ms')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Maltese', 'bil-Malti', 'mt')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Burmese', 'မြန်မာစာ', 'my')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Nauruan', 'Dorerin Naoero', 'na')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Norwegian Bokmål', 'Norsk bokmål', 'nb')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('North Ndebele', 'Sindebele', 'nd')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Dutch', 'Nederlands', 'nl')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Nepali', 'नेपाली', 'ne')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Norwegian Nynorsk', 'Norsk nynorsk', 'nn')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Chichewa', 'Chi-Chewa', 'ny')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Norwegian', 'Norsk', 'no')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('South Ndebele', 'isiNdebele', 'nr')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Occitan', 'Occitan', 'oc')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Polish', 'Polski', 'pl')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Panjabi / Punjabi', 'ਪੰਜਾਬੀ / पंजाबी / پنجابي', 'pa')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Pashto', 'پښتو', 'ps')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Quechua', 'Runa Simi', 'qu')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Portuguese', 'Português', 'pt')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Russian', 'Русский', 'ru')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Rwandi', 'Kinyarwandi', 'rw')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Romanian', 'Română', 'ro')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Sango', 'Sängö', 'sg')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Slovak', 'Slovenčina', 'sk')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Slovenian', 'Slovenščina', 'sl')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Samoan', 'Gagana Samoa', 'sm')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Shona', 'chiShona', 'sn')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Albanian', 'Shqip', 'sq')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Serbian', 'Српски', 'sr')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Kirundi', 'Kirundi', 'rn')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Swahili', 'Kiswahili', 'sw')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Swati', 'SiSwati', 'ss')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Tamil', 'தமிழ்', 'ta')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Southern Sotho', 'Sesotho', 'st')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Tajik', 'Тоҷикӣ', 'tg')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Thai', 'ไทย / Phasa Thai', 'th')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Sinhalese', 'සිංහල', 'si')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Somalia', 'Soomaaliga', 'so')");
        $this->addSql("INSERT INTO language (english_name, native_name, iso_code) VALUES ('Swedish', 'Svenska', 'sv')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM language");
    }
}
