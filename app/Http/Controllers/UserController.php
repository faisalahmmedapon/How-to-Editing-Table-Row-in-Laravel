<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $users = User::paginate(10);
        return view('users', compact('users'));
    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function update(Request $request)

    {

        if ($request->ajax()) {
            User::find($request->pk)->update([
                    $request->name => $request->value
                ]);
            return response()->json(['success' => true]);
        }
    }
}
