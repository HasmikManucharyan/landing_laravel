<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class PagesAddController extends Controller
{
    //
    public function execute(Request $request) {
        if(view()->exists('admin.pages_add')) {
            $data = [
                'title' => 'New Pages'
            ];
            return view('admin.pages_add');
        }
    }
}
