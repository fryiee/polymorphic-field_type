<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeHandler;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class PolymorphicFieldTypeHandler
 * @package Anomaly\PolymorphicFieldType
 */
class PolymorphicFieldTypeHandler extends FieldTypeHandler
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
     * @param                $value
     * @return array|void
     */
    public function set(EloquentModel $entry, $value)
    {
        $fieldType = $this->fieldType;
        $config = $this->fieldType->getConfig();

        app()->call(
            array_get($config, 'set_handler', __NAMESPACE__ . '\PolymorphicFieldTypeEntryHandler@set'),
            compact('entry', 'fieldType', 'config')
        );
    }

/*    public function get(EloquentModel $entry)
    {
        $fieldType = $this->fieldType;
        $config = $this->fieldType->getConfig();

        app()->call(
            array_get($config, 'get_handler', __NAMESPACE__ . '\PolymorphicFieldTypeEntryHandler@get'),
            compact('entry', 'fieldType', 'config')
        );
    }*/

}