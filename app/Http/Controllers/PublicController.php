<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobApply;
use App\Models\JobData;
use App\Models\Testimonial;
use App\Traits\Common;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    use Common;


    public function index()
    {
        $categories = Category::get();
        $testimonials = Testimonial::where('published', 1)->get();
        $jobs=$this->jobVariables();
        // dd($jobs['featured']);
        return view('public.index',compact('testimonials','categories','jobs'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {

        return view('public.contact');
    }

    public function category()
    {
        $categories = Category::latest()->take(8)->get();
        return view('public.category', compact('categories'));
    }

    public function testimonial()
    {
        $testimonials = Testimonial::where('published', 1)->get();
        return view('public.testimonial',compact('testimonials'));
    }

    public function joblist()
    {
        $jobs=$this->jobVariables();

        return view('public.job-list',compact('jobs'));
    }

    public function jobdetails(String $id)
    {
        $job = JobData::with('company')->findOrFail($id);
        //dd($job);
        return view('public.job-detail', compact('job'));
    }

    public function jobApply(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'website' => 'required|string',
            'cv' => 'required|file',
            'cover_letter' => 'required|string',

        ]);
        $data['cv']=$this->uploadFile($request->cv,'assets/cv');

        JobApply::create($data);

        return redirect()->route('index');

    }
    public function like(string $id){
        $jobData=JobData::findOrFail($id);
        $jobData->update([
            'like'=>$jobData->like+1,
        ]);
        return redirect()->route('index');
    }

    public function jobVariables(){
        $featured = JobData::with('company')->where('published', 1)->where('featured',1)->get();
        $fullTime = JobData::where('published', 1)->where('job_nature','Full Time')->get();
        $partTime = JobData::where('published', 1)->where('job_nature','Part Time')->get();
        $jobs=['featured'=>$featured,'fullTime'=>$fullTime,'partTime'=>$partTime];
        return $jobs;
    }


}
