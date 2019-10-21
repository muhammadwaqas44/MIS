<table style="width:50%; text-align: left;">
    <tbody>
    <tr>
        <td style="font-size: 20px">Balance of Qamar= {{$awais}}</td>
    </tr>
    <tr>
        <td style="font-size: 20px">Balance of Awais = {{$qamar}}</td>
    </tr>
    </tbody>
</table>


<div style="text-align: center; width: 100%;">
    <h2>Funds</h2>
</div>
@if($totalExpensesFunds->count()>0)
    <table style="text-align: center; border-collapse: collapse;
  width: 100%; border: 1px solid #ddd; padding: 15px;">
        <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px;"> Amount</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Date</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Type</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Category</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Description</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Employee Name</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Created By</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($totalExpensesFunds as $Expense)
            <tr class="odd gradeX">
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$Expense->amount}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$Expense->date}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;">{{$Expense->typeName->name}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;">{{$Expense->categoryName->name}}</td>
                <td class="center" style="border: 1px solid #ddd; padding: 15px;">{{$Expense->description}}</td>
                <td class="center"
                    style="border: 1px solid #ddd; padding: 15px;">@if(isset($Expense->empName)){{$Expense->empName->first_name}} {{$Expense->empName->last_name}} @endif</td>
                <td class="center"
                    style="border: 1px solid #ddd; padding: 15px;">@if(isset($Expense->createdBy)){{$Expense->createdBy->first_name}} {{$Expense->createdBy->last_name}} @endif</td>
                <td class="center" style="border: 1px solid #ddd; padding: 15px;">{{$Expense->created_at}} </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px;">{{$totalExpensesFundsSum}}</th>
            <th colspan="7" style="border: 1px solid #ddd; padding: 15px;">Total Funds</th>
        </tr>
        </tfoot>
    </table>
@else
    <div style="text-align: center; width: 100%;">
        <h1 style="color: red"> No Entry Found </h1>
    </div>
@endif
<div style="text-align: center; width: 100%;">
    <h2> Expenses</h2>
</div>
@if($totalExpensesExp->count()>0)
    <table style="text-align: center; border-collapse: collapse;
  width: 100%; border: 1px solid #ddd; padding: 15px;">
        <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px;"> Amount</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Date</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Type</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Category</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Description</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Employee Name</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Created By</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($totalExpensesExp as $Expense)
            <tr class="odd gradeX">
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$Expense->amount}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$Expense->date}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;">{{$Expense->typeName->name}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;">{{$Expense->categoryName->name}}</td>
                <td class="center" style="border: 1px solid #ddd; padding: 15px;">{{$Expense->description}}</td>
                <td class="center"
                    style="border: 1px solid #ddd; padding: 15px;">@if(isset($Expense->empName)){{$Expense->empName->first_name}} {{$Expense->empName->last_name}} @endif</td>
                <td class="center"
                    style="border: 1px solid #ddd; padding: 15px;">@if(isset($Expense->createdBy)){{$Expense->createdBy->first_name}} {{$Expense->createdBy->last_name}} @endif</td>
                <td class="center" style="border: 1px solid #ddd; padding: 15px;">{{$Expense->created_at}} </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px;">{{$totalExpensesExpSum}}</th>
            <th colspan="7" style="border: 1px solid #ddd; padding: 15px;">Total Expenses</th>
        </tr>
        </tfoot>
    </table>
@else
    <div style="text-align: center; width: 100%;">
        <h1 style="color: red"> No Entry Found</h1>
    </div>
@endif

