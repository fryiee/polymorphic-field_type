<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\EntryModel;

/**
 * Class PolymorphicFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PolymorphicFieldType
 */
class PolymorphicFieldType extends FieldType
{

    /**
     * Get the relation.
     *
     * @param EntryModel $model
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|mixed|null
     */
    public function getRelation(EntryModel $model)
    {
        return $model->morphTo(array_get($this->config, 'related'), 'id', $this->getColumnName());
    }

    /**
     * Get the related model.
     *
     * @return null
     */
    protected function getRelatedModel()
    {
        $model = array_get($this->config, 'related');

        if (!$model) {
            return null;
        }

        return app()->make($model);
    }
}
