<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    function uploadImage(Request $req) {
        $result = $req->file('file')->store('images');
        return ["result" => $result];
    }
}
