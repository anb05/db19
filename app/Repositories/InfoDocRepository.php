<?php

namespace Db19\Repositories;

use Carbon\Carbon;
use Db19\ModelsApp\Group;
use Db19\ModelsApp\OrderColumn;
use Db19\ModelsApp\Type;
use Db19\ModelsDb\Appendix;
use Db19\ModelsDb\Control;
use Db19\ModelsDb\DocBody;
use Db19\ModelsDb\Document;
use Db19\ModelsDb\Registration;
use Db19\ModelsDb\Resolution;
use Db19\User;

/**
 * Class InfoDocRepository
 *
 * @package Db19\Repositories
 */
class InfoDocRepository extends Repository
{
    private $orderColumn;

    private $controlsTemplate = 'info_elements.view_control';

    private $resolutionsTemplate = 'info_elements.view_resolutions';

    private $docInfoTemplate = 'info_elements.view_doc_info';

    private $viewCopyLinksTemplate = 'info_elements.view_copy_links';

    private $viewBindDocGroup = 'info_elements.view_bind';

    private $viewPreparedMoveTo = 'info_elements.view_move_to';

    /**
     * InfoDocRepository constructor.
     *
     * @param Type        $type
     * @param OrderColumn $orderColumn
     */
    public function __construct(Type $type, OrderColumn $orderColumn)
    {
        parent::__construct($type);

        $this->orderColumn = $orderColumn;
    }

    public function preparedMoveTo(Document $document)
    {
        if (view()->exists($this->viewPreparedMoveTo)) {
            $data['prepared'] = $document;
            return view($this->viewPreparedMoveTo, $data)->render();
        }
        return false;
    }

    public function bindDocWitGroup(Document $document)
    {
        if (view()->exists($this->viewBindDocGroup)) {
            $groups = Group::all();
            $data['groups'] = $groups;
            $data['document'] = $document;

            return view($this->viewBindDocGroup, $data)->render();
        }
        abort(404);
    }

    /**
     * @param Document $document
     *
     * @return string
     */
    public function viewCopies(Document $document)
    {
        if (view()->exists($this->viewCopyLinksTemplate)) {
            $body = DocBody::whereDocumentId($document->id)->first();
            $appendices = Appendix::whereDocumentId($document->id)->get();
            $data['body'] = $body;
            $data['appendices'] = $appendices;

            return view($this->viewCopyLinksTemplate, $data)->render();
        }
        abort(404);
    }

    /**
     * @param Document $document
     *
     * @return string
     */
    public function getDocInfo(Document $document)
    {
        $docId = $document->id;
        $reg = Registration::whereDocumentId($docId)->get()->last();
        if (view()->exists($this->docInfoTemplate)) {
            $orderColumns = $this->getColumnOrder($reg->type_name);
            $columnNames = Type::whereName($reg->type_name)->first();

            $data['orderColumns'] = $orderColumns;
            $data['document'] = $document;
            $data['reg'] = $reg;
            $data['columnNames'] = $columnNames;

            return view($this->docInfoTemplate, $data)->render();
        }
        abort(404);
    }

    /**
     * @param Document $document
     *
     * @return bool|string
     */
    public function getResolutions(Document $document)
    {
        $resolutions = Resolution::whereDocumentId($document->id)->get();

        if ($resolutions->isNotEmpty()) {
            $resolutions = $resolutions->each(function ($item, $key) {
                $user = User::find($item->human_id);
                $item->human_id = $user->full_name;

                $carbonTime = Carbon::createFromFormat('Y-m-d', $item->date);
                $item->date = $carbonTime;
            });

            $data['resolutions'] =$resolutions;
            if (view()->exists($this->resolutionsTemplate)) {
                return view($this->resolutionsTemplate, $data)->render();
            }
            abort(404);
        }
//        return view($this->resolutionsTemplate)->render();
        return false;
    }

    /**
     * @param Document $document
     *
     * @return bool|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getControls(Document $document)
    {
        $controls = Control::whereDocumentId($document->id)->get();

        if ($controls->isNotEmpty()) {
            $delta = [];
            $controls = $controls->each(function ($item, $key) use (&$delta) {
                $user = User::find($item->responsible_executor);
                $item->responsible_executor = $user->full_name;
                $carbonTime = Carbon::createFromFormat('Y-m-d', $item->check_time);
                $item->check_time = $carbonTime;
                if ($item->executed_time) {
                    $carbonTime = Carbon::createFromFormat('Y-m-d', $item->executed_time);
                    $item->executed_time = $carbonTime;
                }

                if ($item->executed_time) {
                    $delta[$key] = 'success';
                } else {
                    $remainingPeriod = -1 * $item->check_time->diffInDays(Carbon::now(), false);
                    if ($remainingPeriod < 2) {
                        $delta[$key] = 'danger';
                    } elseif ($remainingPeriod < 4) {
                        $delta[$key] = 'warning';
                    } else {
                        $delta[$key] = 'info';
                    }
                }
            });

            if (in_array('danger', $delta)) {
                $panelClass = 'danger';
            } elseif (in_array('warning', $delta)) {
                $panelClass = 'warning';
            } elseif (in_array('info', $delta)) {
                $panelClass = 'info';
            } elseif (in_array('success', $delta)) {
                $panelClass = 'success';
            } else {
                $panelClass = 'primary';
            }

            $data['panelClass'] = $panelClass;
            $data['delta'] = $delta;
            $data['controls'] = $controls;

            if (view()->exists($this->controlsTemplate)) {
                return view($this->controlsTemplate, $data)->render();
            }
            abort(404);
        }
        return false;
    }

    /**
     * @param string $documentType
     *
     * @return array|null
     */
    private function getColumnOrder(string $documentType)
    {
        $order = $this->orderColumn->where('type_name', $documentType)->first();
        $columns = $order->toArray();
        array_shift($columns);

        $columnsFiltered = array_flip(array_filter($columns, function ($val) {
            return (!is_null($val));
        }));
        ksort($columnsFiltered);
        return $columnsFiltered;
    }
}
