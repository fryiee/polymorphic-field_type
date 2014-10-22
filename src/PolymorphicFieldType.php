<?php namespace Anomaly\Streams\Addon\FieldType\Polymorphic;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAddon;

class PolymorphicFieldType extends FieldTypeAddon
{
    public function onAssigned($assignment)
    {
        $table = $assignment->stream->entryTable();

        \Schema::table(
            $table,
            function ($table) use ($assignment) {
                $table->string($assignment->field->slug . '_type')->nullable();
                $table->integer($assignment->field->slug . '_id')->nullable();
            }
        );
    }
}
