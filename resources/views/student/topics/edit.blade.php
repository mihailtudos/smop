@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Project Suggestion</h5>

    <div class="card-body px-5">

        <form action="{{ route('student.topics.update', $topic) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group ">
                <label for="title" class=" col-form-label text-md-right">Title<span class="text-danger">*</span></label>
                <div class="">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $topic->title) }}" required autofocus>

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
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="6" required >{{ old('description', $topic->description) }}</textarea>

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
                    <textarea id="methodology"  class="form-control @error('methodology') is-invalid @enderror" name="methodology" rows="6" required >{{ old('methodology', $topic->methodology) }}</textarea>

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
                    <textarea id="deliverables" class="form-control @error('deliverables') is-invalid @enderror" name="deliverables" rows="6" required >{{ old('deliverables', $topic->deliverables) }}</textarea>

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
                    <textarea class="form-control @error('body') is-invalid @enderror"  name="body" id="body" cols="40" rows="6" required >{{ old('body', $topic->body) }}</textarea>

                    @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group ">
                <label for="body" class="col-form-label text-md-right">Field<span class="text-danger">*</span></label>

                <div class="">

                    <select name="subject[]" id="subject" class="form-control @error('subject') is-invalid @enderror input-lg" required multiple>
                        @forelse($subjects as $subject)
                            <option @if($topic->subjects->pluck('id')->contains($subject->id)) selected @endif value="{{$subject->id}}">{{ $subject->name }}</option>
                        @empty
                            <option value="">Other</option>
                        @endforelse
                    </select>

                    @error('subject')
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

            <div class="form-group row mb-0 ">
                <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </form>

    </div>

@endsection
