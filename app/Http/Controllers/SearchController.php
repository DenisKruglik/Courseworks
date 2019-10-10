<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\Subject;
use App\Topic;
use App\Coursework;

class SearchController extends Controller
{
    public function search(Request $r){
    	$professors = Professor::join('users', 'professors.user_id', '=', 'users.id')->where('users.first_name', 'like', '%'.$r->search_query.'%')->orWhere('users.last_name', 'like', '%'.$r->search_query.'%')->orWhere('users.middle_name', 'like', '%'.$r->search_query.'%')->limit(3)->get(['professors.id', 'chair_id', 'user_id']);
    	$subjects = Subject::where('title', 'like', '%'.$r->search_query.'%')->limit(10)->get();
    	$topics = Topic::where('name', 'like', '%'.$r->search_query.'%')->limit(5)->get();
    	$courseworks = Coursework::where('title', 'like', '%'.$r->search_query.'%')->where('is_actual', '=', 1)->orWhere('description', 'like', '%'.$r->search_query.'%')->where('is_actual', '=', 1)->limit(3)->get();
    	$pCount = Professor::join('users', 'professors.user_id', '=', 'users.id')->where('users.first_name', 'like', '%'.$r->search_query.'%')->orWhere('users.last_name', 'like', '%'.$r->search_query.'%')->orWhere('users.middle_name', 'like', '%'.$r->search_query.'%')->count();
    	$sCount = Subject::where('title', 'like', '%'.$r->search_query.'%')->count();
    	$tCount = Topic::where('name', 'like', '%'.$r->search_query.'%')->count();
    	$cCount = Coursework::where('title', 'like', '%'.$r->search_query.'%')->where('is_actual', '=', 1)->orWhere('description', 'like', '%'.$r->search_query.'%')->where('is_actual', '=', 1)->count();
    	return view('search', [
    		'professors' => $professors,
    		'subjects' => $subjects,
    		'topics' => $topics,
    		'courseworks' => $courseworks,
    		'pCount' => $pCount,
    		'sCount' => $sCount,
    		'tCount' => $tCount,
    		'cCount' => $cCount
    	]);
    }

    public function searchBySubject(Request $r, Subject $subject){
    	$courseworks = $subject->courseworks()->where('is_actual', '=', 1)->paginate(5);
    	return view('search-subject', [
    		'courseworks' => $courseworks
    	]);
    }

    public function searchByTopic(Request $r, Topic $topic){
    	$courseworks = $topic->courseworks()->where('is_actual', '=', 1)->paginate(5);
    	return view('search-topic', [
    		'courseworks' => $courseworks
    	]);
    }

    public function professorInfo(Request $r, Professor $professor){
    	$courseworks = $professor->courseworks()->where('is_actual', '=', 1)->paginate(5);
    	return view('professor', [
    		'courseworks' => $courseworks,
    		'professor' => $professor
    	]);
    }

    public function querySubject(Request $r, $query){
    	$subjects = Subject::where('title', 'like', '%'.$query.'%')->paginate(20);
    	return view('subject-search-result', [
    		'subjects' => $subjects
    	]);
    }

    public function queryTopic(Request $r, $query){
    	$topics = Topic::where('name', 'like', '%'.$query.'%')->paginate(20);
    	return view('topic-search-result', [
    		'topics' => $topics
    	]);
    }

    public function queryProfessor(Request $r, $query){
    	$professors = Professor::join('users', 'professors.user_id', '=', 'users.id')->where('users.first_name', 'like', '%'.$query.'%')->orWhere('users.last_name', 'like', '%'.$query.'%')->orWhere('users.middle_name', 'like', '%'.$query.'%')->paginate(10, ['professors.id', 'chair_id', 'user_id']);
    	return view('professor-search-result', [
    		'professors' => $professors
    	]);
    }

    public function queryCoursework(Request $r, $query){
    	$courseworks = Coursework::where('title', 'like', '%'.$query.'%')->where('is_actual', '=', 1)->orWhere('description', 'like', '%'.$query.'%')->where('is_actual', '=', 1)->paginate(5);
    	return view('coursework-search-result', [
    		'courseworks' => $courseworks
    	]);
    }
}
