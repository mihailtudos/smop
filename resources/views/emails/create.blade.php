@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Email</h5>

    <div class="card-body">

        <form class="" action="{{ route('emails.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">To<span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select class="custom-select @error('to') is-invalid @enderror" name="to[]" id="to" type="text"
                            required autofocus multiple>
                        <option value="{{auth()->user()->projects->supervisor->email}}">Supervisor</option>
                        <option
                            value="{{App\User::with(['roles'=>function($q){$q->where('name', 'admin');}])->first()->email}}">
                            Coordinator
                        </option>
                    </select>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send email</button>
            </div>
        </form>


    </div>

@endsection

