<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreateRequest;
use App\Http\Requests\TransactionFilterRequest;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('category')
                            ->whereThisMonth()
                            ->orderBy('id', 'DESC')
                            ->get();

        $categories = Category::all();

        $title = "لیست تراکنش ها";

        return inertia('TransactionsPage', compact('transactions', 'categories', 'title'));
    }

    public function filter(TransactionFilterRequest $request)
    {
        $transactions = Transaction::with('category');

        if ($request->starts_at) {
            $transactions->whereDate('created_at', '>=', $request->starts_at);
        }
        if ($request->ends_at) {
            $transactions->whereDate('created_at', '<=', $request->ends_at);
        }

        if ($request->category_id) {
            $transactions->where('category_id', $request->category_id);
        }

        if ($request->type) {
            $transactions->where('type', $request->type);
        }

        $transactions = $transactions->orderBy('id', 'DESC')
                            ->get();

        return response()->json($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return inertia('Transaction/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionCreateRequest $request)
    {
        Transaction::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
    }
}
