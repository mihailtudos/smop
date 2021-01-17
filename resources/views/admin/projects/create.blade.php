@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Create project</h4>
                </div>
                <div class="card-body">
                {{--Form START--}}
                    <form action="{{ route('admin.projects.store') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Student E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror @error('student_id') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email">
                                <input type="hidden" name="student_id" id="student_id" value="null" >

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @error('student_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'Student has been already allocated' }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Project Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  required  autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="studyField" class="col-md-4 col-form-label text-md-right">Study Field</label>

                            <div class="col-md-6">
                                <select name="studyField" id="studyField" class="form-control @error('studyField') is-invalid @enderror input-lg dynamic" data-dependent="supervisor">

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

                        <div class="form-group row">
                            <label for="supervisor" class="col-md-4 col-form-label text-md-right">Supervisor</label>

                            <div class="col-md-6">
                                <select name="supervisor" id="supervisor" class="form-control @error('supervisor') is-invalid @enderror input-lg dynamic" >
                                    <option value="">Select supervisor</option>
                                </select>

                                @error('supervisor')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 d-flex flex-row-reverse ">

                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>

                                <button type="button" onclick="window.history.back();" class="btn btn-secondary mr-2">
                                    Cancel
                                </button>

                            </div>
                        </div>
                    </form>
                    {{--Form END--}}
                </div>

            </div>
        </div>
    </div>
@endsection



