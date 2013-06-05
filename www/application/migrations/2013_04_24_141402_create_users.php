<?php

class Create_Users {

  private $table = 'users';

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create ($this->table, function($table)
    {
      $table->engine = 'InnoDB';
      $table->increments ('id');
      $table->string ('email');
      $table->string ('password');
      $table->string('first_name');
      $table->string('last_name');
      $table->timestamps ();
    });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->table, $this->connection);
	}

}
