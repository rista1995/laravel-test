@extends('layout', ['title' => 'Add new customer'])

@section('content')
<h3>To add new customer fill the form: </h3><br>
<form method="post" action="/add">
	{{csrf_field()}}
	<input type="text" name="company_id" placeholder="company_id"><br>
	<input type="text" name="sales_rep_id" placeholder="sales_rep_id"><br>
	<input type="text" name="first_name" placeholder="first_name"><br>
	<input type="text" name="last_name" placeholder="last_name"><br>
	<input type="date" name="birth_date" placeholder="birth_date"><br>
	
	<input type="submit" value="Add">
</form>
@endsection