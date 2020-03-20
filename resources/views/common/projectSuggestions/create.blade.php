@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Project Suggestion</h5>

    <div class="card-body px-5">

        <form action="{{ route('suggestions.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group ">
                <label for="title" class=" col-form-label text-md-right">Title<span class="text-danger">*</span></label>
                <div class="">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Indicative title" required autofocus>
                    <small id="emailHelp" class="form-text text-muted">Must be longer than 25 characters</small>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="description" class=" col-form-label text-md-right">Description<span class="text-danger">*</span></label>

                <div class="">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" rows="5" name="description"
                              placeholder="Topic description" required >{{ old('description') }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="methodology" class="col-form-label text-md-right">Methodology<span class="text-danger">*</span></label>

                <div class="">
                    <textarea id="methodology"  class="form-control @error('methodology') is-invalid @enderror" rows="5" name="methodology"
                              placeholder="The methodology of a topic section is used to support the reliability and validity of your research." required >{{ old('methodology') }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('methodology')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="deliverables" class="col-form-label text-md-right">Deliverables<span class="text-danger">*</span></label>

                <div class="">
                    <textarea id="deliverables" class="form-control @error('deliverables') is-invalid @enderror" rows="5" name="deliverables"
                              placeholder="Describe the proposed deliverables as a result of your project." required >{{ old('deliverables') }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('deliverables')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="body" class=" col-form-label text-md-right">Body<span class="text-danger">*</span></label>

                <div class="">
                    <textarea class="form-control @error('body') is-invalid @enderror"  name="body" id="body" rows="5"
                              placeholder="Any additional information realted to your topic." required >{{ old('body') }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group ">
                <label for="fields" class="col-form-label text-md-right">Course<span class="text-danger">*</span></label>

                <div class="">
                    <select name="fields[]" id="fields" class="form-control @error('fields') is-invalid @enderror input-lg" data-dependent="subjects" required multiple>
                        @foreach($fields as $field)
                            <option value="{{$field->id}}">{{ $field->name }}</option>
                        @endforeach
                    </select>
                    <small id="emailHelp" class="form-text text-muted">You must select at least one course (if your course is not in the list <a href="{{ route('admin.emails.create') }}"> contact </a> your coordinator)</small>

                    @error('fields')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="subjects" class="col-form-label text-md-right">Area of interest<span class="text-danger">*</span></label>

                <div class="">
                    <select name="subjects[]" id="subjects" class="form-control @error('subjects') is-invalid @enderror input-lg" required multiple>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    <small id="emailHelp" class="form-text text-muted">You must select at least one area of interest (if your area of interest is not in the list <a href="{{ route('admin.emails.create') }}"> contact </a> your coordinator)</small>

                    @error('subjects')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="body" class=" col-form-label text-md-right">Image</label>

                <div class="">
                    <div class="input-group">
                        <div class="custom-file">
                            <input onchange="validateSizeWithFileTitle(this)" id="image" type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" aria-describedby="inputGroupFileAddon04">
                            <label class="custom-file-label" id="imageCustom" for="inputGroupFile04">Choose file</label>
                        </div>

                    </div>


                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0 ">
                <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>


                    <a role="button" href="{{route('suggestions.index')}}" class="btn btn-secondary mr-2">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    </div>

@endsection
