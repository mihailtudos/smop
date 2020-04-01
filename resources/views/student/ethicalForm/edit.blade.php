@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Approve {{ strtok( $form->user->name, ' ') }}'s ethical form</h5>

    <div class="card-body px-5">

        <form action="{{ route('student.form.update', $form) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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

            <div class="form-group ">
                <label for="body" class=" col-form-label text-md-right">Body<span class="text-danger">*</span></label>

                <div class="">
                    <textarea class="form-control @error('body') is-invalid @enderror"  name="body" id="body" cols="40" rows="6" required >{{ old('body', $form->body) }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            {{--
            <div class="form-group ">
                <label for="subject" class="col-form-label text-md-right">Area of interest<span class="text-danger">*</span></label>

                <div class="">
                    <select name="subject[]" id="subject" class="form-control @error('subject') is-invalid @enderror input-lg" required multiple>
                        @foreach($subjects as $subject)
                            <option @if($topic->subjects->pluck('id')->contains($subject->id)) selected @endif value="{{$subject->id}}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    <small id="emailHelp" class="form-text text-muted">You must select at least one are of interest (if your area of interest is not in the list <a href="{{ route('emails.create') }}"> contact </a> your coordinator)</small>


                    @error('subject')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

            <div class="form-group ">
                <label for="image" class=" col-form-label text-md-right">Image</label>

                <div class="">
                    <div class="input-group">
                        <div class="custom-file">
                            <input onchange="validateSizeWithFileTitle(this)" id="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" aria-describedby="inputGroupFileAddon04">
                            <label id="imageCustom" class="custom-file-label" for="inputGroupFile04">{{ explode( '/', $topic->image)[1] }}</label>
                        </div>
                    </div>


                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            --}}
            <div class="form-group row mb-0 ">
                <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a role="button" href="{{route('student.form.index')}}" class="btn btn-secondary mr-2">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    </div>

@endsection
