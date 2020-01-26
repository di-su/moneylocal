{{-- <form method="POST" action="/home/income"> --}}
    {{-- <input type="hidden" name="_token" value="2OCo5WlJ9rPzklK1gyJDPW2Mzl5Nlp8ewNlMA5m6"> --}}

                                    <div class="form-group">
        <label>Income type</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type" value="salary" checked="">
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
        <input type="number" step="0.01" required="required" name="amount" class="form-control">
    </div>
{{-- </form> --}}
