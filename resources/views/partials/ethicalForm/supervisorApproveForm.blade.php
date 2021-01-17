<button type="button" style="width: 100%" class="btn btn-success btn-lg"  data-toggle="modal" data-target="#myModal">
    Approve
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Supervisor aprovel form</h4>
            </div>

            <form action="{{ route('student.ethic.form.approve', $form) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="jumbotron">
                        <h4 class="text-center">Approve student ethical form</h4>

                        <div class="container">
                            <div class="form-group">
                                <div class="radio @error('needs_to_be_referred') has-error @enderror">
                                    <label>
                                        <input type="radio" name="needs_to_be_referred" id="not_need" value="0" onchange="makeRequired()" required @if(old('needs_to_be_referred') == '0') {{ 'checked' }} @endif>
                                        On the basis of the information provided by the student, the project <strong>DOES NOT</strong> to be referred to the Faculty Research Ethics Committee for approval
                                    </label>
                                </div>

                                <div class="radio @error('reason_to_be_referred') has-error @enderror">
                                    <label>
                                        <input type="radio" name="needs_to_be_referred"  id="need" value="1" onchange="makeRequired()" required @if(old('needs_to_be_referred') == '1') {{ 'checked' }} @endif>
                                        On the basis of the information provided by the student, the project <strong>DOES </strong>need to be referred to the Faculty Research Ethics Committee for approval
                                    </label>
                                </div>
                            </div>

                            <div class="form-group @error('reason_to_be_referred') has-error @enderror ">
                                <label for="reason_to_be_referred" class=" control-label ">If the project needs to be referred to the Faculty Research Ethics Committee for approval, please explain why briefly.</label>
                                <textarea name="reason_to_be_referred" id="reason_to_be_referred" class="form-control" rows="3">{{ old('reason_to_be_referred') }}</textarea>
                            </div>


                            <div class="input-form">
                                <div class="checkbox">
                                    <label for="project_will_contain">
                                        <input type="checkbox" name="project_will_contain"  id="project_will_contain">
                                        On the basis of the information provided by the student, I confirm that the project will contain sensitive or confidential information and should not be placed in the public domain.
                                    </label>
                                </div>
                            </div>

                            <div class="input-form">
                                <div class="radio @error('approved') has-error @enderror">
                                    <label>
                                        <input type="radio" name="approved" id="approved" value="1" onchange="enterReason()" required @if(old('approved') == '1') {{ 'checked' }} @endif>
                                        On the basis of the information provided by the student, I <strong>APPROVE</strong> the revised project.
                                    </label>
                                </div>

                                <div class="radio @error('reason_to_reject') has-error @enderror">
                                    <label>
                                        <input type="radio" name="approved"  id="not_approved" value="0" onchange="enterReason()" @if(old('approved') == '0') {{ 'checked' }} @endif>
                                        On the basis of the information provided by the student, I <strong>DO NOT APPROVE</strong> the revised project.
                                    </label>
                                </div>
                            </div>


                            <div class="input-form">
                                <label for="reason_to_reject">If the revised project is not approved, please explain why briefly.</label>
                                <textarea name="reason_to_reject" id="reason_to_reject" class="form-control" rows="3"></textarea>
                            </div>

                            <div>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <ul>
                        @foreach ($errors->all() as $error)
                           <li><span style="color: red">{{ $error }}</span></li>
                        @endforeach
                        </ul>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script >

    function enterReason() {
        if(!document.getElementById("approved").checked){
            $('#reason_to_reject').prop('required',true);
        } else {
            $('#reason_to_reject').prop('required',false);
        }
    }

    function makeRequired() {
        if(document.getElementById("need").checked){
            $('#reason_to_be_referred').prop('required',true);
        } else {
            $('#reason_to_be_referred').prop('required',false);
        }
    }
</script>
