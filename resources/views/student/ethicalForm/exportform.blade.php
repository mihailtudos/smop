<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            background: rgb(204,204,204);
        }
        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.9);
        }
        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            padding: 2.5cm 2.5cm;
        }
        .btn-success{

            background-color: #00ad81 !important;
        }

        @media print {
            body, page {
                margin: 0;
                box-shadow: 0;
            }
        }

        .input-form {
            padding: 7px;
        }
    </style>
</head>
<body @if(session()->has('modal')) onload="$('#myModal').modal('show');" @endif>
<page size="A4">
    <div class="" >
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
                <td><div><strong>NAME:</strong></div>
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
                    <p style="border: 1px solid black; padding: 1rem; text-align: center">{{ $form->project->title }}</p></td>
                <td></td>
            </tr>
            </tbody>
        </table>

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
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h6></td>

                <td><h6 class="text-center">DATE:</h6></td>
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ $form->created_at->format('yy/m/d') }}</h6></td>
            </tr>
            </thead>
        </table>
    </div>
</page>
@if(isset($form->approved))
    <page size="A4">
        <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
            <thead style="background: #F5F5F5;">
            <tr>
                <th>SECTION 2</th>
                <th class="text-right">TO BE COMPLETED BY SUPERVISOR</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><div><strong>NAME:</strong></div>
                <td style="border: 1px solid black" class="text-left">{{ $form->project->supervisor->name }}</td>
            </tr>
            </tbody>
        </table>

        <h5 style="font-weight: bold">DECLARATION: </h5>
        <div>
            <p>I undertake to review and approve any questions that the student intends to use for data collection, including interview questions and questionnaire items.</p>
        </div>
        <br>
        <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
            <tbody>
            <tr>
                <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->needs_to_be_referred == 0) X @else &nbsp; @endif</strong></div>
                <td style="padding-top: 1.5rem"><p>On the basis of the information provided by the student, the project <strong>DOES NOT</strong> need to be referred to the Faculty Research Ethics Committee for approval.</p></td>
            </tr>
            <tr>
                <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->needs_to_be_referred == 1) X @else &nbsp; @endif</strong></div>
                <td style="padding-top: 1.5rem"><p>On the basis of the information provided by the student, the project <strong>DOES</strong> need to be referred to the Faculty Research Ethics Committee for approval.</p></td>
            </tr>
            </tbody>
        </table>


        <div>
            <p>If the project needs to be referred to the Faculty Research Ethics Committee for approval, please explain why briefly.</p>
        </div>
        <div class="w-100" style="border: 1px solid black; height: 100px; padding: 7px">@if($form->needs_to_be_referred == 1) {{ $form->reason_to_be_referred }}  @else &nbsp; @endif</div>

        <br>
        <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
            <tbody>
            <tr>
                <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->project_will_contain == 1) X @else &nbsp;&nbsp;&nbsp;&nbsp; @endif</strong></div>
                <td style="padding-top: 1.5rem"><p>On the basis of the information provided by the student, I confirm that the project will contain sensitive or confidential information and should <strong>NOT</strong> be placed in the public domain</p></td>
            </tr>
            </tbody>
        </table>

        <br>
        <table  class="table" style="border-collapse:separate; border-spacing: 0 1rem;">
            <thead>
            <tr>
                <td><h6>NAME:</h6></td>
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ strtoupper($form->project->supervisor->name) }}</h6></td>

                <td><h6 class="text-center">SIGNATURE:</h6></td>
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h6></td>

                <td><h6 class="text-center">DATE:</h6></td>
                <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ $form->created_at->format('yy/m/d') }}</h6></td>
            </tr>
            </thead>
        </table>
    </page>
    <page size="A4">
        <div class="">
            <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
                <thead style="background: #F5F5F5;">
                <tr>
                    <th>SECTION 3</th>
                    <th class="text-right">TO BE COMPLETED BY SUPERVISOR</th>
                </tr>
                </thead>
            </table>

            <h5 style="font-weight: bold">CHANGES TO PROJECT - DECLARATION:</h5>
            <div>
                <p>I have reviewed the proposed changes to the project.</p>
            </div>


            <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
                <tbody>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->approved == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>On the basis of the information provided by the student, I <strong>APPROVE</strong> the revised project.</p></td>
                </tr>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->approved == 0) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>On the basis of the information provided by the student, I <strong>DO NOT APPROVE</strong> the revised project.</p></td>
                </tr>
                </tbody>
            </table>
            <div>
                <div>
                    <p>If the project needs to be referred to the Faculty Research Ethics Committee for approval, please explain why briefly.</p>
                </div>
                <div class="w-100" style="border: 1px solid black; height: 100px; padding: 7px;">{{$form->reason_to_reject}}</div>
            </div>
            <br>
            <table  class="table" style="border-collapse:separate; border-spacing: 0 1rem;">
                <thead>
                <tr>
                    <td><h6>NAME:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ strtoupper($form->project->supervisor->name) }}</h6></td>

                    <td><h6 class="text-center">SIGNATURE:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h6></td>

                    <td><h6 class="text-center">DATE:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ $form->created_at->format('yy/m/d') }}</h6></td>
                </tr>
                </thead>
            </table>
        </div>
    </page>
@endif


@if(auth()->user()->hasAnyRoles(['admin', 'supervisor']) and (!isset($form->approved) or $form->approved == 0) )
    <!-- Button trigger modal -->
    <page size="A4">
        <div class="">
            <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
                <thead style="background: #F5F5F5;">
                <tr>
                    <th>SECTION 4</th>
                    <th class="text-right">TO BE COMPLETED BY STUDENT</th>
                </tr>
                </thead>
            </table>

            <h5 style="font-weight: bold">CHECKLIST: </h5>
            <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
                <tbody>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->truthfulness == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>I have fully completed this Ethical Approval Form and have signed where appropriate.</p></td>
                </tr>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->supervisor_completed == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>My supervisor has completed Section 2 of this Ethical Approval Form and has signed where appropriate.</p></td>
                </tr>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->copy_of_instruments == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>I have attached a copy of any research instruments I wish to use (interview questions, questionnaires, etc.). If draft versions, I undertake to have the final versions approved by my supervisor before collecting any data.</p></td>
                </tr>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->copy_of_proposal == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>I have attached a copy of my research proposal to this form. The proposal outlines the research methodology I will use.</p></td>
                </tr>
                </tbody>
            </table>

            <br>
            <table  class="table" style="border-collapse:separate; border-spacing: 0 1rem;">
                <thead>
                <tr>
                    <td><h6>NAME:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ strtoupper($form->user->name) }}</h6></td>

                    <td><h6 class="text-center">SIGNATURE:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h6></td>

                    <td><h6 class="text-center">DATE:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ $form->created_at->format('yy/m/d') }}</h6></td>
                </tr>
                </thead>
            </table>
        </div>
    </page>
    @include('partials.ethicalForm.supervisorApproveForm')

@endif

@if(auth()->user()->hasRole('student'))


    <page size="A4">
        <div class="">
            <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
                <thead style="background: #F5F5F5;">
                <tr>
                    <th>SECTION 4</th>
                    <th class="text-right">TO BE COMPLETED BY STUDENT</th>
                </tr>
                </thead>
            </table>

            <h5 style="font-weight: bold">CHECKLIST: </h5>
            <table class="table"  style="border-collapse:separate; border-spacing: 0 5px;">
                <tbody>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->truthfulness == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>I have fully completed this Ethical Approval Form and have signed where appropriate.</p></td>
                </tr>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->supervisor_completed == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>My supervisor has completed Section 2 of this Ethical Approval Form and has signed where appropriate.</p></td>
                </tr>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->copy_of_instruments == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>I have attached a copy of any research instruments I wish to use (interview questions, questionnaires, etc.). If draft versions, I undertake to have the final versions approved by my supervisor before collecting any data.</p></td>
                </tr>
                <tr>
                    <td><div style="border: 1px solid black; padding: 0.5rem 1rem; text-align: center;"><strong>@if($form->copy_of_proposal == 1) X @else &nbsp; @endif</strong></div>
                    <td style="padding-top: 1.5rem"><p>I have attached a copy of my research proposal to this form. The proposal outlines the research methodology I will use.</p></td>
                </tr>
                </tbody>
            </table>

            <br>
            <table  class="table" style="border-collapse:separate; border-spacing: 0 1rem;">
                <thead>
                <tr>
                    <td><h6>NAME:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ strtoupper($form->user->name) }}</h6></td>

                    <td><h6 class="text-center">SIGNATURE:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h6></td>

                    <td><h6 class="text-center">DATE:</h6></td>
                    <td class="text-right" style="border: 1px solid black"><h6 class="text-left">{{ $form->created_at->format('yy/m/d') }}</h6></td>
                </tr>
                </thead>
            </table>
        </div>
    </page>
    @include('partials.ethicalForm.studentCheckList')
 @endif


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>


