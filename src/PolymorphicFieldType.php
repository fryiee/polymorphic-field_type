<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\Contract\RelationFieldTypeInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class PolymorphicFieldType
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\PolymorphicFieldType
 */
class PolymorphicFieldType extends FieldType implements RelationFieldTypeInterface
{

    /**
     * @var string
     */
    protected $inputView = 'anomaly.field_type.polymorphic::input';

    /**
     * Get the relation.
     *
     * @param EntryInterface $model
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo|mixed|null
     */
    public function getRelation(EntryInterface $model)
    {
        return $model->morphTo($this->getField());
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        $config = $this->getConfig();

        $default = route('anomaly.field_type.polymorphic.search', [
            'by'      => array_get($config, 'search_field', 'title'),
            'limit'   => array_get($config, 'limit', 25),
            'related' => $this->encodeType(array_get($config, 'related')),
        ]);

        $url = array_get($config, 'url', $default);

        $url = str_contains($url, '?') ? $url . '&' : $url . '?';

        return $url . 'q={query}';
    }

    protected function encodeType($type)
    {
        return str_replace('\\', '.', $type);
    }

}
