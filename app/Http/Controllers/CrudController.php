<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;

class CrudController extends Controller
{
    //

    public function write(){
    	$name = $_POST['addName'];
		$age = $_POST['addAge'];
		$address = $_POST['addAddress'];
		echo $name . ' ' . $age . ' ' .$address;

		DB::insert('insert into people(name, age, address) values(?,?,?)', [$name, $age, $address]);

		echo '<script>alert("Successfully Created")</script>';
		return redirect("/crud");
    }

    public function load(){
		$people = DB::select('select * from people');
		foreach($people as $pips){
			echo '<h2>'.$pips->name.'</h2>';
			echo '<h4>Age : '.$pips->age.'</h4>';
			echo '<h4>Address: '.$pips->address.'</h4>';
		}
	}

	public function update($id, $name, $age, $address){
		

		echo $name. ' ' .$age . ' ' .$address;

		DB::update('update people set name = ? where id=?', [$name,$id]);
		DB::update('update people set age = ? where id=?', [$age,$id]);
		DB::update('update people set address = ? where id=?', [$address,$id]);

		echo '<script>alert(Updated Successfully);</script>';
		return redirect("/crud");
	}	

	public function delete($id){
		DB::table('people')->where('id', '=', $id)->delete();
		echo '<script>alert("Deleted Successfully");</script>';
		return redirect('/crud');
	}

	public function search($type){
		$q = $_GET['q'];
		$people = DB::select('select * from people where '.$type.'=?', [$q]);
		echo '<table>';
		echo '<th>Name</th>';
		echo '<th>Age</th>';
		echo '<th>Address</th>';
		foreach($people as $pips){
			echo '<tr>';
			echo '<td>'.$pips->name. '</td>';
			echo '<td>'.$pips->age. '</td>';
			echo '<td>'.$pips->address . '</td>';
			echo '</tr>';
		}

		echo '</table>';
	}

	public function login(){
		$rules = array(
			'email' => 'required',
			'age' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
		    return Redirect::to('login')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::all()); // send back the input (not the password) so that we can repopulate the form
		}else{
			 $userdata = array(
        	'email'     => Input::get('name'),
        	'password'  => Input::get('age')
    		);

			 if(Auth::attempt($userdata)){
			 	echo 'SUCCESS';
			 } else{
			 	echo "WRONG";
			 }
		}
	}



}
