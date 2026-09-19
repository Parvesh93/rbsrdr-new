<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,maximum-scale=1.0">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f2f2f2;
            padding: 40px;
        }

        /* ID CARD */

        .id-card {
            width: 420px;
            min-height: 230px;
            background: #e8edf3;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        /* HEADER */

        .header {
            background: #0b4a92;
            color: white;
            display: flex;
            align-items: center;
            padding: 8px 12px;
        }

        .logo {
            width: 42px;
            height: 42px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: 2px solid #ffd700;
        }

        .logo img {
            width: 40px;
        }

        .college-name {
            font-size: 18px;
            font-weight: bold;
        }

        .college-sub {
            font-size: 11px;
        }

        /* YELLOW BAR */

        .info-bar {
            min-height: 30px;
            background: #ffd700;
            display: flex;
            align-items: center;
            font-size: 12px;
            font-weight: 600;
            padding: 0 10px;
            padding-bottom: 3px;
            justify-content: space-between;
        }

        /* CONTENT */

        .content {
            display: flex;
            padding: 10px;
            position: relative;
            margin-bottom: -10px;
        }

        /* PHOTO */

        .photo-box {
            width: 110px;
            text-align: center;
        }

        .photo {
            width: 90px;
            height: 105px;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* SIGNATURE */



        .signature-box {
            width: 85px;
            /* photo width ke barabar */
            margin: 6px 0;
            /* center align */
            background: #f7f7f7;
            border-radius: 4px;
            padding: 3px;
            border: 1px solid #ddd;
        }

        .signature-box img {
            width: 100%;
            height: 22px;
            object-fit:cover;
            display: block;
            margin: auto;
        }

        .sign-text {
            font-size: 10px;
            color: #004a99;
            font-weight: bold;
            margin-top: 5px;
        }

        /* DETAILS */

        .details {
            flex: 1;
            padding-left: 10px;
            font-size: 12px;
        }

        .row {
            display: flex;
            border-bottom: 1px solid #d2d2d2;
            padding: 3px 0;
        }

        .label {
            width: 110px;
            font-weight: bold;
        }

        .value {
            flex: 1;
        }

        .name {
            color: red;
            font-weight: bold;
        }

        /* SESSION */

        .session {
            position: absolute;
            top: 25%;
            right: 25px;
            background: #32cd32;
            color: white;
            padding: 4px 8px;
            font-size: 10px;
            transform: rotate(-90deg);
            transform-origin: top right;
            white-space: nowrap;
            font-weight: bold;
            border-radius: 0;
            z-index: 10;
            width: 85px;
            text-align: center;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* AUTH SIGN */

        .auth {
            text-align: right;
            padding: 2px 10px;
            font-size: 13px;
        }

        .auth-img { height: 30px; width: auto; display: block; margin-left: auto; 
        
            margin-right : 16px;
        }   
        
        .form-group {
         margin-bottom: -45px !important;
        }



        /* PRINT */

        @media print {

            body {
                display: block !important;
                height: auto !important;
                margin: 0;
            }
            
            
            

            .printable {
                display: block;
                width: 100%;
                page-break-inside: avoid;
            }

            .page-break {
                page-break-after: always;
                break-after: page;
            }

            /* @page {
                size: A4;
                margin: 0;
            } */



            .printable {
                display: flex;
                justify-content: center;
                width: 100%;
                min-height: 210px;
                padding-top: calc((297mm - 270px) / 2);
                box-sizing: border-box;
                page-break-after: always;
            }

            .id-card {
                margin: 0 auto;
            }
            
            .auth {
            
            margin-bottom: 5px;
        }
            
            .form-group {
             margin-bottom: -45px !important;
            }

        }
    </style>
</head>

<body>
    @foreach ($rows as $row)
        @php
            $enroll = \App\Models\Student::enroll($row->id);
        @endphp
        <div class="printable">
            <div class="id-card">

                <div class="header">

                    <div class="logo">
                        <img src="{{ asset('uploads/setting/rsrgoi_logo.png') }}" alt="College Logo">
                    </div>

                    <div>
                        <div class="college-name">RSR GROUP OF INSTITUTIONS</div>
                        <div class="college-sub">
                            (A unit of Ram Sharan Roy Memorial Educational And Social Welfare Trust, Vaishali, Bihar) +91 8757407598
                        </div>
                    </div>

                </div>

                <div class="info-bar">

                    <div>Branch : RBSRDR COLLEGE (NURSING)</div>

                    <div>Reg No: RBSRDR/{{ $row->registration_no }}</div>

                </div>

                <div class="content">

                    <div class="photo-box">

                        <div class="photo">
                            @if (is_file('uploads/student/' . @$row->photo))
                                <img src="{{ asset('uploads/student/' . $row->photo) }}" alt="Student Photo" />
                            @else
                                <!--<img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius img-fluid wid-80" style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}">-->
                                <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" alt="Student Photo" />
                            @endif
                        </div>

                        <div class="signature-box">
                            @if (is_file('uploads/student/' . @$row->signature))
                                <img src="{{ asset('uploads/student/' . $row->signature) }}" alt="Signature" />
                            @else
                                <!--<img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius img-fluid wid-80" style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}">-->
                                <img src="{{ asset('uploads/setting/signature.jpg') }}" alt="Signature" />
                            @endif
                            <div class="sign-text">SIGNATURE</div>
                        </div>

                    </div>


                    <div class="details">

                        <div class="row">
                            <div class="label">Student's Name :</div>
                            <div class="value name">{{ $row->first_name }} {{ $row->last_name }}</div>
                        </div>

                        <div class="row">
                            <div class="label">Father's Name :</div>
                            <div class="value">{{ $row->father_name }}</div>
                        </div>

                        <div class="row">
                            <div class="label">DOB :</div>
                            <div class="value">{{ \Carbon\Carbon::parse($row->dob)->format('d-m-Y') }}</div>
                        </div>

                        <div class="row">
                            <div class="label">Roll No. :</div>
                            <div class="value">{{ $row->student_id }}</div>
                        </div>

                        <div class="row">
                            <div class="label">Course :</div>
                            <div class="value">{{ $enroll->program->shortcode }}</div>
                        </div>

                        <div class="row">
                            <div class="label">Contact :</div>
                            <div class="value">{{ $row->phone }}</div>
                        </div>

                        <div class="row">
                            <div class="label">Address :</div>
                            <div class="value">{{ $row->present_address }}</div>
                        </div>

                    </div>

                    <div class="session">
                        SESSION {{ $enroll->session->title }}
                    </div>

                </div> 
         

                <div class="auth">
                    <img src="{{ asset('uploads/signature/signature2.png') }}" class="auth-img">
                    <div>Auth. Signature</div>
                </div>

            </div>
        </div>
    @endforeach

    <!-- Print Js -->
    <script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/print/js/jQuery.print.min.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            "use strict";
            $.print(".printable");
        });
    </script>



</body>

</html>
