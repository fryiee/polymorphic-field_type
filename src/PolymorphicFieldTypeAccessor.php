<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class PolymorphicFieldTypeAccessor
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class PolymorphicFieldTypeAccessor extends FieldTypeAccessor
{

    /**
     * Set the value on the entry.
     *
     * @param $value
     */
    public function set($value)
    {
        if ($value instanceof EloquentModel) {

            $entry = $this->fieldType->getEntry();

            $attributes = $entry->getAttributes();

            $attributes[$this->fieldType->getColumnName() . '_id']   = $value->getId();
            $attributes[$this->fieldType->getColumnName() . '_type'] = get_class($value);

            $entry->setRawAttributes($attributes);
        } else {
            parent::set($value);
        }
    }
}
