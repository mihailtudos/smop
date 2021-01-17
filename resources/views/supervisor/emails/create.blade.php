@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Email</h5>

    <div class="card-body">

        <form class="" action="{{ route('supervisor.emails.store') }}" method="post" >
            @csrf
            <label for="to" class="col-form-label">To<span class="text-danger">*</span></label>
            <div class="form-group">
                    <label for="studentsCheck" class="ml-3 mr-2 col-form-label" style="padding-right:0px;"> Students </label>
                    <input type="checkbox" id="studentsCheck"  onclick="addCoordinator()" checked>
                    <label for="coordinatorCheck" class="ml-3 mr-2 col-form-label" style="padding-right:0px;"> Coordinator </label>
                    <input type="checkbox" id="coordinatorCheck"  onclick="addCoordinator()">
                    <input type="hidden" value="{{$coordinator->email}}" id="coordinatorEmail" name="coordinatorEmail">

                <div class="col-md-6">
                    <input class="form-control @error('students') is-invalid @enderror mb-2" style="display:none;"  type="text" name="coordinator" id="coordinator">
                    <select  class="custom-select @error('students') is-invalid @enderror" name="students[]" id="students" type="text"  multiple required>
                        @foreach($students as $student)
                        <option value="{{\App\User::find($student->student_id)->email}}">{{\App\User::find( $student->student_id)->name}}</option>
                        @endforeach
                    </select>
                    <small id="errorMessageDestination" style="display: none" class="text-danger">Destination field is required</small>
                </div>

                @error('coordinator')
                <span class="invalid-feedback" role="alert">
                    <p>dads <strong>{{ $message }}</strong></p>

                </span>
                @enderror

                @error('students')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
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
                <textarea class="form-control" id="message" name="message" required>{{ old('message') }}</textarea>

                @error('message')
                <span class="invalid-feedback" role="alert">

                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>



            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send email</button>
            </div>
        </form>


    </div>

@endsection

