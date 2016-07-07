<?php

use yii\db\Migration;

class m160508_134819_payment extends Migration
{
    public function up()
    {
        $this->createTable('payment', [
            'id'=>$this->primaryKey(),
            'summ'=>$this->integer(11),
            'user_id'=>$this->integer(11),
            'status'=>$this->boolean(),
            'date'=>$this->dateTime(),
            'type'=>$this->integer(1),
            'check'=>$this->string(255),
            'cash_type'=>$this->integer(1)
        ]);
        $this->createTable('balance', [
            'id'=>$this->primaryKey(),
            'summ'=>$this->integer(11),
            'user_id'=>$this->integer(11),
        ]);
        $this->createTable('order_payment', [
            'id'=>$this->primaryKey(),
            'order_id'=>$this->integer(),
            'summ'=>$this->integer(11),
            'date'=>$this->dateTime(),
            'user_id'=>$this->integer(11),
        ]);
    }

    public function down()
    {
        $this->dropTable('payment');
        $this->dropTable('balance');
        $this->dropTable('order_payment');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
