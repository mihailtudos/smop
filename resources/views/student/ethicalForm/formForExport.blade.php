<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Ethical Form</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .page-break {
            page-break-after: always;
        }
        .text-right {
            text-align: right;
        }

        li{
            margin-bottom: 5px;
        }
    </style>

</head>
<body class="login-page" style="background: white">
<div class="container">


    <div>
        <div class="row">
            <div class="col-xs-2">
                <img style="width: 105px" src="https://i.imgur.com/PiAbXWa.png" alt="">
            </div>
            <div class="col-xs-8 text-center">
                <h1>Ethical Approval Form</h1>
            </div>
        </div>

        <div>
            <ul style="list-style-type: square;" class="">
                <li class="m">This form must be completed, signed and submitted by the due date.</li>
                <li>No work may be carried out on the project until the form has been submitted.</li>
                <li>Late submission will result in a penalty.</li>
                <li>Failure to submit the form will result in an automatic fail for the module. You may also be subject to disciplinary action.</li>
            </ul>
        </div>

        <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
            <thead style="background: #F5F5F5;">
            <tr>
                <th>SECTION 1</th>
                <th class="text-right">TO BE COMPLETED BY STUDENT </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><div><strong>NAME</strong></div>
                <td style="border: 1px solid black" class="text-left">{{ strtoupper($form->user->name) }}</td>
            </tr>
            <tr>
                <td><div><strong>STUDENT NO:</strong></div>
                   </td>
                <td style="border: 1px solid black; letter-spacing: 5px" class="text-left">{{ strtoupper($form->student_id) }}</td>
            </tr>
            <tr>
                <td><div><strong>COURSE:</strong></div>
                </td>
                <td style="border: 1px solid black; " class="text-left">{{ strtoupper($form->user->fields()->first()->name) }}</td>
            </tr>
            <tr>
                <td><div><strong>MODULE:</strong></div>
                </td>
                <td style="border: 1px solid black; " class="text-left">DISSERTATION (MAJOR PROJECT)</td>
            </tr>
            <tr>
                <td colspan="2"><div><strong>PROJECT TITLE:</strong></div>
                    <p style="border: 1px solid black; padding: 1rem; text-align: center">Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt maiores placeat similique nisi. Nisi ratione, molestias exercitationem illo reiciendis cumque?</p></td>
                <td></td>
            </tr>
            </tbody>
        </table>

{{--        <table  class="table" style="border-collapse:separate; border-spacing: 0 10px;">--}}
{{--            <thead style="background: #F5F5F5;  ">--}}
{{--            <tr>--}}
{{--                <td><h5>SECTION 1</h5></td>--}}
{{--                <td class="text-right"><h5 class="text-right"></h5></td>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <td ><h6>NAME:</h6></td>--}}
{{--                <td style="border: 1px solid black"><h6>{{ strtoupper($form->user->name) }}</h6></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td ><h6>STUDENT NO:</h6></td>--}}
{{--                <td style="letter-spacing: 20px; border: 1px solid black"><h6>{{ strtoupper($form->student_id) }}</h6></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td ><h6>COURSE:</h6></td>--}}
{{--                <td style="border: 1px solid black"><h6>{{ strtoupper($form->user->fields()->first()->name) }}</h6></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td ><h6>MODULE:</h6></td>--}}
{{--                <td style="border: 1px solid black"><h6>DISSERTATION (MAJOR PROJECT)</h6></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{--        <h6>PROJECT TITLE: </h6>--}}
{{--                <h6  style="padding: 1rem 3rem 1rem 10rem; border: 1px solid black;">{{strtoupper($form->user->projects()->first()->title) }}</h6>--}}
{{--        <br>--}}
        <h5 style="font-weight: bold">DECLARATION: </h5>
        <div>
            <ul style="list-style-type: square;" class="">
                <li class="m">I confirm that I have read and understood the Research Ethical Guidelines and agree to abide by them in conducting my project.</li>
                <li>I confirm that I understand the importance of adhering to the Research Ethical Guidelines and I am aware of the penalties for breaching them.</li>
                <li>I agree to notify my academic supervisor if there is a change to my project and/or further ethical approval is needed.</li>
            </ul>
        </div>

        <p>To the best of my knowledge, I confirm that:</p>
        <ul style="list-style-type: square;" class="">
            <li class="m">There is no risk to any participants</li>
            <li>There is no risk to me</li>
            <li>There is no risk to the institution or QA in terms of liability or reputation</li>
        </ul>

        <p>I undertake to report all data and findings in a responsible way</p>

        <table  class="table" style="border-collapse:separate; border-spacing: 0 1rem;">
            <thead>
            <tr>
                <td><h6>NAME:</h6></td>
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ strtoupper($form->user->name) }}</h6></td>

                <td><h6 class="text-center">SIGNATURE:</h6></td>
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ strtoupper($form->user->name) }}</h6></td>

                <td><h6 class="text-center">DATE:</h6></td>
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ $form->created_at->format('yy/m/d') }}</h6></td>
            </tr>
            </thead>
        </table>
        <div class="page-break"></div>

        <div class="row">
            <div class="col-xs-6">
                <h5>To:</h5>
                <address>
                    <strong>Andre Madarang</strong><br>
                    <span>andre@andre.com</span> <br>
                    <span>123 Address St.</span>
                </address>
            </div>

            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                    <tr>
                        <th>Invoice Num:</th>
                        <td class="text-right">56</td>
                    </tr>
                    <tr>
                        <th> Invoice Date: </th>
                        <td class="text-right">Oct 1, 2018</td>
                    </tr>
                    </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table style="width: 100%; margin-bottom: 20px">
                    <tbody>
                    <tr class="well" style="padding: 5px">
                        <th style="padding: 5px"><div> Balance Due (CAD) </div></th>
                        <td style="padding: 5px" class="text-right"><strong> $600 </strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <table class="table">
            <thead style="background: #F5F5F5;">
            <tr>
                <th>Item List</th>
                <th></th>
                <th class="text-right">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><div><strong>Service</strong></div>
                    <p>Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt maiores placeat similique nisi. Nisi ratione, molestias exercitationem illo reiciendis cumque?</p></td>
                <td></td>
                <td class="text-right">$600</td>
            </tr>
            <tr>
                <td><div><strong>Service</strong></div>
                    <p>Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt maiores placeat similique nisi. Nisi ratione, molestias exercitationem illo reiciendis cumque?</p></td>
                <td></td>
                <td class="text-right">$600</td>
            </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                    <tr class="well" style="padding: 5px">
                        <th style="padding: 5px"><div> Balance Due (CAD) </div></th>
                        <td style="padding: 5px" class="text-right"><strong> $600 </strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-8 invbody-terms">
                Thank you for your business. <br>
                <br>
                <h5>Payment Terms</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eius quia, aut doloremque, voluptatibus quam ipsa sit sed enim nam dicta. Soluta eaque rem necessitatibus commodi, autem facilis iusto impedit!</p>
            </div>
        </div>
    </div>
    page 2
    <h1>
        <h5>From:</h5>
        <strong>Company Inc.</strong><br>
        123 Company Ave. <br>
        Toronto, Ontario - L2R 5A4<br>
        P: (416) 123-4567 <br>
        E: copmany@company.com <br>
    </h1>
</div>


</body>
</html>
