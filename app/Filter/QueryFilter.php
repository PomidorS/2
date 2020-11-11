<?php
namespace App\Filter;


class QueryFilter
{
    protected $create;
    protected $req;

    public function __construct($create, $req)
    {
        $this->create = $create;
        $this->req = $req;
    }

    public function apply()
    {
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                if (!$value) {
                    continue;
                }
                $this->$filter($value);
            }
        }
        return $this->create;
    }

    protected function filters()
    {
        return $this->req->all();
    }
}
