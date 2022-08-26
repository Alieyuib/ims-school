<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfController extends Controller
{
    //index

    public function index()
    {

        $data = ['status'=>'My Invoice'];
        $pdf = PDF::loadView('template.mypdf', $data);

        return $pdf->stream('mypdf.pdf');
    }
}
