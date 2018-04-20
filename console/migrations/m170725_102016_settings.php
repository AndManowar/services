<?php

use yii\db\Migration;

/**
 * Class m170725_102016_settings
 */
class m170725_102016_settings extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%settings}}', [
            'id'                   => $this->primaryKey(),
            'configuration'        => $this->string()->notNull(),
            'description'          => $this->string(),
            'value'                => $this->string()->notNull(),
            'field_type'           => $this->integer()->notNull(),
            'settings_category_id' => $this->integer()->notNull(),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
            'created_by'           => $this->integer()->notNull(),
            'updated_by'           => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%settings_categories}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_settings_settingsCat', '{{%settings}}', 'settings_category_id', '{{%settings_categories}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
        $this->dropTable('{{%settings_categories}}');
    }

}
