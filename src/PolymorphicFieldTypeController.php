<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\PolymorphicFieldType\Command\GetResponse;
use Anomaly\PolymorphicFieldType\Command\Search;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class PolymorphicFieldTypeController
 * @package Anomaly\PolymorphicFieldType
 */
class PolymorphicFieldTypeController extends AdminController
{

    /**
     * @return mixed
     */
    public function search()
    {
        $results = $this->dispatch(new Search());
        return $this->dispatch(new GetResponse($results));
    }

}