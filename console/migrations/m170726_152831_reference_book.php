<?php

use yii\db\Migration;

class m170726_152831_reference_book extends Migration
{

    /**
     * Справочник
     *
     * @return bool|void
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%reference_book}}', [
            'id'          => $this->primaryKey(),
            'systemName'  => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'fields'      => $this->text(),
            'relation'    => $this->integer(),
            'created_at'  => $this->integer(),
            'updated_at'  => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%reference_book_data}}', [
            'id'                => $this->primaryKey(),
            'reference_book_id' => $this->integer()->notNull(),
            'data_id'           => $this->integer()->notNull(),
            'value'             => $this->string()->notNull(),
            'related_data'      => $this->integer(),
            'fields'            => $this->string(),
            'title'             => $this->string()->notNull(),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('FK_reference_book_data_reference_book', '{{%reference_book_data}}', 'reference_book_id', '{{%reference_book}}', 'id', 'CASCADE', 'CASCADE');

    }


    public function down()
    {
        $this->dropTable('{{%reference_book_data}}');
        $this->dropTable('{{%reference_book}}');
    }

}
