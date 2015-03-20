<?php namespace Anomaly\PolymorphicFieldType\Command;

use Illuminate\Contracts\Bus\SelfHandling;

class GetResponse implements SelfHandling
{
    /**
     * @var
     */
    private $results;

    /**
     * Map entry fields to json results
     *
     * @var
     */
    private $map;

    /**
     * @param $results
     * @param array $map
     * @internal param $titleField
     */
    public function __construct($results, array $map = ['title' => 'title', 'id' => 'id'])
    {
        $this->results = $results;
        $this->map = $map;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle()
    {
        $results = [];

        foreach ($this->results as $entry) {

            $record = [];

            foreach ($this->map as $key => $field) {
                $record[$key] = $entry->{$field};
            }

            $record['type'] = get_class($entry);

            $results[] = $record;
        }

        return response()->json(compact('results'));
    }

}