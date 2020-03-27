<?php

use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 100], ['null' => false])
            ->addColumn('email', 'string', ['limit' => 100], ['null' => false])
            ->addColumn('password', 'string', ['limit' => 50], ['null' => false])
            ->addColumn('photo', 'string', ['limit' => 100], ['null' => true])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'], ['null' => false])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->create();
    }
}
// CREATE TABLE IF NOT EXISTS `ishare`.`Users` (
//     `name` VARCHAR(100) NOT NULL,
//     `email` VARCHAR(100) NOT NULL,
//     `password` VARCHAR(50) NOT NULL,
//     `created_at` DATETIME NOT NULL,
//     `updated_at` DATETIME NULL,
//     `deleted_at` DATETIME NULL,
//     PRIMARY KEY (`id`))
//   ENGINE = InnoDB;