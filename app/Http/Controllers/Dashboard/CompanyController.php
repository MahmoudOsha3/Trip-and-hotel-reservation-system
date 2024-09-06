<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Company , TypeCompany , OwnerCompany , Attachment , Payment } ;
use App\Http\Requests\Admin\CompanyRequest ;
use App\Traits\ManageFilesTrait ;
use DB , Storage ;

class CompanyController extends Controller
{

    use ManageFilesTrait ;

    public function index()
    {
        $companies = Company::latest()->get() ;
        return view('pages.dashboard.companies.index' , compact('companies')) ;
    }


    public function create()
    {
        $type_companies = TypeCompany::all() ;
        $owner_companies = OwnerCompany::latest()->get();
        return view('pages.dashboard.companies.create' , compact('type_companies' , 'owner_companies')) ;
    }

    public function store(CompanyRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $validate = $request->validated();
            $company = Company::create([
                'title' => ['ar' => $request->title_ar , 'en' => $request->title_en ] ,
                'address' => $request->address,
                'contact_number' => $request->contact_number ,
                'type_company_id' =>$request->type_company_id ,
                'owner_id' => $request->owner_company_id ,
                'about_company' => ['en' => $request->about_company_en  , 'ar' => $request->about_company_ar],
            ]) ;
            $this->updateOrCreateFiles($request , $company->id , $model = 'App\Models\Company' , $folder = 'companies' , $disk = 'files_companies') ;
            DB::commit();
            return redirect()->back()->with(['success' => __(key:'site.added_successfully')]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $company = Company::findorfail($id) ;
        $type_companies = TypeCompany::all() ;
        $owner_companies = OwnerCompany::latest()->get();
        return view('pages.dashboard.companies.edit' , compact('company' , 'type_companies' , 'owner_companies')) ;
    }


    public function update(CompanyRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $validate = $request->validated() ;
            $company = Company::findorfail($id) ;
            $company->update([
                'title' => ['ar' => $request->title_ar , 'en' => $request->title_en ] ,
                'address' => $request->address,
                'contact_number' => $request->contact_number ,
                'type_company_id' =>$request->type_company_id ,
                'owner_id' => $request->owner_company_id ,
                'about_company' => ['en' => $request->about_company_en  , 'ar' => $request->about_company_ar],
            ]) ;
            $this->updateOrCreateFiles($request ,$company->id , $model = 'App\Models\Company' , $folder = 'companies' , $disk = 'files_companies') ;
            DB::commit();
            return redirect()->back()->with(['success' => __(key:'site.updated_successfully')]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try
        {
            DB::beginTransaction();
            $company = Company::findorfail($id);
            $this->deleteAllFiles($company->id , $model = 'App\Models\Company' , $folder = 'companies' , $disk = 'files_companies') ;
            $company->delete() ;
            DB::commit();
            return redirect()->back()->with(['success' => __(key:'site.deleted_successfully')]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function payments()
    {
        try{
            $payments = Payment::latest()->get() ;
            return view('pages.dashboard.paymnets.payments', compact('payments'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

}
