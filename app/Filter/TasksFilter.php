<?php
namespace App\Filter;


class TasksFilter extends QueryFilter
{
    protected function name($value)
    {
        $this->create = $this->create->where('name', $value);
    }

    protected function done($value)
    {
        $this->create = $this->create->where('done', $value);
    }

    protected function created_at($value)
    {
        $this->create = $this->create->where('created_at', $value);
    }

    protected function updated_at($value)
    {
        $this->create = $this->create->where('updated_at', $value);
    }
}
