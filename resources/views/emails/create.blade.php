@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Email</h5>

    <div class="card-body">

        <form class="" action="{{ route('emails.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="to" class="col-form-label">To<span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select class="custom-select @error('to') is-invalid @enderror" name="to[]" id="to" type="text" required autofocus multiple>
                        @foreach($coordinators as $coordinator)
                            <option value="{{$coordinator->email}}">{{$coordinator->name}}</option>
                        @endforeach
                        @if(isset($supervisor))
                                <option value="{{$supervisor->email}}">{{$supervisor->name}}</option>
                        @endif
                    </select>
                    <small id="emailHelp" class="form-text text-muted">If supervisor is not in the list <a role="button" href="#" class="list-inline" onclick="$('#to').val($('#to option:first').val());"> contact </a> your coordinator to assign you one.</small>
                </div>

                @error('to')
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
                <a role="button" class="btn btn-secondary text-white" onclick="window.history.go(-1); return false;">Close</a>
                <button type="submit" class="btn btn-primary">Send email</button>
            </div>
        </form>


    </div>

@endsection

