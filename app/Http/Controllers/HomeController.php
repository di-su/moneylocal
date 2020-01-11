<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Expense;
use App\Income;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		$user = auth()->user();
		$user_id = $user->id;
		$incomes = Income::orderBy('created_at', 'asc')->where('user_id', $user_id)->get();
		$expenses = Expense::orderBy('created_at', 'asc')->where('user_id', $user_id)->get();
		$balance = Balance::latest('created_at')->first();
		return view('home', [
			'incomes' => $incomes,
			'expenses' => $expenses,
			'balance' => $balance,
		]
		);
	}
}
