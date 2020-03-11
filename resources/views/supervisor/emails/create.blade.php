@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Email</h5>

    <div class="card-body">

        <form class="" action="{{ route('supervisor.emails.store') }}" method="post">
            @csrf
            <label for="to" class="col-form-label">To<span class="text-danger">*</span></label>
            <div class="form-group">
                    <label for="studentsCheck" class="ml-3 mr-2 col-form-label" style="padding-right:0px;"> Students </label>
                    <input type="checkbox" id="studentsCheck"  onclick="myFunction()">
                    <label for="coordinatorCheck" class="ml-3 mr-2 col-form-label" style="padding-right:0px;"> Coordinator </label>
                    <input type="checkbox" id="coordinatorCheck"  onclick="ccCoordinator()">

                <div class="col-md-6">
                    <input class="form-control mb-2" style="display:none;"  type="text" name="coordinatorTo" id="coordinatorTo" value="{{$coordinator->email}}">
                    <select style="display: none"  class="custom-select @error('to') is-invalid @enderror" name="students[]" id="to" type="text"  multiple autofocus>
                        @foreach($students as $student)
                        <option value="{{\App\User::find($student->student_id)->email}}">{{\App\User::find( $student->student_id)->name}}</option>
                        @endforeach
                    </select>
                </div>

                @error('to')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <label for="cc" class="col-form-label">CC<span class="text-danger">*</span></label>
            <div class="form-group">


                <div id="coordinatorDiv" class="col-md-6">
                        <input class=" form-control" style="display:none;"  type="text" name="coordinatorCc" id="coordinatorCc" value="{{$coordinator->email}}">
                </div>

                @error('cc')
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send email</button>
            </div>
        </form>


    </div>

@endsection

