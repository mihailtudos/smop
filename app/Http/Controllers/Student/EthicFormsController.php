<?php

namespace App\Http\Controllers\Student;

use App\ActivityTitle;
use App\EthicForm;
use App\Http\Controllers\Controller;
use App\Notifications\EthicalFormApproved;
use App\Notifications\EthicalFormNotApproved;
use App\Notifications\EthicalFormSubmited;
use App\Policies\EthicFormPolicy;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EthicFormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $form = auth()->user()->ethicalForm()->first();
        return view('student.ethicalForm.index', compact('form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('student') and auth()->user()->ethicalForm()->count() == 0){
            if (auth()->user()->projects()->count() == 0){
                return redirect()->back()->with('error', 'Please, contact your coordinator as you have no projects yet!');
            } else{
                return view('student.ethicalForm.create');
            }
        }

        return redirect()->back()->with('error', 'You have already submitted an ethical form!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        if (auth()->user()->hasRole('student') and auth()->user()->projects()->count() == 1 and auth()->user()->ethicalForm()->count() == 0) {
            $user = auth()->user();

            if ($user->hasRole('student') and $user->projects != null) {
                $data = $request->validate([
                    'student_id' => 'required|min:11|max:11',
                    'confirm'   => 'required',
                    'confirm1'   => 'required',
                    'confirm2'   => 'required',
                    'confirm3'   => 'required',
                    'confirm4'   => 'required',
                    'confirm5'   => 'required',
                    'confirm6'   => 'required',
                ]);

                $form = $user->ethicalForm()->create([
                    'title' => auth()->user()->projects->first()->title,
                    'student_id' => $data['student_id'],
                    'project_id' => auth()->user()->projects->first()->id,
                ]);

                $project = auth()->user()->projects()->first();

                $project->supervisor->notify(new EthicalFormSubmited([
                    'name' => $project->student->name,
                    'link' => $form->path(),
                ]));

                $activity = ActivityTitle::where('activity_title', 'new ethical form submitted')->first();

                if ($activity) {
                    auth()->user()->activities()->create([
                        'activity_title_id' => $activity->id
                    ]);
                }
                return redirect('home')->with('success', 'Ethical form successfully Submitted!');
            }
        }

        return redirect('home')->with('error', 'Not allowed to create ethical forms!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EthicForm  $form
     * @return Response
     */
    public function show(EthicForm $form)
    {
        $user = auth()->user();

    if ( $user->id == $form->user_id and $user->hasRole('student') ){
        return view('student.ethicalForm.exportform', compact('form'));
    } else if ($user->hasAnyRoles(['supervisor','admin'])){
        return view('student.ethicalForm.exportform', compact('form'));
    }
        return redirect()->back()->with('error','Unauthorised action!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EthicForm  $form
     * @return Response
     */
    public function edit(EthicForm $form)
    {
        if (auth()->user()->hasRole('admin') or auth()->user()->id == $form->user_id){

            if ($form->approved){
                return redirect()->route('home')->with('error', 'You are not allowed to change the form anymore as it was already approved!');
            } else {
                return view('student.ethicalForm.edit', compact('form'));
            }

            return redirect()->route('home')->with('error', 'You are not allowed edit this form!');
        }
        return redirect()->route('home')->with('error', 'You are not allowed edit this form!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param EthicForm $form
     * @return void
     */
    public function update(Request $request, EthicForm $form)
    {
        if (!$form->approved){
            if (auth()->user()->hasRole('admin') or auth()->user()->id == $form->user_id){
                $data = $request->validate([
                   'body' => 'required|min:150'
                ]);

                $form->update($data);

                return redirect()->route('student.form.index')->with('success', 'Ethical form was updated!');
            }
        }
        return abort(403,'Unauthorised ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EthicForm  $ethicForm
     * @return Response
     */
    public function destroy(EthicForm $form)
    {
        if(auth()->user()->id == $form->user_id){

            if ($form->approved){
                return redirect()->back()->with('error', 'The ethical form cannot be deleted as it was already approved!');
            } else{
                $form->delete();
                return redirect()->back()->with('success', 'The ethical form was deleted!');
            }
        }

        return redirect()->back()->with('error', 'Unauthorised access!');
    }

    public function approve(Request $request, EthicForm $form)
    {
        if(Gate::denies('admin-supervise')){
            return redirect()->back()->with('error', 'You are not allowed to approve this form');
        }
        $request->session()->flash('modal', 'active');

        $data = $request->validate([
            'needs_to_be_referred'      =>  'required',
            'reason_to_be_referred'     =>  'required_if:needs_to_be_referred,true',
            'approved'                  =>  'required',
            'reason_to_reject'          =>  'required_if:approve,false',
        ]);

        if ($request->approve == true){

            $form->update($data);

            $activity = ActivityTitle::where('activity_title','ethical form approved')->first();

            if ($activity != null){
                $form->user->activities()->create([
                    'activity_title_id' => $activity->id
                ]);
            }

            $student = $form->user;

            $student->notify(new EthicalFormApproved());

            return redirect()->to($form->project->path())->with('success', 'Student ethical form approved!');

        } else {

            $form->update([
                'approved'              => $data['approved'],
                'needs_to_be_referred'  => $data['needs_to_be_referred'],
                'reason_to_be_referred' => $data['reason_to_be_referred'],
                'reason_to_reject'      => $data['reason_to_reject'],
            ]);

            $activity = ActivityTitle::where('activity_title','ethical form not approved')->first();

            if ($activity != null){
                $form->user->activities()->create([
                    'activity_title_id' => $activity->id
                ]);
            }

            $student = $form->user;

            $student->notify(new EthicalFormNotApproved());

            return redirect()->to($form->project->path())->with('success', 'Student ethical form updated!');
        }

    }

    public function export()
    {
        if (auth()->user()->ethicalForm != null){

            $form = auth()->user()->ethicalForm;

            $pdf = PDF::loadView('student.ethicalForm.formForExport', ['form' => $form]);
            return $pdf->download(strtolower(auth()->user()->name).'_ethical_form.pdf');
        }
        return redirect()->back()->with('error', 'You have not submitted any form yet.');
    }

    public function check(Request $request, EthicForm $form)
    {
        if(Gate::denies('student')){
            return redirect()->back()->with('error', 'You are not allowed to approve this form');
        }

        $data = $request->validate([
           'truthfulness'           => 'sometimes',
           'supervisor_completed'   => 'sometimes',
           'copy_of_instruments'    => 'sometimes',
           'copy_of_proposal'       => 'sometimes'
        ]);

        $form->update($data);

        return redirect()->route('student.form.index')->with('success', 'Check list updated, now you can export your ethical form.');
    }
}
