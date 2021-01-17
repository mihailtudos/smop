<div class="modal fade" id="suggestionsModal" tabindex="-1" role="dialog" aria-labelledby="suggestionsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suggestionsModalTitle">Suggestions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <ul class="d-flex justify-content-center nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link styledNavLink active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Subject</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link styledNavLink" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Course</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div>
                            <ol class="">
                                @foreach(\App\Subject::all() as $subject)
                                    <li><a href="{{$subject->pathToSuggestions()}}">{{ $subject->name }} </a><span class="badge badge-success badge-pill">{{ $subject->suggestions()->count() }}</span></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div>
                            <ol class="">
                                @foreach(\App\Field::all() as $field)
                                    <li><a href="{{$field->pathToSuggestions()}}">{{ $field->name }} </a><span class="badge badge-success badge-pill">{{ $field->suggestions()->count() }}</span></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
