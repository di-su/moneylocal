<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Expense;
use App\Income;
use Illuminate\Http\Request;

class ExpensesController extends Controller {
	public function store() {
		$user = auth()->user();
		$expense = new Expense(request(['item', 'amount']));
		$expense->amount = -1 * abs($expense['amount']);
		$expense->user_id = $user->id;
		$expense->save();

		// Sum incomes.amount + expenses.amount where user_id is this logged in user

		// Instantiate balance variable
		$balance = new Balance();

		// Get sum of income.amount
		$income_amount = Income::latest()->where('user_id', $user->id)->get();
		$income_amount = $income_amount->sum('amount');

		// Get sum of expenses.amount
		$expenses_amount = Expense::latest()->where('user_id', $user->id)->get();
		$expenses_amount = $expenses_amount->sum('amount');

		// Add both together
		$balance->amount = $income_amount + $expenses_amount;

		$balance->user_id = $user->id;
		$balance->save();

		return redirect(route('home'));
	}
}
