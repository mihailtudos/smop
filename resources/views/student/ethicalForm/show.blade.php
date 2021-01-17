@extends('layouts.app')

@section('content')
    {{--Quick links--}}
         @include('partials.quick')
    <div class="">
        <div class="">
            <div class="card dashCard">
                <div class="card-header d-flex justify-content-center align-content-center">
                    <div class="">
                        <h3> {{$form->title}} </h3>
                    </div>
                    @if(auth()->user()->hasRole('admin') or $form->user_id == auth()->user()->id)
                        @if(!$form->approved)
                            <div class="ml-4">
                                <a role="button" href="{{ route( 'student.form.edit', $form->id ) }}">
                                    <h4 class="mt-1">
                                        <i class="fas fa-pen-nib text-warning"></i>
                                    </h4>
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
                <img class="card-img-top w-100" src="{{ '/storage/uploads/banner.jpg' }} "
                      alt="Card image cap">
                <div class="card-body">
                    <div class="text-justify jumbotron">
                       <div class="mb-5">
                           <h1 class="text-left">Description</h1>
                           <p>

                           </p>
                       </div>
                        <div class="mb-5">
                            <h1 class="text-left">Methodology</h1>
                            <p>

                            </p>
                        </div>
                        <div class="mb-5">
                            <h1 class="text-left">Deliverables</h1>
                            <p>

                            </p>
                        </div>
                        <div class="mb-5">
                            <h1 class="text-left">Body</h1>
                            <p>
                                {{$form->body}}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <p>Created {{$form->created_at->diffForHumans() .' by '. $form->user->name}}</p>
                    </div>
                    @if( !$form->approved )
                        @if(auth()->user()->id == $form->user->projects->first()->supervisor->id or auth()->user()->hasRole('admin'))
                            <div class="jumbotron">
                            <div class="d-flex justify-content-center">
                                <h3 class="mb-5 text-center">Approve student ethical form</h3>
                            </div>
                            <form action="{{ route('student.ethic.form.approve', $form) }}" method="post">
                                @csrf

                                <div class="form-group d-flex justify-content-center">
                                    <label for="approve" class=" col-form-label">Approve form<span class="text-danger">*</span></label>

                                    <div class="col-lg-6">
                                        <select name="approve" id="approve" class="custom-select" class="form-control @error('approve') is-invalid @enderror input-lg"  required>
                                            <option value="">Select option</option>
                                            <option value="1">Approve</option>
                                        </select>

                                        @error('approve')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div>
                                        <button class="btn btn-success" type="submit">Approve</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection
