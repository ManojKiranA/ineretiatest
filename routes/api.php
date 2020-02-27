<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allUsers',function(){

    \Illuminate\Database\Query\Builder::macro('selectConcat',function(string $concatString, ?string $aliasName = null){
        if(! $aliasName):
            return $this->select(\Illuminate\Support\Facades\DB::raw("CONCAT({$concatString})"));
        else:
            return $this->select(\Illuminate\Support\Facades\DB::raw("CONCAT({$concatString}) AS {$aliasName}"));
        endif;
     });

    \Illuminate\Database\Query\Builder::macro('addSelectConcat',function(string $concatString, ?string $aliasName = null){
        if(! $aliasName):
            return $this->addSelect(\Illuminate\Support\Facades\DB::raw("CONCAT({$concatString})"));
        else:
            return $this->addSelect(\Illuminate\Support\Facades\DB::raw("CONCAT({$concatString}) AS {$aliasName}"));
        endif;
    });

    //to select id and concat of name and email

    // $usersList = User::query()
    //                 ->select('id')
    //                 ->addSelectConcat('name," (",email,")"','nameEmail')
    //                 ->pluck('nameEmail','id')
    //                 // ->get()
    //                 ;

    $usersList = DB::table((new User)->getTable())
                    ->select('id')
                    ->addSelectConcat('name," (",email,")"')
                    ->get();

        return response($usersList);
});
