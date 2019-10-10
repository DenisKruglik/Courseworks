<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Student;
use App\Professor;
use App\Subject;

class UserController extends Controller
{
    public function authenticate(Request $r){
    	if (Auth::attempt(['username' => $r->username, 'password' => $r->password])) {
    		switch (Auth::user()->role) {
    			case 'professor':
    				return redirect('courseworks');
    			case 'student':
    				return redirect('current-coursework');
    			case 'admin':
    				return redirect('admin');
    		}
    	}
    	return redirect('')->with('error', 'Неверное имя пользователя или пароль!');
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }

    public function updateById(User $user, $newPassword){
    	$user->fill([
    		'password' => Hash::make($newPassword)
    	])->save();
    }

    public function changePassword(Request $r){
    	$user = $r->user();
    	if (Hash::check($r->old_password, $user->password)) {
    		$user->password = Hash::make($r->new_password);
    		$user->save();
    		return response()->json([
    			'status' => 'OK',
    			'data' => 'Пароль изменён успешно'
    		]);
    	}else{
    		return response()->json([
    			'status' => 'ERROR',
    			'data' => 'Старый пароль неверен'
    		]);
    	}
    }

    public function registerStudent(Request $r){
    	$user = new User([
    		'username' => $r->username,
    		'password' => Hash::make($r->password),
    		'email' => $r->email,
    		'first_name' => $r->first_name,
    		'last_name' => $r->last_name,
    		'middle_name' => $r->middle_name,
    		'role' => 'student'
    	]);
    	$user->save();

    	$user->student()->create([
    		'recordbook_id' => $r->recordbook_id,
    		'course' => $r->course
    	]);

    	return response()->json([
    		'status' => 'OK',
    		'data' => 'Студент зарегистрирован успешно'
    	]);
    }

    public function registerProfessor(Request $r){
    	$user = new User([
    		'username' => $r->username,
    		'password' => Hash::make($r->password),
    		'email' => $r->email,
    		'first_name' => $r->first_name,
    		'last_name' => $r->last_name,
    		'middle_name' => $r->middle_name,
    		'role' => 'professor'
    	]);
    	$user->save();

    	$professor = new Professor;
    	$professor->chair_id = $r->chair;

    	$user->professor()->save($professor);
    	$s = [];
    	foreach ($r->subjects as $subject) {
    		$s[] = Subject::find($subject['id']);
    	}
    	$professor->subjects()->saveMany($s);

    	return response()->json([
    		'status' => 'OK',
    		'data' => 'Преподаватель зарегистрирован успешно'
    	]);
    }

    public function saveAvatar(Request $r){
    	$file = $r->file('avatar');
    	$newName = md5($file->getClientOriginalName().microtime()).'.'.$file->guessClientExtension();
    	$file->move('img', $newName);
    	$user = $r->user();
		$user->img = '/img/'.$newName;
		$user->save();
    	return response()->json([
    		'status' => 'OK',
    		'data' => '/img/'.$newName
    	]);
    }

    public function changeUsername(Request $r){
    	$user = $r->user();
    	$user->username = $r->username;
    	$user->save();
    	return response()->json([
    		'status' => 'OK',
    		'data' => 'Имя пользователя изменено успешно'
    	]);
    }
}
