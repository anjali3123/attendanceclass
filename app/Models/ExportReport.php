<?php
namespace App\Models;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportReport implements FromView
{
    public function __construct($query) {
        $this->query = $query;
    }

    public function view(): View
    {
        return view('report.export.'.$this->query['viewpage'], $this->query);
    }
   
}