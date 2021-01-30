<?php
namespace src\models;

use \core\Model;


class Pagination extends Model 
{
    public function __construct(
        public int $currentPage,
        public int $perPage,
        public int $total 
    ) {}

    public function offset()
    {
        return $this->perPage * ($this->currentPage - 1);
    }

    public function totalPages()
    {
        return ceil($this->total / $this->perPage);
    }

    public function previusPage()
    {
        $prev =  $this->currentPage - 1;
        return ($prev > 0) ? $prev : false;
    }

    public function nextPage()
    {
        $next =  $this->currentPage + 1;
        return ($next <= $this->total) ? $next : false;
    }
}