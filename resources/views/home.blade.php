@extends('layouts.app')
@section('content')


{{-- Pre-fill edit modal with relevant item --}}
<script>
    $( document ).ready(function() {
        $('#editItem').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)

        // Capture data from the edit button
        var amount = button.data('amount')
        var type = button.data('type')
        var id = button.data('id')

        // Fill the opened modal with data stored in the clicked edit button
        var modal = $(this)
        modal.find('.modal-body input[name=amount]').val(amount);
        modal.find(".modal-body input[name=type][value="+ type +"]").prop('checked', true);
        modal.find(".modal-body input[name=id]").val(id);
    })
});

</script>

<!-- Modal -->
<div class="modal fade" id="editItem" tabindex="-1" role="dialog" aria-labelledby="editItem" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editItem" data-ci>Edit item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{ route('income.update') }}" method="post">
        {{ method_field('patch') }}
        {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                @include('edit')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>
<div class="container" style="height: 1000px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="accordion" id="accordionExample" style="margin-bottom: 15px;">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Add Income
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <form method="POST" action="{{ route('income.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Income type</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="salary" checked>
                                        <label class="form-check-label">
                                            Salary
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type" value="bonus">
                                        <label class="form-check-label">
                                            Bonus
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Income amount</label>
                                    <input name="amount" type="float" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Add an Expense
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <form method="POST" action="/home/expense">
                                @csrf
                                <div class="form-group">
                                    <label>Expense name</label>
                                    <input name="item" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Expense amount</label>
                                    <input name="amount" type="float" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="border-top: 0;" scope="col">Item</th>
                                <th style="border-top: 0;" scope="col">Amount</th>
                                <th style="border-top: 0;" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $income)
                            <tr>
                                <td>{{ ucfirst($income->type) }}</td>
                                <td style="color: green">{{ $income->amount }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{ $income->id }}" data-type="{{ $income->type }}" data-amount="{{ $income->amount }}" data-target="#editItem">Edit</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-id="{{ $income->id }}" data-type="{{ $income->type }}" data-amount="{{ $income->amount }}" data-target="#deleteItem">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ ucfirst($expense->item) }}</td>
                                <td style="color: red">{{ $expense->amount }}</td>
                                <td>Edit</td>
                            </tr>
                            @endforeach
                            @isset($balance)
                            @if ($balance->amount < 0)
                                <tr style="font-size: 20px; color: red;">
                                    <td>Balance:</td>
                                    <td>{{ $balance->amount }}</td>
                                    <td></td>
                                </tr>
                            @else
                                <tr style="font-size: 20px; color: green;">
                                    <td>Balance:</td>
                                    <td>{{ $balance->amount }}</td>
                                    <td></td>
                                </tr>
                            @endif
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
