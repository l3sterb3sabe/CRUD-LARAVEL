<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CrudController extends Controller
{
    //

    public function write(){
    	$name = $_POST['name'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		echo $name . ' ' . $age . ' ' .$address;

		DB::insert('insert into people(name, age, address) values(?,?,?)', [$name, $age, $address]);

		echo '<script>alert("Successfully Created")</script>';
    }

    public function load(){
		$people = DB::select('select * from people');
		foreach($people as $pips){
			echo '<h2>'.$pips->name.'</h2>';
			echo '<h4>Age : '.$pips->age.'</h4>';
			echo '<h4>Address: '.$pips->address.'</h4>';
		}
	}

	public function update($id){
		$name = $_POST['upname'];
		$age = $_POST['upage'];
		$address = $_POST['upaddress'];

		echo $name. ' ' .$age . ' ' .$address;

		DB::update('update people set name = ? where id=?', [$name,$id]);
		DB::update('update people set age = ? where id=?', [$age,$id]);
		DB::update('update people set address = ? where id=?', [$address,$id]);

		echo '<script>alert(Updated Successfully);</script>';
	}	

	public function delete($id){
		DB::table('people')->where('id', '=', $id)->delete();
		echo '<script>alert("Deleted Successfully");</script>';
	}

	public function search($type){
		$people = DB::select('select '.$type. ' from people ');
		foreach($people as $pips){
			echo $pips->$type . '<br> <br>';
		}
	}

	public function validate($input){

		$rules = array(
			'name' => 'Required|Alpha',
			'age' => 'Required|Integer',
			'address' => 'Required'
			);

		return Validator::make($input, $rules);
	}

}