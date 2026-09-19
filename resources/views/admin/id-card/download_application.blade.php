<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <!--<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/admit_card.css') }}" media="screen, print">-->
     <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_application.css') }}" media="screen, print">

    @php 
    $version = App\Models\Language::version(); 
    @endphp
    @if($version->direction == 1)
    <!-- RTL css -->
    <style type="text/css" media="screen, print">
      .template-container {
        direction: rtl;
      }
      
    </style>
    @endif
    
<style>
        .form-number2 {
    text-align: right;
    font-weight: bold;
    font-size: 18px;
    color: #2e003e; /* optional: dark purple college theme */
    padding-right: 0px; /* optional: some spacing from edge */
}
.reg_no{
    color: red;
}

.office-use-section {
  /*border: 1px solid #ccc;*/
  padding: 12px;
  margin-bottom: 15px;
}


.signature-box {
  width: 120px; /* Reduced from 200px */
  height: 50px; /* Reduced from 100px */
  border: 1px solid #ccc;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  background-color: #f9f9f9;
  font-size: 12px; /* Reduced font size */
}

.photo-section {
  position: absolute;
  top: 275px;
  right: 1px;
  display: flex;
  flex-direction: column;
  gap: 5px;
  width: 139px; /* Reduced from 200px */
}

#downloadable {
    height: 1585px; /* Or use specific height like 800px */
    /*width:1100px;*/
    overflow: hidden; /* Hide anything overflow */
}
</style>

</head>
<body>

<div class="template-container" id="downloadable" style="width: 1000 ; height: 1000;">
  <div class="template-inner">
   
   
    <div class="container">
         <div class="form-number2"><span class="reg_no">Registration No:</span>{{@$application->registration_no}}</div>
      <div class="header">
        <div class="logo-section">
          <img
            src="{{asset('uploads/setting/rbs logo.png')}}"
            alt="RBS College Logo"
            class="college-logo"
          />
        </div>
        <h1>R.B.S.R.D.R. COLLEGE</h1>
        <p class="subtitle">
          (Run & Managed By-Ram Sharan Roy Memorial Educational and Social
          welfare trust)
        </p>
        <p class="recognition">
          Recognized by Department of health, Govt. of Bihar
        </p>
        <p class="affiliation">
          Affiliated by Bihar University Of Health Sciences, Patna & BNRC Patna
        </p>
        <p class="address">Add: Saraipur, Raghopur, Hajipur, Vaishali - 844102</p>
        <p class="address">Contact No: 8757407598, 8292004111</p>
      </div>
          <!--ADMISSION FORM-->

     <div class="form-title">ADMISSION FORM</div>

        <p class="form-instruction">
        Please read the prospectus carefully before filling the Application Form
      </p>

      <div class="photo-section">
        <div class="photo-box">
           @if(is_file('uploads/student/'.@$application->photo))
            <img src="{{ asset('uploads/student/'.@$application->photo) }}" class="img-radius img-fluid wid-80" style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}" onerror="this.src='{{ asset('dashboard/images/user/avatar-2.jpg') }}';">
            @else
            <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius img-fluid wid-80" style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}">
           @endif
        </div>
          <div class="signature-box" style="margin-top: 10px;">
            @if(is_file('uploads/student/'.@$application->signature))
                <img src="{{ asset('uploads/student/'.@$application->signature) }}" class="img-fluid" style="width:85%; max-height: 50px;" alt="{{ __('field_signature') }}" onerror="this.src='{{ asset('dashboard/images/signature/default-signature.png') }}';">
            @else
                <img src="{{asset('uploads/setting/signature.jpg')}}" class="img-fluid" style="width:85%; max-height: 50px;" alt="{{ __('field_signature') }}">
            @endif
        </div>
      </div>

      <div class="office-use-section">
        <h3>For Office use Only</h3>
        <div class="office-fields">
          <div class="field">1. Session: {{@$application->session}}</div>
          <div class="field">2. Admitted / Rejected / Under Consideration</div>
          <div class="field">3. Course: {{@$application->program->title}}</div>
          <div class="field">4. Roll No.: _________________________</div>
          <div class="field">5. Hostel: _________________________</div>
        </div>
      </div>

      <form class="admission-form">
        <div class="form-row">
          <label>01. Applicant's Name:</label>
          <input type="text" name="applicant_name" value="{{ @$application->first_name . ' ' . @$application->last_name }}"/>
          <span class="block-letters">(IN BLOCK LETTERS)</span>
        </div>

        <div class="form-row">
          <label>02. Father's name:</label>
          <input type="text" name="father_name" value="{{ @$application->father_name}}" />
        </div>
          <div class="form-row">
          <label>03. Mother's Name:</label>
          <input type="text" name="mother_name" value="{{ @$application->mother_name}}"/>
        </div>

        <div class="form-row">
          <label>04. Date of Birth:</label>
          <input type="date" name="dob" value="{{ @$application->dob}}" />
        </div>

        <div class="form-row">
          <label>05. Aadhaar No.:</label>
          <input type="text" name="aadhaar" value="{{ @$application->national_id}}" />
        </div>

        <div class="form-row">
          <label>06. Marital Status:</label>
          <div class="radio-group">
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="married" {{ @$application->marital_status == 1 ? 'checked' : '' }} />
              Married</label
            >
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="unmarried" {{ @$application->marital_status == 2 ? 'checked' : '' }} />
              Unmarried</label
            >
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="widow" {{ @$application->marital_status == 3 ? 'checked' : '' }} />
              Widow</label
            >
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="divorcee" {{ @$application->marital_status == 4 ? 'checked' : '' }} />
              Divorcee</label
            >
           </div>
        </div>
          <div class="form-row">
          <label>07. If Married Name of the Husband/Wife:</label>
          <input type="text" name="spouse_name" />
        </div>

        <div class="form-row">
          <label>08. Present Address:</label>
          
         <textarea name="present_address" value="{{ @$application->present_address}}">{{ @$application->present_address}}</textarea>


          <div class="address-line">
            <span>P/O.: <input type="text" name="present_po" value="{{ @$application->present_post}}" /></span>
            <span>P.S.: <input type="text" name="present_ps" value="{{ @$application->present_police_station}}"/></span>
            <span>District: <input type="text" name="present_district" value="{{ @$application->present_district}}" /></span>
            <span>STATE: <input type="text" name="present_state" value="{{ @$application->presentProvince->title}}"/></span>
          </div>
        </div>

        <div class="form-row">
          <label>09. Permanent Address:</label>
                 <textarea name="permanent_address" value="{{ @$application->permanent_address}}" >{{ @$application->permanent_address}}</textarea>

          <div class="address-line">
            
            <span>P/O.: <input type="text" name="permanent_po" value="{{ @$application->permanent_post}}" /></span>
            <span>P.S.: <input type="text"  name="permanent_ps" value="{{ @$application->permanent_police_station}}"/></span>
            <span>District: <input type="text" name="permanent_district" value="{{ @$application->permanent_district}}" /></span>
            <span>STATE: <input type="text" name="permanent_state" value="{{ @$application->permanentProvince->title}}" /></span>

          </div>
          
        </div>
        <div class="form-row academic-section">
          <label>10. Academic Record:</label>
          <p class="note">
            (Please enclose attested certificate here with the form)
          </p>

          <table class="edu-table">
            <thead>
              <tr>
                <th>Education Level</th>
                <th>School/College Name</th>
                <th>Board/University</th>
                <th>Complete Address</th>
                <th>Year of Passing</th>
                <th>Total Marks</th>
                <th>Marks Obtained</th>
                <th>%</th>
              </tr>
              </thead>
            <tbody>
              <tr>
                <td>High School (10th)</td>
                <td><input type="text" name="tenth_school" value="{{ @$application->high_school_name}}" required /></td>
                <td><input type="text" name="tenth_board" required /></td>
                <td><input type="text" name="tenth_address" required  value="{{ @$application->high_school_address}}"/></td>
                <td><input type="text" name="tenth_year" value="{{ @$application->high_school_graduation_year}}" required /></td>
                <td><input type="text" name="tenth_total_marks" required /></td>
                <td>
                  <input type="text" name="tenth_obtained_marks" required />
                </td>
                <td><input type="text" name="tenth_percentage" value="{{ @$application->high_school_graduation_percentage}}" required /></td>
              </tr>
              <tr>
                <td>Intermediate (12th)</td>
                <td><input type="text" name="twelfth_school" value="{{ @$application->intermediate_name}}"  required /></td>
                <td><input type="text" name="twelfth_board" required /></td>
                <td><input type="text" name="twelfth_address" required value="{{ @$application->intermediate_address}}" /></td>
                <td><input type="text" name="twelfth_year" required  value="{{ @$application->intermediate_graduation_year}}" /></td>
                <td>
                  <input type="text" name="twelfth_total_marks" required />
                </td>
                <td>
                  <input type="text" name="twelfth_obtained_marks" required />
                </td>
                <td>
                  <input type="text" name="twelfth_percentage" value="{{ @$application->inter_graduation_percentage}}" required />
                </td>
              </tr>
              <tr>
                <td>Graduation</td>
             <td><input type="text" name="graduation_college" value="{{ @$application->bach_college_name}}"/></td>
                <td><input type="text" name="graduation_university" /></td>
                <td><input type="text" name="graduation_address" value="{{ @$application->bach_college_address}}"/></td>
                <td><input type="text" name="graduation_year" value="{{ @$application->bach_gradu_year}}"/></td>
                <td><input type="text" name="graduation_total_marks" /></td>
                <td><input type="text" name="graduation_obtained_marks" /></td>
                <td><input type="text" name="graduation_percentage" value="{{ @$application->bach_gradu_percentage}}"/></td>
              </tr>
              <tr>
                <td>Masters</td>
                <td><input type="text" name="masters_college" value="{{ @$application->master_college_name}}" /></td>
                <td><input type="text" name="masters_university" /></td>
                <td><input type="text" name="masters_address" value="{{ @$application->master_college_address}}" /></td>
                <td><input type="text" name="masters_year" value="{{ @$application->master_gradu_year}}"/></td>
                <td><input type="text" name="masters_total_marks" /></td>
                <td><input type="text" name="masters_obtained_marks" /></td>
                <td><input type="text" name="masters_percentage"value="{{ @$application->master_gradu_percentage}}" /></td>
              </tr>
            </tbody>
          </table>
        </div>
       
      </form>
    </div>

  </div>
</div>
    
    <!-- PDF Js -->
    <script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/html2pdf/js/html2pdf.bundle.min.js') }}"></script>

    <script type="text/javascript">
        "use strict";
        var pdf_title =  '{{ $title }}' + '.pdf'
        var pdf_content = document.getElementById("downloadable");

        var options = {
          margin:       0,
          filename:     pdf_title,
          image:        { type: 'jpeg', quality: 8.00 },
          html2canvas:  { scale: 2 },
          jsPDF:        { unit: 'in', format: 'A3', orientation: 'portrait' }
        };

        html2pdf(pdf_content, options);
    </script>
</body>
</html>