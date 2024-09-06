<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Trip , TicketTrip , TypeCompany , Company , OwnerCompany } ;
use DB , Hash ;
use App\Traits\ManageFilesTrait ;


class HomeController extends Controller
{

    use ManageFilesTrait ;
    // latest 2 trips in home page (Hot Tour)
    public function index()
    {
        $trips = Trip::latest()->limit(2)->get();
        return view('pages.website.home' , compact('trips'));
    }


    public function createCompany()
    {
        $typeCompanies = TypeCompany::all();
        return view('pages.website.company.create' , compact('typeCompanies'));
    }

    public function storeCompany(Request $request)
    {
        try{
            DB::beginTransaction();
            // $validate = $request->validate([
            //     'name' => 'required|min:5',
            //     'email' => 'required|email|unique:owner_companies,email',
            //     'phone' => 'required|digits:11|unique:owner_companies,phone',
            //     'password' => 'required|min:8' ,
            //     'title_ar' => 'required|min:6',
            //     'title_en' => 'required|min:6',
            //     'about_company_ar' => 'required' ,
            //     'about_company_en' => 'required' ,
            //     'address' => 'required' ,
            //     'contact_number' => 'required|digits:11|unique:companies,phone',
            //     'type_company_id' => 'required|numeric',
            // ]);
            $owner = OwnerCompany::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'password' => Hash::make($request->password) ,
                'phone' => $request->phone ,
            ]);

            $company = Company::create([
                'title' => ['ar' => $request->title_ar , 'en' => $request->title_en ] ,
                'address' => $request->address,
                'about_company' => ['en' => $request->about_company_en  , 'ar' => $request->about_company_ar],
                'contact_number' => $request->contact_number ,
                'type_company_id' =>$request->type_company_id,
                'owner_id' => $owner->id ,
            ]);
            $this->updateOrCreateFiles($request , $company->id , $model = 'App\Models\Company' , $folder = 'companies' , $disk = 'files_companies') ;
            DB::commit();
            return redirect()->back()->with(['success' => 'تم إنشاء شركتك بنجاح سوف يكون البيانات تحت المراجع و سوف يرسل إليك ايميل بتفعيل حسابك بعد مراجعة بياناتك']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }



    }


    public function tickets()
    {
        $tickets = TicketTrip::where('user_id' , auth()->user()->id )->get() ;
        return view('pages.website.tickets.index' , compact('tickets'));
    }
}
