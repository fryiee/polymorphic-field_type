<?php namespace Anomaly\PolymorphicFieldType\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class Search
 * @package Anomaly\PolymorphicFieldType\Command
 */
class Search implements SelfHandling
{

    /**
     * @param Request $request
     * @return array
     */
    public function handle(Request $request)
    {
        $results = [];

        $type = $this->decodeType($request->get('related'));
        $field = $request->get('by');
        $value = $request->get('q');
        $limit = $request->get('limit', 25);

        $model = class_exists($type) ? new $type : null;

        if ($model && $field && $value) {
            $results = $model->where($field, 'like', "%{$value}%")->take($limit)->get();
        }

        return $results;
    }

    /**
     * @param $type
     * @return string
     */
    protected function decodeType($type)
    {
        return str_replace('.', '\\', $type);
    }

}