<?php
/**
 */

namespace Db19\Repositories;

//use Config;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 *
 * @package app\Repositories
 */
abstract class Repository
{
    protected $model;

    /**
     * Repository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * This method returns an array with all elements
     *
     * @return array
     */
    public function getAll()
    {
        $itemCollection = $this->model->all();
        $items = [];
        $itemCollection->each(function ($item, $key) use (&$items) {
            $items[] = $item->name;
            return;
        });
        return $items;
    }
}
