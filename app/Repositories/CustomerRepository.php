<?php

namespace App\Repositories;

use App\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
/*

*/
class CustomerRepository {
	public function getCustomers(){
		return DB::table('customers')->get();
	}

	public function getCustomersByName(){
		return Customer::orderBy('last_name','asc')->orderBy('first_name','asc')->paginate();
	}

	public function addCustomer(Request $request){
		return Customer::create($request->all());
	}

	public function getCustomersByBirth(){
		return Customer::orderBy('birth_date','asc')->paginate();
	}

	public function getCustomersByInteraction(){
		return Customer::orderBy('interaction_date','asc')->paginate();
	}

	public function getCustomersByCompany(){
		return Customer::orderBy('company_name','asc')->paginate();
	}

	public function getCustomersByJoining(){
		return Customer::orderBy('created_at','asc')->paginate();
	}

	public function getCustomersBySearch(Request $request){
		$customers = Customer::where('id','>','0');
        if($request->name!=''){
            $name=explode(" ",$request->name);
            if(sizeof($name)==2){
                $customers=$customers->where('first_name','=',$name[0]);
                $customers=$customers->where('last_name','=',$name[1]);
            }
        }
        if($request->birth_date!=''){
            $customers=$customers->where('birth_date','=',$request->birth_date);
        }
        if($request->joining_date!=''){
            $customers=$customers->where('created_at','=',$request->joining_date);
        }
        return $customers->paginate();
	}

	public function getCustomersByFilter(){
		$monday=Carbon::now();
        $monday=$monday->startOfWeek();

        $sunday=$monday->addDays(6);
    
        $customers = Customer::where('id','>','0')->get();
        $n=0;
        foreach($customers as $customer){
            $this_year=Carbon::parse($customer->birth_date);
            $this_year->year(date('Y'));
            if($this_year->gte($monday) && $this_year->lte($sunday)){
                $lucky_customers[$n]=$customer;
                $n++;
            }
        }
        return $lucky_customers;
	}

	public function updateCustomers(){
		$customers=$this->getCustomers();
		foreach($customers as $customer){
        	$interaction=DB::table('interactions')->where('customer_id',$customer->id)->orderBy('id','desc');
        	if($interaction->count()>0){
        		$interaction=$interaction->first();
        		$type=$interaction->type;
        		$created_at=Carbon::Parse($interaction->created_at);
        		/*
        		This is the procedure to get how long ago did customer make interaction
        		but task 5 says add last interaction date, so if i need to show difference somewhere i will use code bellow:
        		$now=Carbon::now();
        		echo $now->diffForHumans($created_at);*/
        		DB::table('customers')->where('id',$customer->id)->update(['interaction_date'=>$created_at]);
        		DB::table('customers')->where('id',$customer->id)->update(['interaction_type'=>$type]);
        	}
        	break; //remove this break, vm is to slow so i try this part of code on one customer
        }
	}
}