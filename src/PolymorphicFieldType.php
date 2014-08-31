<?php namespace Streams\Addon\FieldType\Polymorphic;

use Streams\Core\Addon\FieldTypeAbstract;

class PolymorphicFieldType extends FieldTypeAbstract
{
    /**
     * The database column type this field type uses.
     * This column uses a couple custom columns.
     *
     * @var bool
     */
    protected $columnType = false;

    /**
     * Add the columns when assigned.
     *
     * @param $assignment
     */
    public function onAssigned($assignment)
    {
        $table = $assignment->getStream()->tableName();

        \Schema::table(
            $table,
            function ($table) use ($assignment) {
                $table->string($assignment->field->slug . '_string')->nullable();
                $table->integer($assignment->field->slug . '_id')->nullable();
            }
        );
    }
}
