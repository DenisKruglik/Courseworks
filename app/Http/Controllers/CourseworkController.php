<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Professor;
use App\Coursework;
use App\Subject;
use App\Topic;
use App\Application;

class CourseworkController extends Controller
{
    public function getForProfessor(Request $r){
    	$user = $r->user();
    	$professor = $user->professor()->get()[0];
    	$courseworks = $professor->courseworks()->with('topic', 'subjects')->orderBy('created_at', 'desc')->paginate(5);
    	return view('courseworks', ['courseworks' => $courseworks]);
    }

    public function create(Request $r){
    	$coursework = new Coursework([
    		'title' => $r->title,
    		'description' => $r->description
    	]);
    	$topicId = NULL;
    	if ($r->topic === 'custom') {
    		$topic = Topic::firstOrCreate([
    			'name' => $r->topic_name
    		]);
    		$topicId = $topic->id;
    	}else{
    		$topicId = $r->topic;
    	}
    	$coursework->topic_id = $topicId;
    	$professor = $r->user()->professor()->get()[0];
    	$professor->courseworks()->save($coursework);
    	$s = [];
    	foreach ($r->subjects as $subject) {
    		$s[] = Subject::find($subject['id']);
    	}
    	$coursework->subjects()->saveMany($s);
    	return response()->json([
    		'status' => 'OK',
    		'data' => 'Курсовая создана успешно'
    	]);
    }

    public function searchSubjects(Request $r, $name){
    	$subjects = Subject::where('title', 'like', '%'.$name.'%')->limit(10)->get();
    	return response()->json($subjects);
    }

    public function activate(Request $r, Coursework $coursework){
    	$coursework->is_actual = 1;
    	$coursework->save();
    	return redirect('courseworks');
    }

    public function deactivate(Request $r, Coursework $coursework){
    	$coursework->is_actual = 0;
    	$coursework->save();
    	return redirect('courseworks');
    }

    public function getCurrent(Request $r){
    	$user = $r->user();
    	$student = $user->student()->get()[0];
    	$coursework = $student->courseworks()->whereNull('mark')->where('is_approved', '=', 1)->first();
    	return view('current-coursework', [
    		'coursework' => $coursework
    	]);
    }

    public function apply(Request $r, Coursework $coursework){
    	$user = $r->user();
    	$student = $user->student()->get()[0];
    	$approved = $student->courseworks()->where('is_approved', '=', 1)->whereNull('mark')->count();
    	if ($approved > 0) {
    		return back()->with('error', 'У Вас уже есть курсовая на этот семестр');
    	}
    	$count = $student->courseworks()->where('courseworks.id', '=', $coursework->id)->count();
    	if ($count == 0) {
	    	$student->courseworks()->save($coursework);
	    	return redirect('current-applications')->with('status', 'Заявка успешно подана');
    	}else{
    		return back()->with('error', 'Вы уже подавали заявку на эту курсовую работу');
    	}
    }

    public function getCurrentApplications(Request $r){
    	$user = $r->user();
    	$student = $user->student()->get()[0];
    	$applications =  $student->courseworks()->whereNull('mark')->paginate(3);
    	return view('current-applications', [
    		'applications' => $applications
    	]);
    }

    public function getPreviousCourseworks(Request $r){
    	$user = $r->user();
    	$student = $user->student()->get()[0];
    	$courseworks = $student->courseworks()->whereNotNull('mark')->paginate(3);
    	return view('previous-courseworks', [
    		'courseworks' => $courseworks
    	]);
    }

    public function getApplications(Request $r){
    	$user = $r->user();
    	$professor = $user->professor()->get()[0];
    	$applications = $professor->applications()->where('is_approved', '=', 0)->paginate(3);
    	return view('applications', [
    		'applications' => $applications
    	]);
    }

    public function approve(Request $r, Application $application){
    	$application->is_approved = 1;
    	$application->save();
    	$student = $application->student;
    	$student->applications()->where('is_approved', '=', 0)->delete();
    	$coursework = $application->coursework;
    	$coursework->is_actual = 0;
    	$coursework->save();
    	return back()->with('status', 'Заявка успешно принята');
    }

    public function finish(Request $r, Coursework $coursework){
    	$student = $r->user()->student;
    	$a = $student->applications()->where('coursework_id', '=', $coursework->id)->first();
    	$a->is_finished = 1;
    	$a->save();
    	return back();
    }

    public function getStudentsWork(Request $r){
    	$professor = $r->user()->professor;
    	$applications = $professor->applications()->where('is_approved', '=', 1)->whereNull('mark')->paginate(3);
    	return view('students-work', [
    		'applications' => $applications
    	]);
    }
}
