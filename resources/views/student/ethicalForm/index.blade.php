@extends('partials.index')

@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Ethical form</h4>
        <div>
            <a class="btn btn-success border-dark" href="{{ route('student.form.create') }}" role="button">Create</a>
        </div>
    </div>
    <div class="card-body">
        @if($form != null)
            <table class="table text-center">
                <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">Subject </th>
                    <th scope="col">Approved</th>
                    <th scope="col">Submited on</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> {{ $form->title  }}</td>
                    @if($form->aproved)
                        <td> {{ 'Aproved'  }}</td>
                    @else
                        <td> {{ 'Pending'  }}</td>
                    @endif
                    <td> {{ $form->created_at->format('d-m-yy')  }}</td>
                    <td class="d-flex justify-content-center">
                        <a class="mr-2" href="{{ route( 'student.form.edit', $form->id ) }}">
                            <button class="btn btn-primary float-left" type="button">
                                <h4 class="m-0">
                                    <i class="fas fa-pen-nib"></i>
                                </h4>
                            </button>
                        </a>
                        <form action="{{ route('student.form.destroy', $form->id) }}" method="post" class="float-left">
                            @csrf
                            @method('delete')

                            <a href="{{ route( 'student.form.destroy', $form->id ) }}">
                                <button class="btn btn-danger" type="submit">
                                    <h4 class="m-0">
                                        <i class="fas fa-eraser"></i>
                                    </h4>
                                </button>
                            </a>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        @else
            <p>No form found</p>
        @endif
    </div>
@endsection
