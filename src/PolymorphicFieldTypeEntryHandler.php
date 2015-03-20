<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class PolymorphicFieldTypeEntryHandler
 * @package Anomaly\PolymorphicFieldType
 */
class PolymorphicFieldTypeEntryHandler
{

    /**
     * @param Request $request
     * @param EntryInterface $entry
     * @param PolymorphicFieldType $fieldType
     * @param array $config
     */
    public function set(Request $request, EntryInterface $entry, $value, PolymorphicFieldType $fieldType, array $config)
    {
        $relatedType = $request->get("{$fieldType->getField()}_type");
        $relatedId = $request->get("{$fieldType->getField()}_id");

        $model = class_exists($relatedType) ? new $relatedType : null;

        if ($model && $relatedId) {
            /** @var Model $model */
            /** @var Model $related */
            if ($related = $model->find($relatedId)) {
                $fieldType->getRelation($entry)->associate($related);
            }
        }
    }

    public function get(EloquentModel $entry, PolymorphicFieldType $fieldType, array $config)
    {
        return $entry->getRelation($fieldType->getField())->getResults();
    }

}