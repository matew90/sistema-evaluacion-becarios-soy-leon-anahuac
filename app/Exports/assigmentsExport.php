<?php

namespace App\Exports;

use App\Models\assigments;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class assigmentsExport implements FromView, ShouldAutoSize
{
    protected $data, $data_conv;
    public function __construct($data,$data_conv)
    {
        $this->data=$data;
        $this->data_conv=$data_conv;
    }
    public function view(): View
    {
    
        return view('scholarshipEvaluation.convocations.export', [
            'asignados' => $this->data
        ], ['conv'=> $this->data_conv]);
    }
}
