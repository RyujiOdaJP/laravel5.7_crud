<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use GuzzleHttp\Middleware;
use app\Http\Requests\StoreUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \app\Http\Requests\StoreUser $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect('users/' . $user->id)->with('my_status', __('Created new user.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // そのユーザーが投稿した記事のうち、最新5件を取得
        $user->posts = $user->posts()->paginate(5);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit', $user);

        // name欄だけを検査するため、元のStoreUserクラス内のバリデーション・ルールからname欄のルールだけを取り出す。
        $request->validate([
            'name' => (new StoreUser())->rules()['name']
            ]);
        $user->name = $request->name;
        $user->save();
        return redirect('users/' . $user->id)->with('my_status', __('Updated a user.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('edit', $user);
        $user->delete();
        return redirect('users')->with('my_status', __('Deleted a user.'));
    }

    public function __construct()
    {
        $this->Middleware('auth')->except(['index','show']);
    }
}
