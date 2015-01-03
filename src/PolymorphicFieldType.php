<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

class PolymorphicFieldType extends FieldType
{
    /*public function onAssigned($assignment)
    {
        $table = $assignment->stream->entryTable();

        \Schema::table(
            $table,
            function ($table) use ($assignment) {
                $table->string($assignment->field->slug . '_type')->nullable();
                $table->integer($assignment->field->slug . '_id')->nullable();
            }
        );
    }*/
}
