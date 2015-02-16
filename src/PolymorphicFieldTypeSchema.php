<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class PolymorphicFieldTypeSchema
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PolymorphicFieldType
 */
class PolymorphicFieldTypeSchema extends FieldTypeSchema
{

    /**
     * Add the field type column.
     *
     * @param Blueprint           $table
     * @param AssignmentInterface $assignment
     */
    public function addColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        $table->integer($this->fieldType->getColumnName() . '_id')->nullable(
            !$assignment->isRequired()
        );

        $table->string($this->fieldType->getColumnName() . '_type')->nullable(
            !$assignment->isRequired()
        );

        if ($assignment->isUnique()) {
            $table->unique(
                [
                    $this->fieldType->getColumnName() . '_id',
                    $this->fieldType->getColumnName() . '_type'
                ]
            );
        }
    }

    /**
     * Drop the field type column.
     *
     * @param Blueprint           $table
     * @param AssignmentInterface $assignment
     */
    public function dropColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        $table->dropColumn($this->fieldType->getColumnName() . '_id');
        $table->dropColumn($this->fieldType->getColumnName() . '_type');
    }
}
