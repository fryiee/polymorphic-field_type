<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class PolymorphicFieldTypeAccessor
 *
 * @package Anomaly\PolymorphicFieldType
 */
class PolymorphicFieldTypeAccessor extends FieldTypeAccessor
{

    /**
     * The field type object.
     * This is for IDE support.
     *
     * @var PolymorphicFieldType
     */
    protected $fieldType;

    /**
     * Set the value.
     *
     * @param EloquentModel $entry
     * @param               $value
     * @return array|void
     */
    public function set(EloquentModel $entry, $value)
    {
        $fieldType = $this->fieldType;
        $config    = $this->fieldType->getConfig();

        app()->call(
            array_get($config, 'set_handler', __NAMESPACE__ . '\PolymorphicFieldTypeEntryHandler@set'),
            compact('entry', 'value', 'fieldType', 'config')
        );
    }

    public function get(EloquentModel $entry)
    {
        return $this->fieldType->getRelation($entry);
    }
}