<?php

/*** Created by getpu on 16/8/19.*/

use getpu\user\migrations\Migration;
use yii\db\Schema;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m140403_174025_create_account_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%account}}', [
            'id'         => Schema::TYPE_PK,
            'user_id'    => Schema::TYPE_INTEGER,
            'provider'   => Schema::TYPE_STRING . ' NOT NULL',
            'client_id'  => Schema::TYPE_STRING . ' NOT NULL',
            'properties' => Schema::TYPE_TEXT,
        ], $this->tableOptions);

        $this->createIndex('account_unique', '{{%account}}', ['provider', 'client_id'], true);
        $this->addForeignKey('fk_user_account', '{{%account}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%account}}');
    }
}
