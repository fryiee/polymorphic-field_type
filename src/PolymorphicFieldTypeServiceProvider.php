<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class PolymorphicFieldTypeServiceProvider extends AddonServiceProvider
{

    protected $routes = [
        'anomaly/field_type/polymorphic/search' => [
            'uses' => 'Anomaly\PolymorphicFieldType\PolymorphicFieldTypeController@search',
            'as'   => 'anomaly.field_type.polymorphic.search'
        ],
    ];

}