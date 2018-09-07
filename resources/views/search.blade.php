@extends('layout', ['title' => 'Customers'])

@section('content')

<h1>Customers <small class="text-muted font-weight-light">( <?php sizeof($customers);?> found)</small></h1>
Sort by: 
<form method='get' action='/customers' style='display:inline-block;'>
     <input type='submit' value='Name'>
</form>
<form method='post' action='/customers' style='display:inline-block;'>
    @csrf
    <input type='hidden' name='sortby' value='birth_date'>
     <input type='submit' value='Birth date'>
</form>
<form method='post' action='/customers' style='display:inline-block;'>
    @csrf
    <input type='hidden' name='sortby' value='last_interaction'>
     <input type='submit' value='Last interaction'>
</form>
<form method='post' action='/customers' style='display:inline-block;'>
    @csrf
    <input type='hidden' name='sortby' value='company_name'>
     <input type='submit' value='Company name'>
</form>
<form method='post' action='/customers' style='display:inline-block;'>
    @csrf
    <input type='hidden' name='sortby' value='joining_date'>
     <input type='submit' value='Joining date'>
</form>
<br><br>
Search by: 
<form method='post' action='/customers' style='display:inline-block;'>
    @csrf
    <input type='hidden' name='searchby' value='yes'>
    <input type='text' name='name' placeholder='FirstName LastName'>
    <input type='text' name='birth_date' placeholder='Birth date'>
    <input type='text' name='joining_date' placeholder='Joining date'>
     <input type='submit' value='Search'>
</form>
<table class="table my-4">
    <tr>
        <th>Name</th>
        <th>Birthday</th>
        <th>Joining date </th>
    </tr>
    @foreach ($customers as $customer)
        <tr>
            <td><a href="{{ route('customers.edit', $customer) }}">{{ $customer->last_name }}, {{ $customer->first_name }}</a></td>
            <td>{{ $customer->birth_date->format('F j') }}</td>
            <td>{{ $customer->created_at}}</td>
        </tr>
    @endforeach
</table>

{{ $customers->appends(request()->all())->links() }}

@endsection
