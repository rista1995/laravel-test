<?php

namespace App\Repositories;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyRepository{
	public function getCompanyById(Request $request){
		return DB::table('companies')->where('id',$request['company_id'])->first();
	}
}