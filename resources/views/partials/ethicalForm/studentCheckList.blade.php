<!-- Button trigger modal -->
<button type="button" style="width: 100%;" class="btn btn-success btn-lg" data-toggle="modal" data-target="#checkList">
    Check list
</button>

<!-- Modal -->
<div class="modal fade" id="checkList" tabindex="-1" role="dialog" aria-labelledby="checkListLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="checkListLabel">Check list</h4>
            </div>
            <form action="{{ route('student.ethic.form.check', $form) }}" method="post">

            <div class="modal-body">
                @csrf
                    <div class="jumbotron" style="padding: 20px">
                        <h3 style="padding: 10px" class="text-center">Student check list</h3>
                        <div class="checkbox input-form">
                            <label>
                                <input type="checkbox" value="1" name="truthfulness" id="truthfulness">
                                I have fully completed this Ethical Approval Form and have signed where appropriate.
                            </label>
                        </div>

                        <div class="checkbox input-form">
                            <label>
                                <input type="checkbox" value="1" name="supervisor_completed" id="supervisor_completed">
                                My supervisor has completed Section 2 of this Ethical Approval Form and has signed where appropriate.
                            </label>
                        </div>

                        <div class="checkbox input-form">
                            <label>
                                <input type="checkbox" value="1" name="copy_of_instruments" id="copy_of_instruments">
                                I have attached a copy of any research instruments I wish to use (interview questions, questionnaires, etc.). If draft versions, I undertake to have the final versions approved by my supervisor before collecting any data.
                            </label>
                        </div>

                        <div class="checkbox input-form">
                            <label>
                                <input type="checkbox" value="1" name="copy_of_proposal" id="copy_of_proposal">
                                I have attached a copy of my research proposal to this form. The proposal outlines the research methodology I will use
                            </label>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
