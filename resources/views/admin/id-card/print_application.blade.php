<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width,maximum-scale=1.0">
	<title>{{ @$title }}</title>

	<style type="text/css" media="print">
	@media print {
      @page { size: auto; margin: 10px; }  
      @page :footer { display: none }
      @page :header { display: none }
      body { margin: 15mm 15mm 15mm 15mm; }
      .page-break { page-break-before: auto; }
      table, tbody, tr, .template-inner, .template-container {page-break-inside: avoid;}
	}
	table, img, svg {
      break-inside: avoid;
	}
	.template-container {
      -webkit-transform: scale(1.0);  /* Saf3.1+, Chrome */
      -moz-transform: scale(1.0);  /* FF3.5+ */
      -ms-transform: scale(1.0);  /* IE9 */
      -o-transform: scale(1.0);  /* Opera 10.5+ */
      transform: scale(1.0);
    }
	</style>

	<!--<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_id_card.css') }}" media="screen, print">-->
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
    .template-container .temp-title h2, 
    .template-container .temp-title h4, 
    .template-container .temp-footer .inner p {
      text-align: center;
    }
    .template-container .table-no-border tr td {
      float: right;
      text-align: right;
    }
    .template-container .table-no-border tr td.temp-logo {
      float: none;
    }
  </style>
  @endif
</head>
<body>


<div class="printable">
    <!--rbs_logo_1744443454.png-->

 <div class="container">
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
        <p class="address">Saraipur, Raghopur, Hajipur, Vaishali - 844102</p>
      </div>

     <div class="form-number">287</div>
      <div class="form-title">ADMISSION FORM</div>

      <p class="form-instruction">
        Please read the prospectus carefully before filling the Application Form
      </p>

      <div class="photo-section">
        <div class="photo-box">
          Affix Recent<br />
          Passport Size<br />
          Photograph
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
        <div class="form-section">
          <label>01. Applicant's Name:</label>
          <input type="text" name="applicant_name" value="{{ @$application->first_name . ' ' . @$application->last_name }}" />
          <!--<span class="block-letters">(IN BLOCK LETTERS)</span>-->
        </div>

        <div class="form-section">
          <label>02. Father's name:</label>
          <input type="text" name="father_name" value="{{ @$application->father_name}}" />
        </div>

        <div class="form-section">
          <label>03. Mother's Name:</label>
          <input type="text" name="mother_name" value="{{ @$application->mother_name}}"/>
        </div>

        <div class="form-section">
          <label>04. Date of Birth:</label>
          <input type="date" name="dob" value="{{ @$application->dob}}" />
        </div>

        <div class="form-section">
          <label>05. Aadhaar No.:</label>
          <input type="text" name="aadhaar" value="{{ @$application->national_id}}" />
        </div>
         <div class="form-section">
          <label>06. Marital Status (Please Tick):</label>
          <input type="radio" name="marital_status" value="{{ @$application->marital_status}}" />
          <!--<div class="marital-status">-->
          <!--  <label-->
          <!--    ><input type="radio" name="marital_status" value="married" />-->
          <!--    Married</label-->
          <!--  >-->
          <!--  <label-->
          <!--    ><input type="radio" name="marital_status" value="unmarried" />-->
          <!--    Unmarried</label-->
          <!--  >-->
          <!--  <label-->
          <!--    ><input type="radio" name="marital_status" value="widow" />-->
          <!--    Widow</label-->
          <!--  >-->
          <!--  <label-->
          <!--    ><input type="radio" name="marital_status" value="divorcee" />-->
          <!--    Divorcee</label-->
          <!--  >-->
          <!--</div>-->
        </div>
        <div class="form-section">
          <label>07. If Married Name of the Husband/Wife:</label>
          <input type="text" name="spouse_name" />
        </div>

        <div class="form-section">
          <label>08. Present Address:</label>
          <textarea name="present_address" value="{{ @$application->present_address}}">{{ @$application->present_address}}</textarea>
          <div class="address-details">
            <div>P/O.: <input type="text" value="{{ @$application->present_post}}" /></div>
            <div>P.S.: <input type="text" value="{{ @$application->present_police_station}}"/></div>
            <div>District: <input type="text" value="{{ @$application->present_district}}" /></div>
            <div>STATE: <input type="text" value="{{ @$application->presentProvince->title}}"/></div>
          </div>
        </div>

        <div class="form-section">
          <label>09. Permanent Address:</label>
          <textarea name="permanent_address" value="{{ @$application->permanent_address}}" >{{ @$application->permanent_address}}</textarea>
          <div class="address-details">
            <div>P/O.: <input type="text" value="{{ @$application->permanent_post}}" /></div>
            <div>P.S.: <input type="text" value="{{ @$application->permanent_police_station}}"/></div>
            <div>District: <input type="text" value="{{ @$application->permanent_district}}" /></div>
            <div>STATE: <input type="text" value="{{ @$application->permanentProvince->title}}" /></div>
          </div>
        </div>
        <div class="form-section">
          <label>10. Academic Record:</label>
          <p>(Please enclose attested certificate here with the form)</p>
          <table>
            <thead>
              <tr>
                <th>Sl. No.</th>
                <th>Exam Passed</th>
                <th>Name of the school/ College & Address</th>
                <th>Name of Board/ University</th>
                <th>Year of Passing</th>
                <th>Subjects</th>
                <th>Marks Obtained/ Full Marks</th>
                <th>% of Marks</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td>10th</td>
                <td><input type="text" value="{{ @$application->high_school_name}}" /></td>
                <td><input type="text" /></td>
                <td><input type="text" value="{{ @$application->high_school_graduation_year}}" /></td>
                <td><input type="text" /></td>
                <td><input type="text" /></td>
                <td><input type="text" value="{{ @$application->high_school_graduation_percentage}}"/></td>
              </tr>
                  <tr>
                <td>2.</td>
                <td>12th</td>
                <td><input type="text" value="{{ @$application->intermediate_name}}" /></td>
                <td><input type="text"  /></td>
                <td><input type="text" value="{{ @$application->intermediate_graduation_year}}"/></td>
                <td><input type="text" /></td>
                <td><input type="text" /></td>
                <td><input type="text" value="{{ @$application->inter_graduation_percentage}}" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>

 
 <!--<h1>Ram</h1>-->
<div class="page-break"></div>
</div>


	<!-- Print Js -->
	<script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
	<script src="{{ asset('dashboard/plugins/print/js/jQuery.print.min.js') }}"></script>

	<script type="text/javascript">
	$( document ).ready(function() {
        "use strict";
	   $.print(".printable");
	});
	</script>

</body>
</html>