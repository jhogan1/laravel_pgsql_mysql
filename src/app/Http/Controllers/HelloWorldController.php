<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * class HelloWorldController
 */
class HelloWorldController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
   public function index(Request $request): Response
   {
       $name = $request->get('name', 'Whoops!!');

       return response()->make("<h1>Hello World! This is ".$name, 200);
   }
}
