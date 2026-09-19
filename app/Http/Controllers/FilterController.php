<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Session;
use App\Models\Program;
use App\Models\Subject;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use App\Models\DepartmentCondition;
use App\Models\ProgramCondition;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filterBatch(Request $request)
    {
        $data = $request->all();

        $rows = Program::where('status', 1);
        $rows->with('batches')->whereHas('batches', function ($query) use ($data) {
            $query->where('batch_id', $data['batch']);
        });
        $programs = $rows->orderBy('title', 'asc')->get();

        return response()->json($programs);
    }

    public function filterProgram(Request $request)
    {
        //
        $data = $request->all();

        $programs = Program::where('faculty_id', $data['faculty'])->where('status', 1)->orderBy('title', 'asc')->get();

        return response()->json($programs);
    }

    public function filterSession(Request $request)
    {

        $data = $request->all();

        $rows = Session::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data) {
            $query->where('program_id', $data['program']);
        });
        $sessions = $rows->orderBy('id', 'desc')->get();

        return response()->json($sessions);
    }


    public function filterCollegeDepartment(Request $request)
    {

        // dd($request->all());
        $data = $request->all();
        // dd($data['department']); 

        $rows = Program::where('department_id', $data['department'])->where('status', 1);

        $programs = $rows->orderBy('id', 'desc')->get();
        // dd($programs);

        return response()->json($programs);
    }


    public function filterDepartmentFaculty(Request $request)
    {
        $data = $request->all();

        // dd($data['department']);
        $rows = Faculty::where('department_id', $data['department'])->where('status', 1);
        $faculties = $rows->orderBy('id', 'desc')->get();

        // dd($faculties);

        return response()->json($faculties);
    }
    public function filterSemester(Request $request)
    {
        $programId = $request->program;

        // Nursing department condition
        $departmentCondition = DepartmentCondition::where('status', '1')->first();
        $programCondition = ProgramCondition::where('status', '1')->first();

        // ANM, GNM, BA  ki IDs
    
        $nursingProgramIds = Program::whereIn('department_id', [
            $departmentCondition->nursing_id,
            $departmentCondition->degree_id
        ])
            ->whereIn('id', [
                $programCondition->anm_id,
                $programCondition->ba_id,
                $programCondition->gnm_id
            ])
            ->pluck('id')
            ->toArray();

        // Nursing program check
        $isNursing = in_array($programId, $nursingProgramIds);

        $query = Semester::where('status', 1)
            ->whereHas('programs', function ($q) use ($programId) {
                $q->where('program_id', $programId);
            });

        // 🔥 IMPORTANT FILTER (blank rokne ke liye)
        if ($isNursing) {
            $query->whereNotNull('year')->where('year', '!=', '');
        } else {
            $query->whereNotNull('title')->where('title', '!=', '');
        }

        $semesters = $query->orderBy('id', 'asc')
            ->get()
            ->map(function ($item) use ($isNursing) {
                return [
                    'id'   => $item->id,
                    'text' => $isNursing ? $item->year : $item->title,
                    'type' => $isNursing ? 'year' : 'semester'
                ];
            });

        // dd($semesters);    

        return response()->json($semesters);
    }



    public function filterSection(Request $request)
    {
        //
        $data = $request->all();

        $rows = Section::where('status', 1);
        $rows->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($data) {
            $query->where('program_id', $data['program']);
            $query->where('semester_id', $data['semester']);
        });
        $sections = $rows->orderBy('title', 'asc')->get();

        return response()->json($sections);
    }

    public function filterSubject(Request $request)
    {
        //
        $data = $request->all();

        $rows = Subject::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data) {
            $query->where('program_id', $data['program']);
        });
        $subjects = $rows->orderBy('code', 'asc')->get();

        return response()->json($subjects);
    }

    public function filterEnrollSubject(Request $request)
    {
        //
        $data = $request->all();

        $rows = Subject::where('status', 1);
        $rows->with('subjectEnrolls')->whereHas('subjectEnrolls', function ($query) use ($data) {
            $query->where('program_id', $data['program']);
            $query->where('semester_id', $data['semester']);
            $query->where('section_id', $data['section']);
        });
        $subjects = $rows->orderBy('code', 'asc')->get();

        return response()->json($subjects);
    }

    public function filterStudentSubject(Request $request)
    {
        //
        $data = $request->all();

        $subjects = DB::table('subjects')->select('subjects.*')->join('student_enroll_subject', 'student_enroll_subject.subject_id', 'subjects.id')->join('student_enrolls', 'student_enrolls.id', 'student_enroll_subject.student_enroll_id')->where('student_enrolls.program_id', $data['program'])->where('student_enrolls.session_id', $data['session'])->where('student_enrolls.semester_id', $data['semester'])->where('student_enrolls.section_id', $data['section'])->where('student_enrolls.status', '1')->where('subjects.status', '1')->orderBy('subjects.code', 'asc')->get();

        return response()->json($subjects);
    }

    public function filterTecherSubject(Request $request)
    {
        //
        $data = $request->all();

        // Access Data
        $session = $data['session'];

        $teacher_id = Auth::guard('web')->user()->id;
        $user = User::where('id', $teacher_id)->where('status', '1');
        $user->with('roles')->whereHas('roles', function ($query) {
            $query->where('slug', 'super-admin');
        });
        $superAdmin = $user->first();


        // Filter Subject
        $rows = Subject::where('status', '1');
        $rows->with('classes')->whereHas('classes', function ($query) use ($teacher_id, $session, $superAdmin) {
            if (isset($session)) {
                $query->where('session_id', $session);
            }
            if (!isset($superAdmin)) {
                $query->where('teacher_id', $teacher_id);
            }
        });
        if (isset($data['program'])) {
            $rows->with('programs')->whereHas('programs', function ($query) use ($data) {
                $query->where('program_id', $data['program']);
            });
        }

        $subjects = $rows->orderBy('code', 'asc')->get();

        return response()->json($subjects);
    }
}
