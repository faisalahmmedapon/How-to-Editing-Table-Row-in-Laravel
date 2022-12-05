Step 1: Install Laravel

first of all we need to get fresh Laravel 8 version application using bellow command, So open your terminal OR command prompt and run bellow command:

composer create-project --prefer-dist laravel/laravel blog

Step 2: Add Dummy Users

In this step, we need to create add some dummy users using factory.

php artisan tinker

    

User::factory()->count(10)->create()

Read Also: Laravel 8 Multi Auth (Authentication) Tutorial

Step 3: Create Route

In this is step we need to create some routes for add to cart function.

routes/web.php

<?php

  

use Illuminate\Support\Facades\Route;

  

use App\Http\Controllers\UserController;

  

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/

  

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::post('users', [UserController::class, 'update'])->name('users.update');

Step 4: Create Controller

in this step, we need to create UserController and add following code on that file:

app/Http/Controllers/UserController.php

<?php

  

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;

use App\Models\User;

  

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

            User::find($request->pk)

                ->update([

                    $request->name => $request->value

                ]);

  

            return response()->json(['success' => true]);

        }

    }

}

Step 5: Create Blade Files

here, we need to create blade files for users, products and cart page. so let's create one by one files:

resources/views/users.blade.php

<!DOCTYPE html>

<html>

<head>

    <title>Laravel Table Inline Editing</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>

    <script>$.fn.poshytip={defaults:null}</script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>

</head>

<body>

      

<div class="container">

    <h1>Laravel Table Inline Editing</h1>

    <table class="table table-bordered data-table">

        <thead>

            <tr>

                <th>No</th>

                <th>Name</th>

                <th>Email</th>

            </tr>

        </thead>

        <tbody>

            @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>

                        <a href="" class="update" data-name="name" data-type="text" data-pk="{{ $user->id }}" data-title="Enter name">{{ $user->name }}</a>

                    </td>

                    <td>

                        <a href="" class="update" data-name="email" data-type="text" data-pk="{{ $user->id }}" data-title="Enter email">{{ $user->email }}</a>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

     

</body>

     

<script type="text/javascript">

    $.fn.editable.defaults.mode = 'inline';

  

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': '{{csrf_token()}}'

        }

    }); 

  

    $('.update').editable({

           url: "{{ route('users.update') }}",

           type: 'text',

           pk: 1,

           name: 'name',

           title: 'Enter name'

    });

</script>

</html>

Now we are ready to run our example so run bellow command so quick run:

php artisan serve
