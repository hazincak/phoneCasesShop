<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function getDownload($nameOfFile)
    {
     
        $file = public_path('storage').'/'.$nameOfFile;
    
        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $nameOfFile , $headers);
    
    }

    
}
