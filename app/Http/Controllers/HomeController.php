<?php

namespace App\Http\Controllers;

use App\Enums\ReligionEnum;
use App\Enums\TaxonomyTypeEnum;
use App\Mail\ContactFormMail;
use App\Models\Application;
use App\Models\Content;
use App\Models\Employee;
use App\Models\Gallery;
use App\Models\MeritList;
use App\Models\NewsEvents;
use App\Models\Project;
use App\Models\Taxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function addStudentInfo()
    {
        $diplomaList = Taxonomy::whereType(TaxonomyTypeEnum::DIPLOMA)->get();
        $genderList = Taxonomy::whereType(TaxonomyTypeEnum::GENDER)->get();
        $provinceList = Taxonomy::whereType(TaxonomyTypeEnum::PROVINCE)->get();
        $bloodGroupList = Taxonomy::whereType(TaxonomyTypeEnum::BLOODGROUP)->get();
        $districtList = Taxonomy::whereType(TaxonomyTypeEnum::DISTRICT)->get();
        $religionList = ReligionEnum::cases();
        $sessionList = Taxonomy::whereType(TaxonomyTypeEnum::SESSION)->orderByDesc('id')->get();
        $sectionList = Taxonomy::whereType(TaxonomyTypeEnum::SECTION)->get();

        return view('add-student-info', compact(
            'diplomaList',
            'genderList',
            'provinceList',
            'bloodGroupList',
            'districtList',
            'religionList',
            'sessionList',
            'sectionList'));
    }

    public function saveStudentInfo(Request $request)
    {

        $request->validate([
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'email' => 'email|unique:users',
            'username' => 'required|max:8|unique:users',
            'phone' => 'required|numeric|digits:11|unique:users',
            'cnic' => 'required|numeric|digits:13|unique:users',
            'address' => 'required',
            'father_name' => 'required',
            'father_contact' => 'required',
            'gender_id' => 'required',
            'district_id' => 'required',
            'province_id' => 'required',
            'blood_group_id' => 'required',
            'religion' => 'required',
            'emergency_contact' => 'required',
            'password' => 'required|min:5',
            'image' => 'required',
            'class_no' => 'required',
            'dob' => 'required',
            'reg_no' => 'required|unique:students',
            'diploma_id' => 'required',
            'section_id' => 'required',
            'session_id' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $user = User::create([
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'cnic' => $request->cnic,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role_id' => User::ROLE_STUDENT
            ]);
            $studentData = [
                'gender_id' => $request->gender_id,
                'father_name' => $request->father_name,
                'father_contact' => $request->father_contact,
                'dob' => $request->dob,
                'blood_group_id' => $request->blood_group_id,
                'address' => $request->address,
                'postal_address' => $request->postal_address,
                'district_id' => $request->district_id,
                'province_id' => $request->province_id,
                'emergency_contact' => $request->emergency_contact,
                'religion' => $request->religion,
                'reg_no' => $request->reg_no,
                'class_no' => $request->class_no,
                'diploma_id' => $request->diploma_id,
                'session_id' => $request->session_id,
                'section_id' => $request->section_id,
                'admission_date' => Carbon::make('2023-10-01'),
                'status' => 'Active',
                'profile_status' => 1,
            ];
            $user->student()->updateOrCreate([], $studentData);
            if ($request->image) {
                $user->clearMediaCollection('avatars');
                $user->addMedia($request->image)->toMediaCollection('avatars');
            }
            DB::commit();
            Session::put('user-host', gethostname());
            session()->flash('success', 'UserInfo added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }

        return redirect(route('add-student-info'));

    }


    public function redirects()
    {
        $redirect = route('dashboard');
        if (session()->has('url.intended')) {
            $redirect = session()->get('url.intended');
            session()->forget('url.intended');
        }
        if (auth()->user()->role->id === User::ROLE_STUDENT) {
            $redirect = route('student-dashboard');
        }

        return redirect($redirect);
    }

    public function staff()
    {
        $staff = Employee::where('status', 1)->paginate(9);

        return view('staff', compact('staff'));
    }

    public function frontGallery()
    {
        $images = Gallery::where('status', 'Show')->paginate(12);

        return view('frontGallery', compact('images'));
    }

    public function courseContent(Content $content)
    {
        return view('course-content', compact('content'));
    }

    public function attendance()
    {
        $sections = Taxonomy::whereType(TaxonomyTypeEnum::SECTION)->get();

        return view('attendance', compact('sections'));
    }

    public function dashboard()
    {
        if (auth()->user()->role_name === 'Student') {
            return redirect(route('student-dashboard'));
        }
        $students = User::where('role_id', User::ROLE_STUDENT)->whereHas('student', function ($q) {
            $q->where('status', 'Active');
        })->count();
        $users = User::where('role_id', User::ROLE_STUDENT)->whereHas('student', function ($q) {
            $q->where('status', 'Pending');
        })->count();
        $applications = Application::whereHas('project', function ($q) {
            $q->where('expiry_date', '>', now());
        })->count();
        $projects = Project::where('expiry_date', '>', now())->count();

        return view('dashboard', compact('students', 'applications', 'users', 'projects'));
    }

    public function studentDashboard()
    {
        return view('student-dashboard');
    }

    public function MeritList(Request $request)
    {
        $project = Project::findOrFail($request->project);
        $meritData = MeritList::with('user', 'project', 'district', 'quota')
            ->where('project_id', $project->id
            )->get();
        $districtList = Taxonomy::whereType(TaxonomyTypeEnum::DISTRICT)
            ->get();
        $quotaList = Taxonomy::whereType(TaxonomyTypeEnum::QUOTA)->where('id', '!=', '33')
            ->get();

        return view('merit-list-show', compact('meritData', 'districtList', 'quotaList', 'project'));

    }

    public function showEvent(NewsEvents $event)
    {
        return view('showEvent', compact('event'));
    }

    public function submitForm(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:30',
            'email' => 'required|email',
            'subject' => 'required|min:3|max:50',
            'message' => 'required',
        ]);
        Mail::to('admission@asap.edu.pk')->send(new ContactFormMail(
            $request->message,
            $request->email,
            $request->subject,
            $request->name));

        // Process the form data and send emails, save to database, etc.
        return response()->json(['message' => 'Message Send successfully. We will inform you through your email.']);
    }

    public function studentCard(Request $request)
    {

        $students = User::with('student')->whereHas('student', function ($q) {
            $q->whereNotNull('diploma_id')->where('status', 'Active')->where('card_status', 0);
        });
        if ($request->id) {
            $students->where('id', $request->id);
        }
        $students = $students->get();

        return view('student-card', compact('students'));
    }

    public function employeeCard(Request $request)
    {
        $employees = Employee::query();
        if ($request->id) {
            $employees->where('id', $request->id);
        }
        $employees = $employees->get();

        return view('employee-card', compact('employees'));
    }

    public function printForm(Application $application)
    {
        $user = auth()->user();
        if ($user->role_id !== User::ROLE_STUDENT) {
            $user = User::find($application->user_id);
        }
        if ($application->user_id !== $user->id) {
            return redirect()->back();
        }

        return view('print-form', compact('user', 'application'));
    }

    public function printChallan(Application $application)
    {
        $user = User::find($application->user_id);

        return view('print-challan', compact('user', 'application'));
    }

}
