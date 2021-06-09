<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class V20210608021618 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $userTable = $this
            ->table(
                'spr_users',
                [
                    'id' => false,
                    'primary_key' => ['id']
                ]
            )
            ->addTimestamps();
        $userTable
            ->addColumn('id', 'uuid', ['length' => 36])
            ->addColumn('username', 'string')
            ->addColumn('display_name', 'string')
            ->addColumn('password', 'string')
            ->create();

        $gaugeTable = $this
            ->table(
                'spr_gauges',
                [
                    'id' => false,
                    'primary_key' => ['id']
                ]
            )
            ->addTimestamps();
        $gaugeTable
            ->addColumn('id', 'uuid', ['length' => 36])
            ->addForeignKey('user_id', 'spr_users', ['delete' => 'CASCADE'])
            ->addColumn('name', 'string')
            ->addColumn('units', 'char', ['limit' => 1])
            ->addColumn('max', 'integer')
            ->addColumn('notes', 'text');

        $measurementTable = $this
            ->table(
                'spr_measurements',
                [
                    'id' => false,
                    'primary_key' => ['id']
                ]
            )
            ->addTimestamps();
        $measurementTable
            ->addColumn('id', 'uuid', ['length' => 36])
            ->addForeignKey('gauge_id', 'spr_gauges')
            ->addColumn('measurement', 'integer')
            ->addColumn('notes', 'text')
            ->addColumn('measured_at', 'datetime');
    }
}
