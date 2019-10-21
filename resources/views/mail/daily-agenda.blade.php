<div style="text-align: center; width: 100%;">
    <h2>Today interviews scheduled</h2>
</div>
@if($interViewShedule->count()>0)

    <table style="text-align: center; border-collapse: collapse;
  width: 100%; border: 1px solid #ddd; padding: 15px;">
        <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px;"> ID</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Name</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Email</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Mobile</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Post</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Interview Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($interViewShedule as $schedule)
            <tr class="odd gradeX">
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$schedule->applicant->id}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$schedule->applicant->name}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"><a
                            href="mailto:{{$schedule->applicant->email}}"> {{$schedule->applicant->email}}</a></td>
                <td style="border: 1px solid #ddd; padding: 15px;">{{$schedule->applicant->user_phone}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{ $schedule->applicant->designation->name}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{ $schedule->dateTime}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div style="text-align: center; width: 100%;">
        <h1 style="color: red"> No Entry Found</h1>
    </div>s
@endif
<div style="text-align: center; width: 100%;">
    <h2> Today Joiners</h2>
</div>
@if($joiningEmployee->count()>0)

    <table style="text-align: center; border-collapse: collapse;
  width: 100%; border: 1px solid #ddd; padding: 15px;">
        <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 15px;"> ID</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Name</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Email</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Mobile</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Post</th>
            <th style="border: 1px solid #ddd; padding: 15px;"> Joining Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($joiningEmployee as $joining)
            <tr class="odd gradeX">

                <td style="border: 1px solid #ddd; padding: 15px;"> {{$joining->applicant->id}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{$joining->applicant->name}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;">
                    <a href="mailto:{{$joining->applicant->email}}"> {{$joining->applicant->email}}</a>
                </td>

                <td style="border: 1px solid #ddd; padding: 15px;">{{$joining->applicant->user_phone}}</td>

                <td style="border: 1px solid #ddd; padding: 15px;"> {{ $joining->applicant->designation->name}}</td>
                <td style="border: 1px solid #ddd; padding: 15px;"> {{ $joining->dateTime}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div style="text-align: center; width: 100%;">
        <h1 style="color: red"> No Entry Found</h1>
    </div>
@endif

