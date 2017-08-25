<?php
/**
 */

namespace Db19\Repositories;

use Db19\ModelsApp\OrderColumn;
use Db19\ModelsApp\Type;

/**
 * Class CreateFormRepository
 *
 * @package Db19\Repositories
 */
class CreateFormRepository extends Repository
{
    private $orderColumn;

    private $asideTemplate = 'writer.aside_menu';

    /**
     * CreateFormRepository constructor.
     *
     * @param Type        $type
     * @param OrderColumn $orderColumn
     */
    public function __construct(Type $type, OrderColumn $orderColumn)
    {
        parent::__construct($type);

        $this->orderColumn = $orderColumn;
    }

    /**
     * This method get all Types of Document in App
     *
     * @return \Illuminate\Database\Eloquent\Collection of Db19\ModelsApp\Type
     */
    public function getAllTypes()
    {
        $types = $this->model->all();

        return $types;
    }

    /**
     * @return string
     */
    public function createAside()
    {
        if (view()->exists($this->asideTemplate)) {
            $types = $this->getAllTypeName();

            return view('writer.aside_menu', ['types' => $types])->render();
        }

        abort(404);
    }

    public function createMenuPanel()
    {
        if (view()->exists('writer.menu_panel')) {
            return view('writer.menu_panel')->render();
        }

        abort(404);
    }

    public function createForm()
    {
        if (view()->exists('writer.form_create_doc')) {
            $orderColumns = $this->getAllOrders();
            return view('writer.form_create_doc', ['types' => $this->getAllTypeName(), 'orders' => $orderColumns]);
        }

        abort(404);
    }

    private function getAllTypeName()
    {
        return $this->model->select('name', 'alias', 'native_name')->get();
    }

    private function getAllOrders()
    {
        $orders = $this->orderColumn->all();
        $orders->transform(function ($item, $key) {
            $column = $item->toArray();
            $type_name = array_shift($column);
            $columnFiltered = array_flip(array_filter($column, function ($val) {
                return (!is_null($val));
            }));
            ksort($columnFiltered);
            $columnFiltered['type_name'] = $type_name;
            return $columnFiltered;
        });
        return $orders->keyBy('type_name');
    }
}
