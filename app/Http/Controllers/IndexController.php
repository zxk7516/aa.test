<?php
namespace App\Http\Controllers;

use App\Post;
use App\Http\Controllers\Controller as BaseController;

class IndexController extends BaseController {
	public function index(){
		return Post::query()->paginate();	
	}
}

