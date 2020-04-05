<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class FooController extends Controller
{
    //
    public function foo1()
    {
        # code...
        return 'foo1';
    }

    public function foo2()
    {
        return view('foo.foo2', [
            'title' => 'Foo2',
            'body' => 'my first laravel.'
        ]);
    }

    public function foo3(){
        $user = User::find(1);
        return view('foo.foo3',[
            'user' => $user
        ]);
    }

    public function foo4(){
        return view('foo.foo4', [
            'title' => 'Foo4',
            'body' => 'Hello World!'
        ]);
    }
}
