@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Submit ethical form</h5>

    <div class="card-body px-5">

        <div class="d-flex justify-content-center p-2 border-top border-bottom border-dark mb-4">
            <h3>
                Ethical Approval Form
            </h3>
        </div>

        <div class="border border-danger p-3">
            <ul>
                <li>
                    <h5>This form must be completed, signed and submitted by the due date</h5>
                </li>
                <li>
                    <h5>No work may be carried out on the project until the form has been submitted</h5>
                </li>
                <li>
                    <h5>Late submission will result in a penalty</h5>
                </li>
                <li>
                    <h5>Failure to submit the form will result in an automatic fail for the module. You may also be subject to disciplinary action</h5>
                </li>
            </ul>
        </div>




        <form action="{{ route('student.form.store') }}" method="post">
            @csrf

            <div class="my-5">
                <h3>Declaration</h3>
            </div>

            <div class="custom-control custom-switch mb-4">
                <input type="checkbox"  class="custom-control-input @error('confirm') is-invalid @enderror" @if(old('confirm')) checked @endif id="confirm" name="confirm" required>
                <label class="custom-control-label" for="confirm">I confirm that I have read and understood the Research Ethical Guidelines and agree to abide by them in conducting my project</label>

                @error('confirm')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="custom-control custom-switch mb-4">
                <input type="checkbox"  class="custom-control-input @error('confirm1') is-invalid @enderror" @if(old('confirm1')) checked @endif id="confirm1" name="confirm1" required>
                <label  class="custom-control-label" for="confirm1">I confirm that I understand the importance of adhering to the Research Ethical Guidelines and I am aware of the penalties for breaching them</label>

                @error('confirm1')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="custom-control custom-switch mb-4">
                <input type="checkbox"  class="custom-control-input @error('confirm2') is-invalid @enderror" @if(old('confirm2')) checked @endif id="confirm2" name="confirm2" required>
                <label class="custom-control-label" for="confirm2">I agree to notify my academic supervisor if there is a change to my project and/or further ethical approval is needed</label>

                @error('confirm2')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="custom-control custom-switch mb-4">
                <input type="checkbox"  class="custom-control-input @error('confirm3') is-invalid @enderror" @if(old('confirm3')) checked @endif id="confirm3" name="confirm3" required>
                <label class="custom-control-label" for="confirm3">I agree to notify my academic supervisor if there is a change to my project and/or further ethical approval is needed</label>

                @error('confirm3')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="my-5">
                <h4>To the best of my knowledge, I confirm that:</h4>
            </div>

            <div class="custom-control custom-switch mb-4">
                <input type="checkbox"  class="custom-control-input @error('confirm4') is-invalid @enderror" @if(old('confirm4')) checked @endif id="confirm4" name="confirm4" required>
                <label class="custom-control-label" for="confirm4">There is no risk to any participants</label>

                @error('confirm4')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="custom-control custom-switch mb-4">
                <input type="checkbox"  class="custom-control-input @error('confirm5') is-invalid @enderror" @if(old('confirm5')) checked @endif id="confirm5" name="confirm5" required>
                <label class="custom-control-label" for="confirm5">There is no risk to me</label>

                @error('confirm5')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="custom-control custom-switch mb-4">
                <input type="checkbox"  class="custom-control-input @error('confirm6') is-invalid @enderror" @if(old('confirm6')) checked @endif id="confirm6" name="confirm6" required>
                <label class="custom-control-label" for="confirm6">There is no risk to the institution or QA in terms of liability or reputation</label>

                @error('confirm6')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group ">
                <label for="user" class=" col-form-label text-md-right">Student name<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('user') is-invalid @enderror"  name="user" id="user" value="{{ old('user') }}" disabled placeholder="{{ auth()->user()->name }}" required >
                <small id="bodyHelper" class="form-text text-muted">This declaration will be signed with your name.</small>

                @error('user')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group ">
                <label for="student_id" class=" col-form-label text-md-right">Student ID<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('student_id') is-invalid @enderror"  name="student_id" id="student_id" value="{{ old('student_id') }}" minlength="11" maxlength="11" placeholder="{{ 'STU83923441' }}" required >
                <small id="bodyHelper" class="form-text text-muted">Enter your 11 character student ID</small>

                @error('student_id')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group row mb-0 ">
                <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary">
                        Sign
                    </button>
                    <a role="button" href="{{ route('student.form.index') }}" class="btn btn-secondary mr-2 text-white">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    </div>

@endsection
