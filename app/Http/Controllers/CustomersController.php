<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Repositories\CustomerRepository;
use App\Repositories\CompanyRepository;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
    	/*
		Because we don't have part where we add interactions, i put 5. and 6. task here.
		Everytime someone open page customer we update columns in table (check last interaction for every user and update in customers table)
    	*/
        $customerRepository=new CustomerRepository();
    	$customerRepository->updateCustomers();
        $customers=$customerRepository->getCustomersByName();
        return view('customers', ['customers' => $customers]);
    }

    public function edit(Customer $customer)
    {
        return view('customer', ['customer' => $customer]);
    }

    public function add(Request $request)
    {
        $customerRepository=new CustomerRepository();
        $companyRepository=new companyRepository();

        $company=$companyRepository->getCompanyById($request);

        $request->request->set('company_name',$company->name);

        $customer=$customerRepository->addCustomer($request);
        $customers =$customerRepository->getCustomersByName();
        return view('customers', ['customers' => $customers]);
    }
    public function manipulate(Request $request){
        $customerRepository=new CustomerRepository();
        if($request->sortby=='birth_date') {
            $customers = $customerRepository->getCustomersByBirth();
            return view('customers', ['customers' => $customers]);
        } elseif($request->sortby=='last_interaction'){
            $customers = $customerRepository->getCustomersByInteraction();
            return view('customers', ['customers' => $customers]);
        } elseif($request->sortby=='company_name'){
            $customers = $customerRepository->getCustomersByCompany();
            return view('customers', ['customers' => $customers]);
        } elseif($request->sortby=='joining_date'){
            $customers = $customerRepository->getCustomersByJoining();
            return view('customers', ['customers' => $customers]);
        } elseif($request->searchby=='yes'){
            $customers=$customerRepository->getCustomersBySearch($request);
            return view('customers', ['customers' => $customers]);
        } elseif($request->filterby=='yes'){
            $lucky_customers=$customerRepository->getCustomersByFilter();
            return view('birth_this_week', ['customers' => $lucky_customers]);  
        }
    }
}
