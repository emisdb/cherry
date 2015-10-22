<?php

class m150924_183141_update_regions_table extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE  `cashbox_history` ADD INDEX (  `id_type` ) ;');
		$this->execute('ALTER TABLE  `cashbox_history` ADD FOREIGN KEY (  `id_type` ) REFERENCES  `cherrydb`.`cashbox_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT ;');
	}

	public function down()
	{
		echo "m150924_183141_update_regions_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}