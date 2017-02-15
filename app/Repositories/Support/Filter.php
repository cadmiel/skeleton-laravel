<?php

namespace App\Repositories\Support;


use \Carbon\Carbon as Carbon;
use \DB as DB;


trait Filter
{
    protected $request;
    protected $model;
    protected $perPege  =   2;
    protected $perPegeRange = [30 => 30, 60 => 60, 120 => 120];
    protected $columns;
    protected $operators;

    public function buildQuery()
    {
          return $this
         ->filterOrder()
         ->filterDate()
         ->filterOperator()
         ->filterPerPage()
         ->model;

    }

    private function filterOrder()
    {
        if (isset($this->request['order']))
            $this->request['order'] = explode(',', $this->request['order']);
        else
            $this->request['order'] = ['id', 'desc'];

        $this->model = $this->model->orderBy($this->request['order'][0], $this->request['order'][1]);
        $this->request['order'] = $this->request['order'][0] . ',' . $this->request['order'][1];
        return $this;
    }

    private function filterPerPage()
    {
        if (!isset($this->request['per_page']))
            $this->request['per_page'] = $this->perPege;

        $this->model = $this->model->paginate($this->request['per_page']);
        $this->model->appends($this->request);
        return $this;
    }

    private function filterDate()
    {
        if (!empty($this->request['start_date']) AND !empty($this->request['end_date']))
        {
            $this->model->whereBetween(DB::raw('date(created_at)'), [Carbon::createFromFormat('d/m/Y', $this->request['start_date'])->format('Y-m-d'),
                                                                     Carbon::createFromFormat('d/m/Y', $this->request['end_date'])->format('Y-m-d')]);
        }
        elseif (empty($this->request['start_date']) AND !empty($this->request['end_date']))
        {
            $end_date = Carbon::createFromFormat('d/m/Y', $this->request['end_date']);
            $this->model->whereBetween(DB::raw('date(created_at)'), [$end_date->format('Y-m-d'),
                                                                     $end_date->format('Y-m-d')]);
            $this->request['start_date'] = $end_date->format('d/m/Y');
        }
        elseif (!empty($this->request['start_date']) AND empty($this->request['end_date']))
        {
            $start_date = Carbon::createFromFormat('d/m/Y', $this->request['start_date']);
            $this->model->whereBetween(DB::raw('date(created_at)'), [$start_date->format('Y-m-d'),
                                                                     $start_date->format('Y-m-d')]);
            $this->request['end_date'] = $start_date->format('d/m/Y');
        }
        return $this;
    }

    protected function filterOperator()
    {
        if(isset($this->request['term']) AND !empty($this->request['term']))
        {
            if ($this->isRelatedColumn())
            {
                return $this->filterRelation();
            }
            else
            {
                switch ($this->request['operator']) {
                    case 'equal_to':
                    case 'not_equal':
                    case 'less_than':
                    case 'greater_than':
                    case 'less_than_or_equal_to':
                    case 'greater_than_or_equal_to':
                        $this->model = $this->model->where($this->request['column'],
                            $this->operators[$this->request['operator']],
                            $this->request['term']);
                        break;
                    case 'in':
                        $this->model = $this->model->whereIn($this->request['column'],
                            explode(',', $this->request['term']));
                        break;
                    case 'not_in':
                        $this->model = $this->model->whereNotIn($this->request['column'],
                            explode(',', $this->request['term']));
                        break;
                    case 'like':
                        $this->model = $this->model->where($this->request['column'],
                            'like', '%' . $this->request['term'] . '%');
                        break;
                    default:
                        $this->model;
                        break;
                }
            }
        }
        return $this;
    }

    public function filterRelation()
    {
        // determine the type of search_column
        // check if its related model, eg: posts.titulo
        list($relation, $relatedColumn) = explode('.', $this->request['column']);
        $this->model = $this->model->whereHas($relation, function($query) use ($relatedColumn)
        {
            $column                     =   $this->request['column'];
            $this->request['column']    =   $relatedColumn;
            $this->model                =   $query;
            $this->filterOperator();
            $this->request['column']    =   $column;
            return $this;
        });
        return $this;

    }

    protected function isRelatedColumn()
    {
        return strpos($this->request['column'], '.') !== false;
    }

}