<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\enquirymail;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\StudentEnquiry;
use App\Models\Program;
use Carbon\Carbon;

class EnquiryController extends Controller
{

    public function Enquiry(Request $request)
    {
        // dd($request->all());


        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'course' => 'required',
            'contact'=>'required',
            'state' => 'required',
            'address' => 'required'
        ]);



     try{
         
        
        $course_stude=Program::where('id',$request->course)->where('status','1')->first();
        // dd($course_stude->title);
        
        $mail = MailSetting::where('status', '1')->first();
          
        $student_enquiry = new StudentEnquiry();
        $student_enquiry->name = $request->full_name;
        $student_enquiry->email = $request->email;
        $student_enquiry->contact = $request->contact;
        $student_enquiry->course = $request->course;

        $student_enquiry->state = $request->state;
        $student_enquiry->here_me = $request->here_me;
        $student_enquiry->refrence_persion = $request->ref_persion;
        $student_enquiry->enquiry_date = Carbon::now()->format('Y-m-d'); // current date
        $student_enquiry->address = $request->address;
        
        $student_enquiry->save();
        

        $data['name'] = $request->full_name;
        $data['email'] = $request->email;
        $data['contact'] = $request->contact;
        $data['course'] = $course_stude->title;
        $data['state'] = $request->state;
        $data['here_me'] = $request->here_me;
        $data['ref_persion'] = $request->ref_persion;
        $data['address'] = $request->address;

        $data['subject'] = __('enquiry');
        $data['from'] = $mail->sender_email;
        $data['sender'] = $mail->sender_name;


        // $toEmail = "singhmrityunjay511@gmail.com";
        $toEmail = $mail->sender_email;

        //    $message="Send email to user";
        //    $subject="Enquiry Information...";

        Mail::to($toEmail)->send(new enquirymail($data));

       $notification = array(
                'message' => 'Send Successfully..!',
                'alert-type' => __('msg_success')
            );
    
        return redirect()->back()->with($notification);
 
     }catch(\Exception $e){
         
         
            $notification = array(
                'message' => __('msg_updated_error'),
                'alert-type' => __('msg_error')
            );

            return redirect()->back()->with($notification);
     }
        
      
        

    }
}
