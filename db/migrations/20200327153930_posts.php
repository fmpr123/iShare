<?php

use Phinx\Migration\AbstractMigration;

class Posts extends AbstractMigration
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
        $table = $this->table('posts');
        $table->addColumn('title', 'string', ['limit' => 50], ['null' => false])
            ->addColumn('content', 'string', ['limit' => 255], ['null' => false])
            ->addColumn('url', 'string', ['limit' => 100], ['null' => false])
            ->addColumn('rating', 'integer', ['default' => 0], ['null' => false])
            ->addColumn('complaints', 'integer', ['default' => 0], ['null' => false])
            ->addColumn('private', 'boolean', ['default' => false], ['null' => false])
            ->addColumn('bloqued', 'boolean', ['default' => false], ['null' => false])
            ->addColumn('user_id', 'integer', ['null' => false])
            ->addForeignKey('user_id', 'users', 'id')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'], ['null' => false])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->create();
    }
}