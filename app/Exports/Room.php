<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Room implements FromView
{
        protected $result = null;

        public function __construct($data){
                $this->result = $data;
        }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('report.room', $this->result);
    }
}