@extends('partials.index')

@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Ethical form</h4>
        <div>
            @if(auth()->user()->ethicalForm()->count() == 0)
                <a class="btn btn-primary border-dark" href="{{ route('student.form.create') }}" role="button">Create</a>
            @else
                <a class="btn btn-secondary border-dark" href="{{ route('student.form.export') }}" role="button">Export</a>
            @endif
        </div>
    </div>
    <div class="card-body">
        @if($form != null)
            <table class="table text-center">
                <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">Subject </th>
                    <th scope="col">Approved</th>
                    <th scope="col">Submitted</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><a href="{{ $form->path() }}">{{ $form->title }}</a></td>
                    @if($form->approved)
                        <td> {{ 'Approved'  }}</td>
                    @else
                        <td> {{ 'Pending'  }}</td>
                    @endif
                    <td> {{ $form->created_at->format('d-m-yy')  }}</td>
                    @if(!$form->approved)
                    <td class="d-flex justify-content-center">
                        <form action="{{ route('student.form.destroy', $form->id) }}" method="post" class="float-left">
                            @csrf
                            @method('delete')

                            <a href="{{ route( 'student.form.destroy', $form->id ) }}">
                                <button class="btn btn-danger mt-n2" type="submit">
                                    <h4 class="m-0">
                                        <i class="fas fa-eraser"></i>
                                    </h4>
                                </button>
                            </a>
                        </form>
                    </td>
                    @endif
                </tr>
                </tbody>
            </table>
        @else
            <p>No form found</p>
        @endif
    </div>
@endsection
