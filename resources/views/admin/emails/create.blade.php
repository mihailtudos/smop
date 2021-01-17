@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Email</h5>

    <div class="card-body">

        <form class="" action="{{ route('admin.emails.store') }}" method="post" >
            @csrf

            <label for="to" class="col-form-label">To<span class="text-danger">*</span></label>

            <div class="form-group row">
                <div class="col-md-6">
                    <select name="studyField" onselect="findField()" id="studyField" class="form-control @error('studyField') is-invalid @enderror input-lg dynamic" data-dependent="supervisor student">

                        <option value="">Select Study Field</option>
                        @foreach($fields as $field)
                            <option value="{{ $field->name }}">{{ $field->name }}</option>
                        @endforeach
                    </select>

                    @error('studyField')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="studentsCheck" class="ml-3 mr-2 col-form-label" style="padding-right:0px;"> Students </label>
                        <input type="checkbox" id="studentsCheck"  onclick="showOptions()">
                        <select style="display: none" name="student[]" id="student" class="form-control @error('student') is-invalid @enderror input-lg"   type="text" multiple >
                        </select>
                        @error('student')
                        <span class="invalid-feedback" role="alert">
                            <p>Please select a destination</p>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="coordinatorCheck" class="ml-3 mr-2 col-form-label" style="padding-right:0px;"> Supervisor </label>
                        <input type="checkbox" id="coordinatorCheck"  onclick="showOptions()">
                        <select style="display: none" name="supervisor[]" id="supervisor" class="form-control @error('supervisor') is-invalid @enderror input-lg " multiple>
                        </select>
                    </div>
                </div>
                <small id="errorMessageDestination" style="display: none" class="text-danger">No destination set</small>

            </div>

            <div class="form-group ">
                <label for="subject" class="col-form-label @error('subject') is-invalid @enderror">Subject<span class="text-danger">*</span></label>
                <input type="text" name="subject" class="form-control" id="subject" value="{{ old('subject') }}" required>

                @error('subject')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="message" class="col-form-label @error('message') is-invalid @enderror">Message<span class="text-danger">*</span></label>
                <textarea class="form-control" id="message" rows="8" cols="10" name="message" required>{{ old('message') }}</textarea>

                @error('message')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="modal-footer">

                <button type="button" onclick="window.history.back();" class="btn btn-secondary mr-2">
                    Cancel
                </button>
                <button type="submit"  class="btn btn-primary">Send email</button>
            </div>
        </form>


    </div>

@endsection

