<?php

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\TagsFieldType\TagsFieldType;

return [
    'exclude' => [
        'required' => false,
        'type'     => 'anomaly.field_type.tags',
        'config'   => [
            'options' => function (StreamRepositoryInterface $streams, TagsFieldType $fieldType) {

                $options = [];

                /* @var StreamInterface as $stream */
                foreach ($streams->visible() as $stream) {
                    $options[ucwords(str_replace('_', ' ', $stream->getNamespace()))][$stream->getEntryModelName(
                    )] = $stream->getName();
                }

                foreach ($options as $namespace) {
                    ksort($namespace);
                }

                ksort($options);

                $fieldType->setOptions($options);
            }
        ]
    ],
    'include' => [
        'required' => false,
        'type'     => 'anomaly.field_type.tags',
        'config'   => [
            'options' => function (StreamRepositoryInterface $streams, TagsFieldType $fieldType) {

                $options = [];

                /* @var StreamInterface as $stream */
                foreach ($streams->visible() as $stream) {
                    $options[ucwords(str_replace('_', ' ', $stream->getNamespace()))][$stream->getEntryModelName(
                    )] = $stream->getName();
                }

                foreach ($options as $namespace) {
                    ksort($namespace);
                }

                ksort($options);

                $fieldType->setOptions($options);
            }
        ]
    ],
    'mode'    => [
        'required' => true,
        'type'     => 'anomaly.field_type.select',
        'config'   => [
            'options' => [
                'dropdown' => 'anomaly.field_type.relationship::config.mode.option.dropdown',
                'lookup'   => 'anomaly.field_type.relationship::config.mode.option.lookup',
                'search'   => 'anomaly.field_type.relationship::config.mode.option.search',
            ]
        ]
    ]
];
