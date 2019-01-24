<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Portfolio;
use App\Service;
use App\People;
use Illuminate\Support\Facades\Mail;
use DB;

class IndexController extends Controller
{
    //
    public function execute(Request $request){

        if($request->isMethod('post')){

            $massages = [
                'required' => 'please insert :attribute',
                'email' => 'please insert valid email'
            ];

            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ], $massages);

            $data = $request->all();
            $result = Mail::send('site.email',['data'=>$data],function ($message) use ($data){
                $message->to('h_manucharyan@mail.ru')->subject('Site support');
                $message->from($data['email'],$data['email']);
            });

            if($result){
                return redirect()->route('home')->with('status','Email is send');
            }
            //mail

        }

    	$pages = Page::all();
    	$portfolios = Portfolio::get(array('name','filter','image'));
    	$services = Service::where('id','<',20)->get();
    	$peoples = People::take(3)->get();

        $tags = DB::table('portfolios')->select('filter')->distinct()->get()->toArray();

    	$menu = [];
    	foreach ($pages as $page) {
    		$item = array('title'=>$page->name,'alias'=>$page->alias);
    		array_push($menu, $item);
    	}

    	$item = array('title'=>'Services','alias'=>'service');
    	array_push($menu, $item);

    	$item = array('title'=>'Portfolio','alias'=>'Portfolio');
    	array_push($menu, $item);

    	$item = array('title'=>'Team','alias'=>'team');
    	array_push($menu, $item);

    	$item = array('title'=>'Contact','alias'=>'contact');
    	array_push($menu, $item);
    	return view('site.index',array(
    		'menu' => $menu,
    		'pages' => $pages,
    		'services' => $services,
    		'portfolios' => $portfolios,
            'peoples' => $peoples,
    		'tags' => $tags
    ));
    }
}
