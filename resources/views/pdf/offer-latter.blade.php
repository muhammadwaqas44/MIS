<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        body {
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div style="text-align: center; align-content: center">
            <img src="{{public_path('/favicon/technerds.png')}}" style="width: 100px; height: 100px;"></div>
        <br><br>
        Date: {{$date_now}}
        <br>
        <br>
        {{$name}}
        <br>
        {{$address}},
        <br>
        {{$city}}.
        <br>
        <br>
        RE: LETTER OF OFFER OF EMPLOYMENT – {{$position}}
        <br>
        <br>
        Dear {{$name}}
        <p style="text-align: justify">Following our recent discussions, we are delighted to offer you the position
            of <b>{{$position}}</b> with Tech
            Nerds.
            Our Organization is a leading digital agency in the international market, operating over 12 years now. If
            you
            join us, you will become part of a fast-paced and dedicated team that works together to provide our clients
            with
            the highest possible level of service and advice.</p>
        <p style="text-align: justify">As a member of Tech Nerds team, we would ask for your commitment to deliver
            outstanding quality and results that
            exceed client expectations. In addition, we expect your personal accountability in all the products,
            actions,
            advice and results that you provide as a representative of Tech Nerds. In return, we are committed to
            providing
            you with every opportunity to learn, grow and stretch to the highest level of your ability and
            potential.</p>
        <p style="text-align: justify">We are confident you will find this new opportunity both challenging and
            rewarding. The following points outline
            the terms and conditions we are proposing.</p>
        Joining date: <b>{{$join_date}}</b>
        <br>
        <br>
        Commitment: <b>{{$salary_probation}}</b>
        <br>
        <br>
        Hours of work: Company expects each employee to work 40 hours a week
        <br>
        <br>
        Vacation:<br>
        Three types of leaves are granted. The limits for each type listed in the matrix given below.<br><br>
        <table style="border:1px solid #ddd;width: 350px; text-align: center;border-collapse: collapse;" align="center">
            <thead>
            <tr>
                <th style="border: 1px solid #ddd;">#</th>
                <th style="border: 1px solid #ddd;">Leave Type</th>
                <th style="border: 1px solid #ddd;">Days</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="border: 1px solid #ddd;">1</td>
                <td style="border: 1px solid #ddd;">Casual</td>
                <td style="border: 1px solid #ddd;">10</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd;">2</td>
                <td style="border: 1px solid #ddd;">Medical</td>
                <td style="border: 1px solid #ddd;">16</td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd;">3</td>
                <td style="border: 1px solid #ddd;">Annual</td>
                <td style="border: 1px solid #ddd;">10</td>
            </tr>
            </tbody>
        </table>
        <p style="text-align: justify">Following the initial probationary period of 89 Days, a progression and
            performance review will be conducted on
            a quarterly basis to assess performance to-date, and to clarify or modify this arrangement, as the need may
            arise.</p>
        <p style="text-align: justify">This arrangement may be terminated by either party upon notice in writing to
            either party with notice that
            complies with Employment Standards (or Labor Standards) for Punjab</p>
        <p style="text-align: justify">We look forward to the opportunity to work with you in an atmosphere that is
            successful and mutually challenging
            and rewarding.</p>
        <p style="text-align: justify"><b>Also, please bring Laptop and copies of all your educational documents, Copy
                of CNIC, 2 Passport size pictures
                and your original Transcript.</b></p>
        <br>
        Sincerely,
        <br><br>
        Ishtiaq Haider
        <br>
        Manager HR
        <br><br>
        Tech Nerds
    </div>
    <br>
    <div class="col-1"></div>
</div>
</body>
</html>