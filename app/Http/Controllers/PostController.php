<?php

namespace App\Http\Controllers;

use Web\Http\Controller;

use App\Http\Middlewares\Authenticate;

class PostController extends Controller
{

    public function __construct()
    {
        //Authenticate::handle();
    }
    
    /**
    * @var array Before Middlewares
    */
    public $middlewareBefore = [
        \Authenticate::class
    ];

    /**
    * @var array After Middlewares
    */
    public $middlewareAfter = [
        
    ];


    public function index() 
    {
        view('home');
    }

    public function create()
    {
        echo 'created';
    }

    public function store()
    {

    }

    public function show($id)
    {
        echo $id;
    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }

    public function delete()
    {
        
    }


}