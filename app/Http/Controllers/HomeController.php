<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $transactions = Transaction::with('category:id,name')
                            ->whereThisMonth()
                            ->get();

        return inertia('Home', ['transactions' => $transactions]);
    }
}
