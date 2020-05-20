<?php

use yii\db\Migration;
use m200519_150251_create_user_table as User;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m200519_153458_create_news_table extends Migration
{
    const TABLE_NAME = '{{%news}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'title' => $this->string()->notNull(),
            'descr' => $this->text()->notNull(),
            'created_at' => $this->timestamp()
                ->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()
                ->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP')
                ->append('ON UPDATE NOW()'),
        ]);
        
        $this->addForeignKey(
            'fk-news-user_id',
            self::TABLE_NAME,
            'user_id',
            User::TABLE_NAME,
            User::FIELD_ID
        );
        
        $this->insertDemoData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    protected function insertDemoData(): void
    {
        foreach ($this->getDemoData() as $data) {
            $this->insert(self::TABLE_NAME, $data);
        }
    }

    protected function getDemoData(): array
    {
        return [
            [
                'user_id' => 1,
                'title' => 'Yii 2.0.35',
                'descr' => 'We are very pleased to announce the release of Yii Framework version 2.0.35. Please refer to the instructions at https://www.yiiframework.com/download/ to install or upgrade to this version.

Version 2.0.35 fixes 13 issues and adds some small enhancements:

Query::withQuery() method that can be used for CTE.
yii\i18n\Formatter::$currencyDecimalSeparator to allow setting custom symbols for currency decimal in IntlNumberFormatter.
SameSite for cookies now works on PHP < 7.3.
Thanks to all Yii community members who contribute to the framework, translators who keep documentation translations up to date and community members who answer questions at forums.

There are many active Yii communities so if you need help or want to share your experience, feel free to join them.

A complete list of changes can be found in the CHANGELOG.',
            ],
            [
                'user_id' => 1,
                'title' => 'ApiDoc extension version 2.1.4 released',
                'descr' => 'We are very pleased to announce the release of the ApiDoc extension version 2.1.4.

This release add support for @property and @method annotations.

See the CHANGELOG for a full list of changes.',
            ],
            [
                'user_id' => 2,
                'title' => 'NASA Telescope Named For ‘Mother of Hubble’ Nancy Grace Roman',
                'descr' => 'NASA is naming its next-generation space telescope currently under development, the Wide Field Infrared Survey Telescope (WFIRST), in honor of Nancy Grace Roman, NASA’s first chief astronomer, who paved the way for space telescopes focused on the broader universe.

The newly named Nancy Grace Roman Space Telescope – or Roman Space Telescope, for short – is set to launch in the mid-2020s. It will investigate long-standing astronomical mysteries, such as the force behind the universe’s expansion, and search for distant planets beyond our solar system.  

Considered the “mother” of NASA’s Hubble Space Telescope, which launched 30 years ago, Roman tirelessly advocated for new tools that would allow scientists to study the broader universe from space. She left behind a tremendous legacy in the scientific community when she died in 2018.

“It is because of Nancy Grace Roman’s leadership and vision that NASA became a pioneer in astrophysics and launched Hubble, the world’s most powerful and productive space telescope,” said NASA Administrator Jim Bridenstine. “I can think of no better name for WFIRST, which will be the successor to NASA’s Hubble and Webb Telescopes.”

Former Sen. Barbara Mikulski, who worked with NASA on the Hubble and WFIRST space telescopes, said, "It is fitting that as we celebrate the 100th anniversary of women’s suffrage, NASA has announced the name of their new WFIRST telescope in honor of Dr. Nancy Roman, the Mother of Hubble – well deserved. It recognizes the incredible achievements of women in science and moves us even closer to no more hidden figures and no more hidden galaxies."',
            ],
        ];
    }
}
