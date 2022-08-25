<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    //index

    public function index(Request $request)
    {
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];

        $pdf = PDF::loadView('template.mypdf', $data);

  

        return $pdf->download('itsolutionstuff.pdf');
    }
}
