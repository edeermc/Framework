<?php

namespace App\Models;


class TestModel extends Model {
    protected static $tablename = 'sec_processes';
    protected static $idField = 'process_id';

    public $process_id;
    public $process_name;
    public $process_desc;
    public $link_name;
    public $parent_id;
}