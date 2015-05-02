<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
     * @var string
     */
    protected $inputView = 'anomaly.field_type.polymorphic::input';

    /**
     * Get the relation.
     *
     * @return MorphTo|mixed|null
     */
    public function getRelation()
    {
        return $this->entry->morphTo($this->getField());
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        $config = $this->getConfig();

        $default = route(
            'anomaly.field_type.polymorphic.search',
            [
                'by'      => array_get($config, 'search_field', 'title'),
                'limit'   => array_get($config, 'limit', 25),
                'related' => $this->encodeType(array_get($config, 'related')),
            ]
        );

        $url = array_get($config, 'url', $default);

        $url = str_contains($url, '?') ? $url . '&' : $url . '?';

        return $url . 'q={query}';
    }

    protected function encodeType($type)
    {
        return str_replace('\\', '.', $type);
    }
}
