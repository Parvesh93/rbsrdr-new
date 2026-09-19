@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
    <!-- Wizard css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/wizard.css') }}">
@endsection

@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ Card ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('modal_edit') }} {{ $title }}</h5>
                        </div>
                        <div class="card-block">
                            <a href="{{ route($route . '.index') }}" class="btn btn-primary"><i
                                    class="fas fa-arrow-left"></i>
                                {{ __('btn_back') }}</a>

                            <a href="{{ route($route . '.edit', $row->id) }}" class="btn btn-info"><i
                                    class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                        </div>

                        @php
                            function field($slug)
                            {
                                return \App\Models\Field::field($slug);
                            }
                        @endphp
                        <div class="wizard-sec-bg">
                            <form id="wizard-advanced-form" class="needs-validation" novalidate
                                action="{{ route($route . '.update', $row->id) }}" method="post"
                                enctype="multipart/form-data" style="display: none;">
                                @csrf
                                @method('PUT')

                                <h3>{{ __('tab_basic_info') }}</h3>
                                <content class="form-step">
                                    <!-- Form Start -->
                                    <div class="row">
                                        <div class="col-md-12">

                                            <fieldset class="row scheduler-border">
                                                <legend>{{ __('field_academic_information') }}</legend>

                                                <div class="form-group col-md-4">
                                                    <label for="registration_no">{{ __('field_stu_registration_no') }}
                                                        <span>*</span></label>
                                                    <input type="text" class="form-control" name="registration_no"
                                                        id="registration_no" value="{{ $row->registration_no }}">

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_stu_registration_no') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="student_id">{{ __('field_student_id') }}
                                                        <span>*</span></label>
                                                    <input type="text" class="form-control" name="student_id"
                                                        id="student_id" value="{{ $row->student_id }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_student_id') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="batch">{{ __('field_batch') }} <span>*</span></label>
                                                    <select class="form-control" name="batch" id="batch" required>
                                                        <option value="">{{ __('select') }}</option>
                                                        @foreach ($batches as $batch)
                                                            <option value="{{ $batch->id }}"
                                                                @if ($row->batch_id == $batch->id) selected @endif>
                                                                {{ $batch->title }}</option>
                                                        @endforeach
                                                    </select>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_batch') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="status">{{ __('field_status') }}</label>
                                                    <select class="form-control select2" name="statuses[]" id="status"
                                                        multiple>
                                                        @foreach ($statuses as $status)
                                                            <option value="{{ $status->id }}"
                                                                @foreach ($row->statuses as $stat) {{ $stat->id == $status->id ? 'selected' : '' }} @endforeach>
                                                                {{ $status->title }}</option>
                                                        @endforeach
                                                    </select>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_status') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="admission_mode">{{ 'Admission Mode' }}
                                                        <span>*</span></label>
                                                    <select class="form-control" name="admission_mode" id="admission_mode"
                                                        required>
                                                        <option value="">{{ __('select') }}</option>
                                                        <option value="DRCC"
                                                            @if ($row->admission_mode == 'DRCC') selected @endif>
                                                            {{ 'DRCC' }}</option>
                                                        <option value="Cash"
                                                            @if ($row->admission_mode == 'Cash') selected @endif>
                                                            {{ 'Cash' }}</option>

                                                    </select>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ 'Admission Mode' }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="total_course_fees">{{ 'Total Course Fees' }}
                                                        <span>*</span></label>
                                                    <input type="text" class="form-control" name="total_course_fees"
                                                        id="total_course_fees" value="{{ $row->total_course_fees }}"
                                                        required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ 'Total Course Fees' }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="refrence_person_name">{{ 'Reference Person Name' }}
                                                    </label>
                                                    <input type="text" class="form-control" name="refrence_person_name"
                                                        id="refrence_person_name" value="{{ $row->refrence_person_name }}">

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ 'Reference Person Name' }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="refrence_person_contact">{{ 'Reference Person Contact No' }}
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        name="refrence_person_contact" id="refrence_person_contact"
                                                        value="{{ $row->refrence_person_contact }}">

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ 'Reference Person Contact No' }}
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset class="row scheduler-border">
                                                <div class="form-group col-md-6">
                                                    <label for="first_name">{{ __('field_first_name') }}
                                                        <span>*</span></label>
                                                    <input type="text" class="form-control" name="first_name"
                                                        id="first_name" value="{{ $row->first_name }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_first_name') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="last_name">{{ __('field_last_name') }}
                                                    </label>
                                                    <input type="text" class="form-control" name="last_name"
                                                        id="last_name" value="{{ $row->last_name }}">

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_last_name') }}
                                                    </div>
                                                </div>

                                                @if (field('student_father_name')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="father_name">{{ __('field_father_name') }}</label>
                                                        <input type="text" class="form-control" name="father_name"
                                                            id="father_name" value="{{ $row->father_name }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_father_name') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_father_occupation')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="father_occupation">{{ __('field_father_occupation') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="father_occupation" id="father_occupation"
                                                            value="{{ $row->father_occupation }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_father_occupation') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_mother_name')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="mother_name">{{ __('field_mother_name') }}</label>
                                                        <input type="text" class="form-control" name="mother_name"
                                                            id="mother_name" value="{{ $row->mother_name }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_mother_name') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_mother_occupation')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="mother_occupation">{{ __('field_mother_occupation') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="mother_occupation" id="mother_occupation"
                                                            value="{{ $row->mother_occupation }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_mother_occupation') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="form-group col-md-6">
                                                    <label for="phone">{{ __('field_phone') }} <span>*</span></label>
                                                    <input type="text" class="form-control" name="phone"
                                                        id="phone" value="{{ $row->phone }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_phone') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="email">{{ __('field_email') }} <span>*</span></label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="email" value="{{ $row->email }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_email') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="gender">{{ __('field_gender') }} <span>*</span></label>
                                                    <select class="form-control" name="gender" id="gender" required>
                                                        <option value="">{{ __('select') }}</option>
                                                        <option value="1"
                                                            @if ($row->gender == 1) selected @endif>
                                                            {{ __('gender_male') }}</option>
                                                        <option value="2"
                                                            @if ($row->gender == 2) selected @endif>
                                                            {{ __('gender_female') }}</option>
                                                        <option value="3"
                                                            @if ($row->gender == 3) selected @endif>
                                                            {{ __('gender_other') }}</option>
                                                    </select>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_gender') }}
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="dob">{{ __('field_dob') }} <span>*</span></label>
                                                    <input type="date" class="form-control date" name="dob"
                                                        id="dob" value="{{ $row->dob }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_dob') }}
                                                    </div>
                                                </div>

                                                @if (field('student_emergency_phone')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="emergency_phone">{{ __('field_phone_parents') }}</label>
                                                        <input type="text" class="form-control" name="emergency_phone"
                                                            id="emergency_phone" value="{{ $row->emergency_phone }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_phone_parents') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_religion')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="religion">{{ __('field_religion') }}</label>
                                                        <input type="text" class="form-control" name="religion"
                                                            id="religion" value="{{ $row->religion }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_religion') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_caste')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="gender">{{ __('field_caste') }}
                                                            <span>*</span></label>

                                                        <select class="form-control" name="caste" id="caste"
                                                            required>
                                                            <option value="">{{ __('select') }}</option>
                                                            <option value="{{ $row->caste }}"
                                                                @if ($row->caste == 'GEN') selected @endif>
                                                                {{ 'GEN' }}</option>
                                                            <option value="{{ $row->caste }}"
                                                                @if ($row->caste == 'OBC') selected @endif>
                                                                {{ 'OBC' }}</option>
                                                            <option value="{{ $row->caste }}"
                                                                @if ($row->caste == 'SC') selected @endif>
                                                                {{ 'SC' }}</option>
                                                            <option value="{{ $row->caste }}"
                                                                @if ($row->caste == 'ST') selected @endif>
                                                                {{ 'ST' }}</option>
                                                            <option value="{{ $row->caste }}"
                                                                @if ($row->caste == 'OTHER') selected @endif>
                                                                {{ 'OTHER' }}</option>
                                                        </select>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_caste') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_mother_tongue')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="mother_tongue">{{ __('field_mother_tongue') }}</label>
                                                        <input type="text" class="form-control" name="mother_tongue"
                                                            id="mother_tongue" value="{{ $row->mother_tongue }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_mother_tongue') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_nationality')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="nationality">{{ __('field_nationality') }}</label>
                                                        <input type="text" class="form-control" name="nationality"
                                                            id="nationality" value="{{ $row->nationality }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_nationality') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_marital_status')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="marital_status">{{ __('field_marital_status') }}</label>
                                                        <select class="form-control" name="marital_status"
                                                            id="marital_status">
                                                            <option value="">{{ __('select') }}</option>
                                                            <option value="1"
                                                                @if ($row->marital_status == 1) selected @endif>
                                                                {{ __('marital_status_single') }}</option>
                                                            <option value="2"
                                                                @if ($row->marital_status == 2) selected @endif>
                                                                {{ __('marital_status_married') }}</option>
                                                            <option value="3"
                                                                @if ($row->marital_status == 3) selected @endif>
                                                                {{ __('marital_status_widowed') }}</option>
                                                            <option value="4"
                                                                @if ($row->marital_status == 4) selected @endif>
                                                                {{ __('marital_status_divorced') }}</option>
                                                            <option value="5"
                                                                @if ($row->marital_status == 5) selected @endif>
                                                                {{ __('marital_status_other') }}</option>
                                                        </select>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_marital_status') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_blood_group')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="blood_group">{{ __('field_blood_group') }}</label>
                                                        <select class="form-control" name="blood_group" id="blood_group">
                                                            <option value="">{{ __('select') }}</option>
                                                            <option value="1"
                                                                @if ($row->blood_group == 1) selected @endif>
                                                                {{ __('A+') }}</option>
                                                            <option value="2"
                                                                @if ($row->blood_group == 2) selected @endif>
                                                                {{ __('A-') }}</option>
                                                            <option value="3"
                                                                @if ($row->blood_group == 3) selected @endif>
                                                                {{ __('B+') }}</option>
                                                            <option value="4"
                                                                @if ($row->blood_group == 4) selected @endif>
                                                                {{ __('B-') }}</option>
                                                            <option value="5"
                                                                @if ($row->blood_group == 5) selected @endif>
                                                                {{ __('AB+') }}</option>
                                                            <option value="6"
                                                                @if ($row->blood_group == 6) selected @endif>
                                                                {{ __('AB-') }}</option>
                                                            <option value="7"
                                                                @if ($row->blood_group == 7) selected @endif>
                                                                {{ __('O+') }}</option>
                                                            <option value="8"
                                                                @if ($row->blood_group == 8) selected @endif>
                                                                {{ __('O-') }}</option>
                                                        </select>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_blood_group') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_national_id')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="national_id">{{ __('field_national_id') }}</label>
                                                        <input type="text" class="form-control" name="national_id"
                                                            id="national_id" value="{{ $row->national_id }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_national_id') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('student_pan_id')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="pan_id">{{ __('field_pan_id') }}</label>
                                                        <input type="text" class="form-control" name="pan_id"
                                                            id="pan_id" value="{{ $row->pan_id }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_pan_id') }}
                                                        </div>
                                                    </div>
                                                @endif




                                                @if (field('student_passport_no')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="passport_no">{{ __('field_passport_no') }}</label>
                                                        <input type="text" class="form-control" name="passport_no"
                                                            id="passport_no" value="{{ $row->passport_no }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_passport_no') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="form-group col-md-6">
                                                    <label for="admission_date">{{ __('field_admission_date') }}
                                                        <span>*</span></label>
                                                    <input type="date" class="form-control date" name="admission_date"
                                                        id="admission_date" value="{{ $row->admission_date }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_admission_date') }}
                                                    </div>
                                                </div>
                                                <!--@if (field('student_college_status')->status == 1)-->
                                                <!--    <div class="form-group col-md-6">-->
                                                <!--        <label for="college_status">{{ 'College Status' }}-->
                                                <!--            <span>*</span></label>-->
                                                <!--        <select class="form-control" name="college_status" required>-->
                                                <!--            <option value="">{{ __('select') }}</option>-->

                                                <!--            <option value="1"-->
                                                <!--                @if ($row->admission_college == 1)
    selected
    @endif>-->
                                                <!--                {{ 'Ram Sharan Roy Group of Institutions' }}</option>-->
                                                <!--            <option value="2"-->
                                                <!--                @if ($row->admission_college == 2)
    selected
    @endif>-->
                                                <!--                {{ 'Second College' }}</option>-->

                                                <!--        </select>-->


                                                <!--        <div class="invalid-feedback">-->
                                                <!--            {{ __('required_field') }} {{ 'College Status' }}-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--@endif-->
                                            </fieldset>
                                        </div>
                                    </div>

                                    @if (field('student_address')->status == 1)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset class="row scheduler-border">
                                                    <legend>{{ __('field_present') }} {{ __('field_address') }}</legend>
                                                    <div class="form-group col-md-12">
                                                        <label for="present_address">{{ __('field_address') }}</label>
                                                        <input type="text" class="form-control" name="present_address"
                                                            id="present_address" value="{{ $row->present_address }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_address') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="present_pin">{{ __('field_pin_code') }}
                                                        </label>
                                                        <input type="text" class="form-control" name="present_pin"
                                                            id="present_pin" value="{{ $row->present_pin }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_pin_code') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="present_post">{{ __('field_post') }}</label>
                                                        <input type="text" class="form-control" name="present_post"
                                                            id="present_post" value="{{ $row->present_post }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_post') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label
                                                            for="present_police_station">{{ __('field_script') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="present_police_station" id="present_police_station"
                                                            value="{{ $row->present_police_station }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_script') }}
                                                        </div>
                                                    </div>

                                                    @include('common.inc.present_province_address')
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6">
                                                <fieldset class="row scheduler-border">
                                                    <legend>{{ __('field_permanent') }} {{ __('field_address') }}
                                                    </legend>
                                                    <div class="form-group col-md-12">
                                                        <label for="same_address"></label>
                                                        <input type="checkbox" class="form-check-input"
                                                            name="same_address" id="same_address"
                                                            style="margin-right: 8px;">{{ __('field_same_address') }}

                                                        <!--<div class="invalid-feedback">-->
                                                        <!--{{ __('required_field') }} {{ __('field_same_address') }}-->
                                                        <!--</div>-->
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="permanent_address">{{ __('field_address') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="permanent_address" id="permanent_address"
                                                            value="{{ $row->permanent_address }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_address') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="permanent_pin">{{ __('field_pin_code') }}
                                                        </label>
                                                        <input type="text" class="form-control" name="permanent_pin"
                                                            id="permanent_pin" value="{{ $row->permanent_pin }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_pin_code') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="permanent_post">{{ __('field_post') }}</label>
                                                        <input type="text" class="form-control" name="permanent_post"
                                                            id="permanent_post" value="{{ $row->permanent_post }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_post') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label
                                                            for="permanent_police_station">{{ __('field_script') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="permanent_police_station" id="permanent_police_station"
                                                            value="{{ $row->permanent_police_station }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_script') }}
                                                        </div>
                                                    </div>

                                                    @include('common.inc.permanent_province')
                                                </fieldset>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Form End -->
                                </content>

                                <h3>{{ __('tab_educational_info') }}</h3>
                                <content class="form-step">
                                    <!-- Form Start--->
                                    <!--For High School-->
                                    @if (field('student_school_info')->status == 1)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_school_information') }}</legend>
                                            <div class="form-group col-md-4">
                                                <label for="high_school_name">{{ __('field_school_name') }}</label>
                                                <input type="text" class="form-control" name="high_school_name"
                                                    id="high_school_name" value="{{ $row->high_school_name }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_school_name') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="high_school_study_address">{{ __('field_study_address') }}</label>
                                                <input type="text" class="form-control"
                                                    name="high_school_study_address" id="high_school_study_address"
                                                    value="{{ $row->high_school_address }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_study_address') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="high_school_graduation_year">{{ __('field_graduation_year') }}</label>
                                                <input type="text" class="form-control"
                                                    name="high_school_graduation_year" id="high_school_graduation_year"
                                                    value="{{ $row->high_school_graduation_year }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="high_school_total_marks">{{ __('field_total_marks') }}
                                                    <span>*</span></label>
                                                <input type="text" class="form-control" name="high_school_total_marks"
                                                    id="high_school_total_marks"
                                                    value="{{ $row->high_school_total_marks }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_total_marks') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="high_school_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                    <span>*</span></label>
                                                <input type="text" class="form-control"
                                                    name="high_school_total_marks_obtained"
                                                    id="high_school_total_marks_obtained"
                                                    value="{{ $row->high_school_marks_obtained }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_marks_obtained') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="high_school_graduation_percentage">{{ __('field_graduation_percentage') }}</label>
                                                <input type="text" class="form-control"
                                                    name="high_school_graduation_percentage"
                                                    id="high_school_graduation_percentage"
                                                    value="{{ $row->high_school_graduation_percentage }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_percentage') }}
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif
                                    <!--For Intermediate School-->

                                    @if (field('student_collage_info')->status == 1)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_college_information') }}</legend>
                                            <div class="form-group col-md-4">
                                                <label
                                                    for="intermediate_name">{{ __('field_intermediate_name') }}</label>
                                                <input type="text" class="form-control" name="intermediate_name"
                                                    id="intermediate_name" value="{{ $row->intermediate_name }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_intermediate_name') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="intermediate_study_address">{{ __('field_study_address') }}</label>
                                                <input type="text" class="form-control"
                                                    name="intermediate_study_address" id="intermediate_study_address"
                                                    value="{{ $row->intermediate_address }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_study_address') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="intermediate_graduation_year">{{ __('field_graduation_year') }}</label>
                                                <input type="text" class="form-control"
                                                    name="intermediate_graduation_year" id="intermediate_graduation_year"
                                                    value="{{ $row->intermediate_graduation_year }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="intermediate_total_marks">{{ __('field_total_marks') }}
                                                    <span>*</span></label>
                                                <input type="text" class="form-control"
                                                    name="intermediate_total_marks" id="intermediate_total_marks"
                                                    value="{{ $row->intermediate_total_marks }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_total_marks') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="intermediate_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                    <span>*</span></label>
                                                <input type="text" class="form-control"
                                                    name="intermediate_total_marks_obtained"
                                                    id="intermediate_total_marks_obtained"
                                                    value="{{ $row->intermediate_marks_obtained }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_marks_obtained') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="intermediate_graduation_percentage">{{ __('field_graduation_percentage') }}</label>
                                                <input type="text" class="form-control"
                                                    name="intermediate_graduation_percentage"
                                                    id="intermediate_graduation_percentage"
                                                    value="{{ $row->inter_graduation_percentage }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_percentage') }}
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif
                                    {{-- For  Bachelors   --}}
                                    @if (field('student_bachelor_info')->status == 1)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_bachelor_information') }}</legend>
                                            <div class="form-group col-md-4">
                                                <label
                                                    for="bachelor_college_name">{{ __('field_bachelor_name') }}</label>
                                                <input type="text" class="form-control" name="bachelor_college_name"
                                                    id="bachelor_college_name" value="{{ $row->bach_college_name }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_bachelor_name') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="bachelor_study_address">{{ __('field_study_address') }}</label>
                                                <input type="text" class="form-control" name="bachelor_study_address"
                                                    id="bachelor_study_address"
                                                    value="{{ $row->bach_college_address }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_study_address') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="bachelor_graduation_year">{{ __('field_graduation_year') }}</label>
                                                <input type="text" class="form-control"
                                                    name="bachelor_graduation_year" id="bachelor_graduation_year"
                                                    value="{{ $row->bach_gradu_year }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="bachelor_total_marks">{{ __('field_total_marks') }}
                                                </label>
                                                <input type="text" class="form-control" name="bachelor_total_marks"
                                                    id="bachelor_total_marks" value="{{ $row->bach_total_marks }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_total_marks') }}
                                                </div>
                                            </div>


                                            <div class="form-group col-md-4">
                                                <label
                                                    for="bachelor_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                </label>
                                                <input type="text" class="form-control"
                                                    name="bachelor_total_marks_obtained"
                                                    id="bachelor_total_marks_obtained"
                                                    value="{{ $row->bach_marks_obtained }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_marks_obtained') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="bachelor_graduation_percentage">{{ __('field_graduation_percentage') }}</label>
                                                <input type="text" class="form-control"
                                                    name="bachelor_graduation_percentage"
                                                    id="bachelor_graduation_percentage"
                                                    value="{{ $row->bach_gradu_percentage }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_percentage') }}
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif

                                    {{-- For Master  --}}
                                    @if (field('student_master_info')->status == 1)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_master_information') }}</legend>
                                            <div class="form-group col-md-4">
                                                <label for="master_college_name">{{ __('field_master_name') }}</label>
                                                <input type="text" class="form-control" name="master_college_name"
                                                    id="master_college_name" value="{{ $row->master_college_name }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_master_name') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="master_study_address">{{ __('field_study_address') }}</label>
                                                <input type="text" class="form-control" name="master_study_address"
                                                    id="master_study_address"
                                                    value="{{ $row->master_college_address }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_study_address') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="master_graduation_year">{{ __('field_graduation_year') }}</label>
                                                <input type="text" class="form-control" name="master_graduation_year"
                                                    id="master_graduation_year" value="{{ $row->master_gradu_year }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                </div>
                                            </div>


                                            <div class="form-group col-md-4">
                                                <label for="master_total_marks">{{ __('field_total_marks') }}
                                                </label>
                                                <input type="text" class="form-control" name="master_total_marks"
                                                    id="master_total_marks" value="{{ $row->master_total_marks }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_total_marks') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="master_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                </label>
                                                <input type="text" class="form-control"
                                                    name="master_total_marks_obtained" id="master_total_marks_obtained"
                                                    value="{{ $row->master_marks_obtained }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_marks_obtained') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label
                                                    for="master_graduation_percentage">{{ __('field_graduation_percentage') }}</label>
                                                <input type="text" class="form-control"
                                                    name="master_graduation_percentage" id="master_graduation_percentage"
                                                    value="{{ $row->master_gradu_percentage }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_graduation_percentage') }}
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif



                                    @if (field('student_relatives')->status == 1)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_guardians_information') }}</legend>
                                            <div class="container-fluid">

                                                @foreach ($row->relatives as $relative)
                                                    <hr />
                                                    <div id="inputFormField" class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="relation"
                                                                class="form-label">{{ __('field_relation') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="relations[]"
                                                                id="relation" value="{{ $relative->relation }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_relation') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="relative_name"
                                                                class="form-label">{{ __('field_name') }}
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                name="relative_names[]" id="relative_name"
                                                                value="{{ $relative->name }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_name') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="occupation"
                                                                class="form-label">{{ __('field_occupation') }}
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                name="occupations[]" id="occupation"
                                                                value="{{ $relative->occupation }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_occupation') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="relative_phone"
                                                                class="form-label">{{ __('field_phone_parents') }}
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                name="relative_phones[]" id="relative_phone"
                                                                value="{{ $relative->phone }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }}
                                                                {{ __('field_phone_parents') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="address"
                                                                class="form-label">{{ __('field_address') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="addresses[]"
                                                                id="address" value="{{ $relative->address }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_address') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <button id="removeField" type="button"
                                                                class="btn btn-danger btn-filter"><i
                                                                    class="fas fa-trash-alt"></i>
                                                                {{ __('btn_remove') }}</button>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div id="newField" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addField" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i> {{ __('btn_add_new') }}</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif

                                    @if (!empty($row->refrences))
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_references_information') }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->refrences as $refrence)
                                                    <div id="inputFormFieldSecond" class="row">

                                                        <div class="form-group col-md-4"><label for="refrence_ids"
                                                                class="form-label">{{ __('field_refrence_id') }}</label><input
                                                                type="text" class="form-control" name="refrence_ids[]"
                                                                id="refrence_ids" value="{{ $refrence->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_refrence_id') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="ref_amounts"
                                                                class="form-label">{{ __('field_ref_amount') }}
                                                            </label><input type="text" class="form-control ref_amounts"
                                                                name="ref_amounts[]" id="ref_amounts"
                                                                value="{{ $refrence->ref_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_ref_amount') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="ref_dates"
                                                                class="form-label">{{ __('field_ref_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="ref_dates[]" id="ref_dates"
                                                                value="{{ $refrence->ref_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_ref_date') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="ref_names"
                                                                class="form-label">{{ __('field_ref_name') }}
                                                            </label><input type="text" class="form-control"
                                                                name="ref_names[]" id="ref_names"
                                                                value="{{ $refrence->ref_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_ref_name') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach



                                                <div id="newFieldSecond" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldSecond" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i>
                                                        {{ __('btn_add_refrences') }}</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif

                                    @if (!empty($row->cashReceived))
                                        {{-- <div>Ram</div> --}}

                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_caase_information') }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->cashReceived as $cash)
                                                    <div id="inputFormFieldcCash" class="row">
                                                        <div class="form-group col-md-4"><label for="cash_ids"
                                                                class="form-label">{{ __('field_cash_id') }}</label><input
                                                                type="text" class="form-control" name="cash_ids[]"
                                                                id="cash_ids" value="{{ $cash->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_id') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="cash_amounts"
                                                                class="form-label">{{ __('field_cash_amount') }}
                                                            </label><input type="text"
                                                                class="form-control cash_amounts" name="cash_amounts[]"
                                                                id="cash_amounts" value="{{ $cash->cash_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_amount') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="cash_dates"
                                                                class="form-label">{{ __('field_cash_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="cash_dates[]" id="cash_dates"
                                                                value="{{ $cash->cash_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_date') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="cash_names"
                                                                class="form-label">{{ __('field_cash_name') }}
                                                            </label><input type="text" class="form-control"
                                                                name="cash_names[]" id="cash_names"
                                                                value="{{ $cash->cash_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_name') }}</div>
                                                        </div>

                                                    </div>
                                                @endforeach


                                                <div id="newFieldCash" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldCash" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i> {{ __('btn_add_cash') }}</button>
                                                </div>
                                            </div>
                                        </fieldset>

                                    @endif

                                    @if (!empty($row->bankReceived))
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_bank_information') }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->bankReceived as $bank)
                                                    <div id="inputFormFieldBank" class="row">
                                                        <div class="form-group col-md-4"><label for="bank_ids"
                                                                class="form-label">{{ __('field_bank_id') }}</label><input
                                                                type="text" class="form-control" name="bank_ids[]"
                                                                id="bank_ids" value="{{ $bank->receipt_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_id') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="utr_nos"
                                                                class="form-label">{{ __('field_bank_utr_no') }}
                                                            </label><input type="text" class="form-control utr_nos"
                                                                name="utr_nos[]" id="utr_nos"
                                                                value="{{ $bank->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_utr_no') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="bank_amounts"
                                                                class="form-label">{{ __('field_bank_amount') }}
                                                            </label><input type="text"
                                                                class="form-control bank_amounts" name="bank_amounts[]"
                                                                id="bank_amounts" value="{{ $bank->bank_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_amount') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="bank_dates"
                                                                class="form-label">{{ __('field_bank_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="bank_dates[]" id="bank_dates"
                                                                value="{{ $bank->bank_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_date') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="bank_names"
                                                                class="form-label">{{ __('field_bank_names') }}
                                                            </label><input type="text" class="form-control"
                                                                name="bank_names[]" id="bank_names"
                                                                value="{{ $bank->bank_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_names') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach


                                                <div id="newFieldBank" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldBank" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif

                                    @if (!empty($row->deductions))
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ 'Any Other Deduction' }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->deductions as $deduction)
                                                    <div id="inputFormFieldDeduction" class="row">
                                                        <div class="form-group col-md-4"><label for="deduction_ids"
                                                                class="form-label">{{ __('field_deduction_id') }}</label><input
                                                                type="text" class="form-control"
                                                                name="deduction_ids[]" id="deduction_ids"
                                                                value="{{ $deduction->deduction_id }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_deduction_id') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="deduction_amounts"
                                                                class="form-label">{{ __('field_deduction_amount') }}
                                                            </label><input type="text"
                                                                class="form-control deduction_amounts"
                                                                name="deduction_amounts[]" id="deduction_amounts"
                                                                value="{{ $deduction->deduction_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_amount') }}</div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4"><label for="utr_nos"
                                                                class="form-label">{{ __('field_bank_utr_no') }}
                                                            </label><input type="text"
                                                                class="form-control utr_nos"
                                                                name="utr_nos[]" id="utr_nos"
                                                                value="{{ $deduction->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_utr_no') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="deduction_dates"
                                                                class="form-label">{{ __('field_deduction_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="deduction_dates[]" id="deduction_dates"
                                                                value="{{ $deduction->deduction_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_deduction_date') }}</div>
                                                        </div>
                                                        
                                                         <div class="form-group col-md-4"><label for="purposes"
                                                                class="form-label">{{ __('field_purpose') }}
                                                            </label><input type="text"
                                                                class="form-control purposes"
                                                                name="purposes[]" id="purposes"
                                                                value="{{ $deduction->purpose }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_purpose') }}</div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4"><label for="deduction_names"
                                                                class="form-label">{{ __('field_deduction_names') }}
                                                            </label><input type="text" class="form-control"
                                                                name="deduction_names[]" id="deduction_names"
                                                                value="{{ $deduction->deduction_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_deduction_names') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach


                                                <div id="newFieldDeduction" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldDeduction" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i>
                                                        {{ 'Add Any Other Deduction' }}</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif


                                    <fieldset class="row scheduler-border">
                                        <legend>{{ __('field_total_information') }}</legend>


                                        <div class="form-group col-md-3">
                                            <label for="RefT" class="form-label">{{ __('field_total_ref') }}
                                                <span>(REF Amount)</span></label>
                                            <input type="text" class="form-control RefT" name="RefT"
                                                id="RefT" value="{{ $row->refTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_ref') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="CashT" class="form-label">{{ __('field_total_cash') }}
                                                <span>(<span>Cash Receiveds Amount</span>)</span></label>
                                            <input type="text" class="form-control CashT" name="CashT"
                                                id="CashT" value="{{ $row->cashTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_cash') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="BankT" class="form-label">{{ __('field_total_bank') }}
                                                <span>(Bank
                                                    Received Amount)</span></label>
                                            <input type="text" class="form-control BankT" name="BankT"
                                                id="BankT" value="{{ $row->bankTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_bank') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="deductionT" class="form-label">{{ __('field_de_name') }}
                                                <span>(Any Other Deduction Amount)</span></label>
                                            <input type="text" class="form-control BankT" name="deductionT"
                                                id="deductionT" value="{{ $row->deductionTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_de_name') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label for="total_amounts"
                                                class="form-label">{{ __('field_total_information') }}
                                                <span>(<span>Cash Received Amount,</span><span>Bank Received
                                                        Amount,</span>)</span></label>
                                            <input type="text" class="form-control total_amounts" name="total_amounts"
                                                id="total_amounts" value="{{ $row->total_amounts }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_information') }}
                                            </div>


                                        </div>
                                    </fieldset>


                                    <!-- Form End--->
                                </content>

                                @if (field('application_high_school_certificate')->status == 1 ||
                                        field('application_highschool_certificate')->status == 1 ||
                                        field('application_highschool_slc')->status == 1 ||
                                        field('application_intermediate_certificate')->status == 1 ||
                                        field('application_intermediate_migration')->status == 1 ||
                                        field('application_intermadiate_certi')->status == 1 ||
                                        field('application_intermediate_clc')->status == 1 ||
                                        field('application_bachelor_certificate')->status == 1 ||
                                        field('application_graduation_migration')->status == 1 ||
                                        field('application_master_certificate')->status == 1 ||
                                        field('application_adhar_card')->status == 1 ||
                                        field('application_parents_id')->status == 1 ||
                                        field('application_pan_card')->status == 1 ||
                                        field('application_photo')->status == 1 ||
                                        field('application_signature')->status == 1)
                                    <h3>{{ __('tab_documents') }}</h3>
                                    <content class="form-step">
                                        <!-- Form Start--->
                                        <fieldset class="row scheduler-border">
                                            @if (field('student_high_school_certificate')->status == 1)
                                                @php
                                                    $file = @$row->school_transcript;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp

                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="high_school_certificate">{{ __('field_high_school_certificate') }} <span>*</span></label>
                                                    <input type="file" class="form-control"
                                                        name="high_school_certificate" id="high_school_certificate"
                                                        value="{{ old('high_school_certificate') }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_high_school_certificate') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->school_transcript))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_highschool_certificate')->status == 1)
                                                @php
                                                    $file = @$row->high_school_certificate;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp

                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="high_school_certi">{{ __('field_school_certifiate') }} <span>*</span></label>
                                                    <input type="file" class="form-control" name="high_school_certi"
                                                        id="high_school_certi" value="{{ old('high_school_certi') }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_school_certifiate') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->high_school_certificate))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif


                                            @if (field('application_highschool_slc')->status == 1)
                                                @php
                                                    $file = @$row->school_slc;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="high_school_certificate">{{ __('field_high_school_slc') }}
                                                        </label>
                                                    <input type="file" class="form-control" name="high_school_slc"
                                                        id="high_school_slc" value="{{ old('high_school_slc') }}">
                                                    {{-- required  --}}

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_high_school_slc') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->school_slc))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('student_intermediate_certificate')->status == 1)
                                                @php
                                                    $file = @$row->school_certificate;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="intermediate_certificate">{{ __('field_intermediate_school_certificate') }} <span>*</span></label>
                                                    <input type="file" class="form-control"
                                                        name="intermediate_certificate" id="intermediate_certificate"
                                                        value="{{ old('intermediate_certificate') }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_intermediate_school_certificate') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->school_certificate))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_intermediate_migration')->status == 1)
                                                @php
                                                    $file = @$row->intermediate_migration;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="intermediate_migration">{{ __('field_intermediate_school_migration') }}
                                                        <span>*</span></label>
                                                    <input type="file" class="form-control"
                                                        name="intermediate_migration" id="intermediate_migration"
                                                        value="{{ old('intermediate_migration') }}" required>
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_intermediate_school_migration') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->intermediate_migration))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_intermadiate_certi')->status == 1)
                                                @php
                                                    $file = @$row->intermediate_certificate;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="intermediate_certi">{{ __('field_intermediate_certifiate') }}
                                                        <span>*</span></label>
                                                    <input type="file" class="form-control" name="intermediate_certi"
                                                        id="intermediate_certi" value="{{ old('intermediate_certi') }}" required>
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_intermediate_certifiate') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->intermediate_certificate))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_intermediate_clc')->status == 1)
                                                @php
                                                    $file = @$row->intermediate_clc;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="intermediate_clc">{{ __('field_intermediate_school_clc') }}
                                                        <span>*</span></label>
                                                    <input type="file" class="form-control" name="intermediate_clc"
                                                        id="intermediate_clc" value="{{ old('intermediate_clc') }}" required>
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_intermediate_school_clc') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->intermediate_clc))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif






                                            @if (field('student_bachelor_collage_certificate')->status == 1)
                                                @php
                                                    $file = @$row->collage_transcript;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="bachelor_certificate">{{ __('field_graduation_certificate') }}</label>
                                                    <input type="file" class="form-control"
                                                        name="bachelor_certificate" id="bachelor_certificate"
                                                        value="{{ old('bachelor_certificate') }}">

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_graduation_certificate') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->collage_transcript))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_graduation_migration')->status == 1)
                                                @php
                                                    $file = @$row->collage_migration;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="graduation_migration">{{ __('field_graduation_migration') }}</label>
                                                    <input type="file" class="form-control"
                                                        name="graduation_migration" id="graduation_migration"
                                                        value="{{ old('graduation_migration') }}">

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_graduation_migration') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->collage_migration))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('student_master_collage_certificate')->status == 1)
                                                @php
                                                    $file = @$row->collage_certificate;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label
                                                        for="master_certificate">{{ __('field_graduation_clc') }}</label>
                                                    <input type="file" class="form-control"
                                                        name="master_certificate" id="master_certificate"
                                                        value="{{ old('master_certificate') }}">

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }}
                                                        {{ __('field_graduation_clc') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->collage_certificate))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif


                                            @if (field('application_adhar_card')->status == 1)
                                                @php
                                                    $file = @$row->adhar_card;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label for="adhar_card">{{ __('field_adhar_card') }}:
                                                        <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                        <span>*</span>
                                                    </label>
                                                    <input type="file" class="form-control" name="adhar_card"
                                                        id="adhar_card" value="{{ old('adhar_card') }}" required>
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_adhar_card') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->adhar_card))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_parents_id')->status == 1)
                                                @php
                                                    $file = @$row->parents_id;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label for="parents_id">{{ __('field_parents_id') }}:
                                                        <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                        <!--<span>*</span>-->
                                                    </label>
                                                    <input type="file" class="form-control" name="parents_id"
                                                        id="parents_id" value="{{ old('parents_id') }}" >
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_parents_id') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->parents_id))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_pan_card')->status == 1)
                                                @php
                                                    $file = @$row->pan_card;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label for="pan_card">{{ __('field_pan_card') }}:
                                                        <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                        <!--<span>*</span>-->
                                                    </label>
                                                    <input type="file" class="form-control" name="pan_card"
                                                        id="pan_card" value="{{ old('pan_card') }}">
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_pan_card') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->pan_card))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('application_pan_card')->status == 1)
                                                @php
                                                    $file = @$row->domicile;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label for="domicile">{{ __('field_domicile') }}:
                                                        <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                        <span>*</span>
                                                    </label>
                                                    <input type="file" class="form-control" name="domicile"
                                                        id="domicile" value="{{ old('domicile') }}" required>
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_domicile') }}
                                                    </div>
                                                    @if (is_file('uploads/' . $path . '/' . $row->domicile))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif


                                                </div>
                                            @endif

                                            @if (field('application_pan_card')->status == 1)
                                                @php
                                                    $file = @$row->cast_certificate;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp

                                                <div class="form-group col-md-6">
                                                    <label for="cast_certificate">{{ __('field_cast_certificate') }}:
                                                        <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                        <span>*</span>
                                                    </label>
                                                    <input type="file" class="form-control" name="cast_certificate"
                                                        id="cast_certificate" value="{{ old('cast_certificate') }}" required>
                                                    {{-- required  --}}
                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_cast_certificate') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->cast_certificate))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>

                                            @endif

                                            @if (field('student_photo')->status == 1)
                                                @php
                                                    $file = @$row->photo;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label for="photo">{{ __('field_photo') }}:
                                                        <span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span> <span>*</span></label>
                                                    <input type="file" class="form-control" name="photo"
                                                        id="photo" value="{{ old('photo') }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_photo') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->photo))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                            @if (field('student_signature')->status == 1)

                                                @php
                                                    $file = @$row->signature;
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $fileUrl = asset('uploads/student/' . $file);
                                                @endphp
                                                <div class="form-group col-md-6">
                                                    <label for="signature">{{ __('field_signature') }}:
                                                        <span>{{ __('image_size', ['height' => 100, 'width' => 300]) }}</span> <span>*</span></label>
                                                    <input type="file" class="form-control" name="signature"
                                                        id="signature" value="{{ old('signature') }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_signature') }}
                                                    </div>

                                                    @if (is_file('uploads/' . $path . '/' . $row->signature))
                                                        @if (strtolower($extension) === 'pdf')
                                                            <iframe src="{{ $fileUrl }}"
                                                                class="img-fluid"></iframe>
                                                        @else
                                                            <img src="{{ $fileUrl }}" class="img-fluid" />
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif
                                        </fieldset>

                                        <fieldset class="row scheduler-border">
                                            <legend>{{ 'DRCC-admitted students' }}</legend>




                                            <div class="form-group col-md-6">
                                                <label for="bonafide_certificate">{{ 'Bonafide Certificate' }}
                                                    </label>
                                                <input type="file" class="form-control" name="bonafide_certificate"
                                                    id="bonafide_certificate"
                                                    value="{{ old('bonafide_certificate') }}">


                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'Bonafide Certificate' }}
                                                </div>

                                                @if (is_file('uploads/' . $path . '/' . $row->bonafide_certificate))
                                                    @php
                                                        $file = @$row->bonafide_certificate;
                                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                        $fileUrl = asset('uploads/student/' . $file);
                                                    @endphp
                                                    @if (strtolower($extension) === 'pdf')
                                                        <iframe src="{{ $fileUrl }}" class="img-fluid"></iframe>
                                                    @else
                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                    @endif
                                                @endif
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="drcc_receiving">{{ 'DRCC receiving' }}
                                                   </label>
                                                <input type="file" class="form-control" name="drcc_receiving"
                                                    id="drcc_receiving" value="{{ old('drcc_receiving') }}">
                                                {{-- required  --}}
                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'DRCC receiving' }}
                                                </div>

                                                @if (is_file('uploads/' . $path . '/' . $row->drcc_receiving))
                                                    @php
                                                        $file = @$row->drcc_receiving;
                                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                        $fileUrl = asset('uploads/student/' . $file);
                                                    @endphp
                                                    @if (strtolower($extension) === 'pdf')
                                                        <iframe src="{{ $fileUrl }}" class="img-fluid"></iframe>
                                                    @else
                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="tpva_form">{{ 'TPVA Form' }}</label>
                                                <input type="file" class="form-control" name="tpva_form"
                                                    id="tpva_form" value="{{ old('tpva_form') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'TPVA Form' }}
                                                </div>
                                                @if (is_file('uploads/' . $path . '/' . $row->tpva_form))
                                                    @php
                                                        $file = @$row->tpva_form;
                                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                        $fileUrl = asset('uploads/student/' . $file);
                                                    @endphp
                                                    @if (strtolower($extension) === 'pdf')
                                                        <iframe src="{{ $fileUrl }}" class="img-fluid"></iframe>
                                                    @else
                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="drcc_selection_letter">{{ 'DRCC selection letter/agreement' }}</label>
                                                <input type="file" class="form-control"
                                                    name="drcc_selection_letter" id="drcc_selection_letter"
                                                    value="{{ old('drcc_selection_letter') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'DRCC selection letter/agreement' }}
                                                </div>
                                                @if (is_file('uploads/' . $path . '/' . $row->drcc_selection_letter))
                                                    @php
                                                        $file = @$row->drcc_selection_letter;
                                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                        $fileUrl = asset('uploads/student/' . $file);
                                                    @endphp
                                                    @if (strtolower($extension) === 'pdf')
                                                        <iframe src="{{ $fileUrl }}" class="img-fluid"></iframe>
                                                    @else
                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                    @endif
                                                @endif
                                            </div>



                                        </fieldset>

                                        @if (field('student_documents')->status == 1)
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('field_title') }}</th>
                                                        <th>{{ __('field_document') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($row->documents as $document)
                                                        <tr>
                                                            <td>{{ $document->title }}</td>
                                                            <td>
                                                                @if (is_file('uploads/' . $path . '/' . $document->attach))
                                                                    <a href="{{ asset('uploads/' . $path . '/' . $document->attach) }}"
                                                                        class="btn btn-sm btn-icon btn-dark" download><i
                                                                            class="fas fa-download"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <fieldset class="row scheduler-border">
                                                <legend>{{ __('field_upload') }} {{ __('field_document') }}</legend>
                                                <div class="container-fluid">
                                                    <div id="newDocument" class="clearfix"></div>
                                                    <div class="form-group">
                                                        <button id="addDocument" type="button"
                                                            class="btn btn-info"><i class="fas fa-plus"></i>
                                                            {{ __('btn_add_new') }}</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        @endif
                                        <!-- Form End--->
                                    </content>
                                @endif

                                <h3>{{ __('tab_university_data') }}</h3>
                                <content class="form-step">
                                    <!-- Form Start--->

                                    @if ($row->program->id == @$programCondition->bsc_nursing_id)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ 'Documents of B.SC Nursing Student' }}</legend>

                                            <div class="container-fluid">
                                                @foreach ($row->nursingData as $nursing)
                                                    <div id="FieldWrapper_bsc_nursing_group" class="row">
                                                        {{-- 🔑 VERY IMPORTANT: Nursing Row ID --}}
                                                        <input type="hidden" name="nursing_ids[]"
                                                            value="{{ $nursing->id }}">

                                                        <div class="form-group col-md-6">
                                                            <label>Semester <span>*</span></label>
                                                            <select class="form-control" name="nursing_years[]">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    @if ($nursing->year == 1) selected @endif>1st
                                                                    Semester</option>
                                                                <option value="2"
                                                                    @if ($nursing->year == 2) selected @endif>2nd
                                                                    Semester</option>
                                                                <option value="3"
                                                                    @if ($nursing->year == 3) selected @endif>3rd
                                                                    Semester</option>
                                                                <option value="4"
                                                                    @if ($nursing->year == 4) selected @endif>4th
                                                                    Semester</option>
                                                                <option value="5"
                                                                    @if ($nursing->year == 5) selected @endif>5th
                                                                    Semester</option>
                                                                <option value="6"
                                                                    @if ($nursing->year == 6) selected @endif>6th
                                                                    Semester</option>
                                                                <option value="7"
                                                                    @if ($nursing->year == 7) selected @endif>7th
                                                                   Semester</option>
                                                                <option value="8"
                                                                    @if ($nursing->year == 8) selected @endif>8th
                                                                    Semester</option>
                                                            </select>
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                            </div>
                                                        </div>


                                                        @if ($nursing->marksheet)
                                                            @php
                                                                $file = @$nursing->marksheet;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp


                                                            <div class="form-group col-md-6">
                                                                <label>Semester Marksheet <span>*</span></label>
                                                                <input type="file" class="form-control"
                                                                    name="nursing_semester_marksheets[]"
                                                                    value="{{ $nursing->marksheet }}">
                                                                <div class="invalid-feedback">
                                                                    {{ __('required_field') }}
                                                                    {{ __('field_semester_marksheet') }}
                                                                </div>

                                                                <input type="hidden"
                                                                    name="old_nursing_semester_marksheets[]"
                                                                    value="{{ $nursing->marksheet }}">

                                                                @if (is_file('uploads/' . $path . '/' . $nursing->marksheet))
                                                                    @if (strtolower($extension) === 'pdf')
                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}"
                                                                            class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif




                                                        @if ($nursing->admit_card)
                                                            @php
                                                                $file = @$nursing->admit_card;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp
                                                            <div class="form-group col-md-6">
                                                                <label>Admit Card</label>
                                                                <input type="file" class="form-control"
                                                                    name="nursing_admit_cards[]"
                                                                    value="{{ $nursing->admit_card }}">

                                                                <input type="hidden" name="old_nursing_admit_cards[]"
                                                                    value="{{ $nursing->admit_card }}">

                                                                @if (is_file('uploads/' . $path . '/' . $nursing->admit_card))
                                                                    @if (strtolower($extension) === 'pdf')
                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}"
                                                                            class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                    </div>
                                                @endforeach


                                                <div id="add_FieldWrapper_bsc_nursing"></div>


                                                <div class="form-group">
                                                    <button type="button" class="btn btn-info addNursingField"
                                                        data-course="bsc_nursing">
                                                        <i class="fas fa-plus"></i> Add
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label
                                                    for="course_completation_certificate">{{ 'Course Completation Certificate' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control"
                                                    name="course_completation_certificate"
                                                    id="course_completation_certificate"
                                                    value="{{ old('course_completation_certificate') }}">
                                                {{-- required  --}}

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'Course Completation Certificate' }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="clc">{{ 'CLC' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control" name="clc"
                                                    id="clc" value="{{ old('clc') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'CLC' }}
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="character_certificate">{{ 'Character Certificate' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control"
                                                    name="character_certificate" id="character_certificate"
                                                    value="{{ old('character_certificate') }}">
                                                {{-- required  --}}
                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'Character Certificate' }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="provisional_certificate">{{ __('feild_provisional_certificate') }}</label>
                                                <input type="file" class="form-control"
                                                    name="provisional_certificate" id="provisional_certificate"
                                                    value="{{ old('provisional_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_provisional_certificate') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="degree_certificate">{{ __('feild_degree_certificate') }}</label>
                                                <input type="file" class="form-control" name="degree_certificate"
                                                    id="degree_certificate" value="{{ old('degree_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_degree_certificate') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="registration_certificate">{{ __('field_registration_certificate') }}:

                                                </label>
                                                <input type="file" class="form-control"
                                                    name="registration_certificate" id="registration_certificate"
                                                    value="{{ old('registration_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_registration_certificate') }}
                                                </div>
                                            </div>

                                        </fieldset>

                                    @endif


                                    @if ($row->program->id == @$programCondition->gnm_id)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ 'Documents of Gnm Student' }}</legend>

                                            <div class="container-fluid">
                                                @foreach ($row->gnmData as $gnm)
                                                    <div id="FieldWrapper_Gnm_group" class="row">

                                                        <input type="hidden" name="gnm_ids[]"
                                                            value="{{ $gnm->id }}">
                                                        <div class="form-group col-md-6">
                                                            <label>Year <span>*</span></label>
                                                            <select class="form-control" name="gnm_years[]">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    @if ($gnm->year == 1) selected @endif>1st
                                                                    Year</option>
                                                                <option value="2"
                                                                    @if ($gnm->year == 2) selected @endif>2nd
                                                                    Year</option>
                                                                <option value="3"
                                                                    @if ($gnm->year == 3) selected @endif>3rd
                                                                    Year</option>
                                                                <option value="4"
                                                                    @if ($gnm->year == 4) selected @endif>4th
                                                                    Year</option>
                                                                <option value="5"
                                                                    @if ($gnm->year == 5) selected @endif>5th
                                                                    Year</option>
                                                                <option value="6"
                                                                    @if ($gnm->year == 6) selected @endif>6th
                                                                    Year</option>
                                                                <option value="7"
                                                                    @if ($gnm->year == 7) selected @endif>7th
                                                                    Year</option>
                                                                <option value="8"
                                                                    @if ($gnm->year == 8) selected @endif>8th
                                                                    Year</option>
                                                            </select>
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                            </div>
                                                        </div>


                                                        @if ($gnm->marksheet)
                                                            @php
                                                                $file = @$gnm->marksheet;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp


                                                            <div class="form-group col-md-6">
                                                                <label>Semester Marksheet <span>*</span></label>
                                                                <input type="file" class="form-control"
                                                                    name="gnm_marksheets[]"
                                                                    value="{{ $gnm->marksheet }}">
                                                                <div class="invalid-feedback">
                                                                    {{ __('required_field') }}
                                                                    {{ __('field_semester_marksheet') }}
                                                                </div>

                                                                <input type="hidden" name="old_gnm_marksheets[]"
                                                                    value="{{ $gnm->marksheet }}">

                                                                @if (is_file('uploads/' . $path . '/' . $gnm->marksheet))
                                                                    @if (strtolower($extension) === 'pdf')
                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}"
                                                                            class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif






                                                        @if ($gnm->admit_card)
                                                            @php
                                                                $file = @$gnm->admit_card;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp
                                                            <div class="form-group col-md-6">
                                                                <label>Admit Card</label>
                                                                <input type="file" class="form-control"
                                                                    name="gnm_admit_cards[]"
                                                                    value="{{ $gnm->admit_card }}">

                                                                <input type="hidden" name="old_gnm_admit_cards[]"
                                                                    value="{{ $gnm->admit_card }}">
                                                                @if (is_file('uploads/' . $path . '/' . $gnm->admit_card))
                                                                    @if (strtolower($extension) === 'pdf')
                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}"
                                                                            class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif







                                                    </div>
                                                @endforeach

                                                <div id="add_FieldWrapper_Gnm"></div>


                                                <div class="form-group">
                                                    <button type="button" class="btn btn-info addGnmField"
                                                        data-course="bsc_gnm">
                                                        <i class="fas fa-plus"></i> Add
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label
                                                    for="course_completation_certificate">{{ 'Course Completation Certificate' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control"
                                                    name="course_completation_certificate"
                                                    id="course_completation_certificate"
                                                    value="{{ old('course_completation_certificate') }}">
                                                {{-- required  --}}

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'Course Completation Certificate' }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="clc">{{ 'CLC' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control" name="clc"
                                                    id="clc" value="{{ old('clc') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'CLC' }}
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="charactor_certificate">{{ 'Character Certificate' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control"
                                                    name="charactor_certificate" id="charactor_certificate"
                                                    value="{{ old('charactor_certificate') }}">
                                                {{-- required  --}}
                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'Charactor Certificate' }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="provisional_certificate">{{ __('feild_provisional_certificate') }}</label>
                                                <input type="file" class="form-control"
                                                    name="provisional_certificate" id="provisional_certificate"
                                                    value="{{ old('provisional_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_provisional_certificate') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="degree_certificate">{{ __('feild_degree_certificate') }}</label>
                                                <input type="file" class="form-control" name="degree_certificate"
                                                    id="degree_certificate" value="{{ old('degree_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_degree_certificate') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label
                                                    for="diploma_certificate">{{ __('feild_diploma_certificate') }}</label>
                                                <input type="file" class="form-control" name="diploma_certificate"
                                                    id="diploma_certificate" value="{{ old('diploma_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_diploma_certificate') }}
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label
                                                    for="internship_certificate">{{ __('feild_internship_certificate') }}</label>
                                                <input type="file" class="form-control"
                                                    name="internship_certificate" id="internship_certificate"
                                                    value="{{ old('internship_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_internship_certificate') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="registration_certificate">{{ __('field_registration_certificate') }}:
                                                    <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                    <!--<span>*</span>-->
                                                </label>
                                                <input type="file" class="form-control"
                                                    name="registration_certificate" id="registration_certificate"
                                                    value="{{ old('registration_certificate') }}">
                                                {{-- required  --}}
                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_registration_certificate') }}
                                                </div>
                                            </div>

                                        </fieldset>
                                    @endif



                                    @if ($row->program->id == @$programCondition->anm_id)
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ 'Documents of Anm Student' }}</legend>

                                            <div class="container-fluid">

                                                @foreach ($row->anmData as $anm)
                                                    <div id="FieldWrapper_Anm_group" class="row">
                                                        <input type="hidden" name="anm_ids[]"
                                                            value="{{ $anm->id }}">

                                                        <div class="form-group col-md-6">
                                                            <label>Year <span>*</span></label>
                                                            <select class="form-control" name="anm_years[]">
                                                                <option value="">Select</option>
                                                                <option value="1"
                                                                    @if ($anm->year == 1) selected @endif>1st
                                                                    Year</option>
                                                                <option value="2"
                                                                    @if ($anm->year == 2) selected @endif>2nd
                                                                    Year</option>
                                                                <option value="3"
                                                                    @if ($anm->year == 3) selected @endif>3rd
                                                                    Year</option>
                                                                <option value="4"
                                                                    @if ($anm->year == 4) selected @endif>4th
                                                                    Year</option>
                                                                <option value="5"
                                                                    @if ($anm->year == 5) selected @endif>5th
                                                                    Year</option>
                                                                <option value="6"
                                                                    @if ($anm->year == 6) selected @endif>6th
                                                                    Year</option>
                                                                <option value="7"
                                                                    @if ($anm->year == 7) selected @endif>7th
                                                                    Year</option>
                                                                <option value="8"
                                                                    @if ($anm->year == 8) selected @endif>8th
                                                                    Year</option>
                                                            </select>
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                            </div>
                                                        </div>



                                                        @if ($anm->marksheet)
                                                            @php
                                                                $file = @$anm->marksheet;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp


                                                            <div class="form-group col-md-6">
                                                                <label>Semester Marksheet <span>*</span></label>
                                                                <input type="file" class="form-control"
                                                                    name="anm_marksheets[]"
                                                                    value="{{ $anm->marksheet }}">
                                                                <div class="invalid-feedback">
                                                                    {{ __('required_field') }}
                                                                    {{ __('field_semester_marksheet') }}
                                                                </div>

                                                                <input type="hidden" name="old_anm_marksheets[]"
                                                                    value="{{ $anm->marksheet }}">

                                                                @if (is_file('uploads/' . $path . '/' . $anm->marksheet))
                                                                    @if (strtolower($extension) === 'pdf')
                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}"
                                                                            class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif






                                                        @if ($anm->admit_card)
                                                            @php
                                                                $file = @$anm->admit_card;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp
                                                            <div class="form-group col-md-6">
                                                                <label>Admit Card</label>
                                                                <input type="file" class="form-control"
                                                                    name="anm_admit_cards[]"
                                                                    value="{{ $anm->admit_card }}">

                                                                <input type="hidden" name="old_anm_admit_cards[]"
                                                                    value="{{ $anm->admit_card }}">
                                                                @if (is_file('uploads/' . $path . '/' . $anm->admit_card))
                                                                    @if (strtolower($extension) === 'pdf')
                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}"
                                                                            class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif


                                                        <div class="form-group col-md-6">
                                                            <label>Marksheet <span>*</span></label>
                                                            <input type="file" class="form-control"
                                                                name="anm_marksheets[]" value="{{ $anm->marksheet }}">
                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }}
                                                                {{ __('field_semester_marksheet') }}
                                                            </div>
                                                        </div>



                                                        <div class="form-group col-md-6">
                                                            <label>Admit Card</label>
                                                            <input type="file" class="form-control"
                                                                name="anm_admit_cards[]"
                                                                value="{{ $anm->admit_card }}">
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div id="add_FieldWrapper_Anm"></div>


                                                <div class="form-group">
                                                    <button type="button" class="btn btn-info addAnmField"
                                                        data-course="anm">

                                                        <i class="fas fa-plus"></i> Add
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label
                                                    for="course_completation_certificate">{{ 'Course Completation Certificate' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control"
                                                    name="course_completation_certificate"
                                                    id="course_completation_certificate"
                                                    value="{{ old('course_completation_certificate') }}">
                                                {{-- required  --}}

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'Course Completation Certificate' }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="clc">{{ 'CLC' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control" name="clc"
                                                    id="clc" value="{{ old('clc') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'CLC' }}
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="charactor_certificate">{{ 'Character Certificate' }}
                                                    <span>*</span></label>
                                                <input type="file" class="form-control"
                                                    name="charactor_certificate" id="charactor_certificate"
                                                    value="{{ old('charactor_certificate') }}">
                                                {{-- required  --}}
                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ 'Charactor Certificate' }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="provisional_certificate">{{ __('feild_provisional_certificate') }}</label>
                                                <input type="file" class="form-control"
                                                    name="provisional_certificate" id="provisional_certificate"
                                                    value="{{ old('provisional_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_provisional_certificate') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="degree_certificate">{{ __('feild_degree_certificate') }}</label>
                                                <input type="file" class="form-control" name="degree_certificate"
                                                    id="degree_certificate" value="{{ old('degree_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_degree_certificate') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="diploma_certificate">{{ __('feild_diploma_certificate') }}</label>
                                                <input type="file" class="form-control" name="diploma_certificate"
                                                    id="diploma_certificate" value="{{ old('diploma_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_diploma_certificate') }}
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label
                                                    for="internship_certificate">{{ __('feild_internship_certificate') }}</label>
                                                <input type="file" class="form-control"
                                                    name="internship_certificate" id="internship_certificate"
                                                    value="{{ old('internship_certificate') }}">

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('feild_internship_certificate') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label
                                                    for="registration_certificate">{{ __('field_registration_certificate') }}:
                                                    <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                    <!--<span>*</span>-->
                                                </label>
                                                <input type="file" class="form-control"
                                                    name="registration_certificate" id="registration_certificate"
                                                    value="{{ old('registration_certificate') }}">
                                                {{-- required  --}}
                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }}
                                                    {{ __('field_registration_certificate') }}
                                                </div>
                                            </div>

                                        </fieldset>
                                    @endif


                                    <!-- Form End--->
                                </content>

                            </form>
                        </div>

                    </div>
                </div>
                <!-- [ Card ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection

@section('page_js')
    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <!-- Wizard Js -->
    <script src="{{ asset('dashboard/js/pages/jquery.steps.js') }}"></script>

    <script type="text/javascript">
        "use strict";
        var form = $("#wizard-advanced-form").show();

        form.steps({
            headerTag: "h3",
            bodyTag: "content",
            transitionEffect: "slideLeft",
            labels: {
                finish: "{{ __('btn_finish') }}",
                next: "{{ __('btn_next') }}",
                previous: "{{ __('btn_previous') }}",
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {

            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                $("#wizard-advanced-form").submit();
            }
        }).validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {

            }
        });
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addField', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormField" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="relation" class="form-label">{{ __('field_relation') }} </label><input type="text" class="form-control" name="relations[]" id="relation" value="{{ old('relation') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_relation') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="relative_name" class="form-label">{{ __('field_name') }} </label><input type="text" class="form-control" name="relative_names[]" id="relative_name" value="{{ old('relative_name') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_name') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="occupation" class="form-label">{{ __('field_occupation') }} </label><input type="text" class="form-control" name="occupations[]" id="occupation" value="{{ old('occupation') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_occupation') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="relative_phone" class="form-label">{{ __('field_phone') }} </label><input type="text" class="form-control" name="relative_phones[]" id="relative_phone" value="{{ old('relative_phone') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_phone') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="address" class="form-label">{{ __('field_address') }} </label><input type="text" class="form-control" name="addresses[]" id="address" value="{{ old('address') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_address') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><button id="removeField" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newField').append(html);
            });

            // remove Field
            $(document).on('click', '#removeField', function() {
                $(this).closest('#inputFormField').remove();
            });
        }(jQuery));
    </script>



    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldSecond', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldSecond" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="refrence_ids" class="form-label">{{ __('field_refrence_id') }}</label><input type="text" class="form-control" name="refrence_ids[]" id="refrence_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_refrence_id') }}</div></div>';

                html +=
                    '<div class="form-group col-md-4"><label for="ref_amounts" class="form-label">{{ __('field_ref_amount') }} </label><input type="text" class="form-control ref_amounts" name="ref_amounts[]" id="ref_amounts" value="" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_ref_amount') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="ref_dates" class="form-label">{{ __('field_ref_date') }} </label><input type="date" class="form-control date" name="ref_dates[]" id="ref_dates" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_ref_date') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="ref_names" class="form-label">{{ __('field_ref_name') }} </label><input type="text" class="form-control" name="ref_names[]" id="ref_names" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_ref_name') }}</div></div>';

                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldSecond" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldSecond').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldSecond', function() {
                $(this).closest('#inputFormFieldSecond').remove();
            });
        }(jQuery));
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldCash', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldcCash" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_ids" class="form-label">{{ __('field_cash_id') }}</label><input type="text" class="form-control" name="cash_ids[]" id="cash_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_id') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_amounts" class="form-label">{{ __('field_cash_amount') }} </label><input type="text" class="form-control cash_amounts" name="cash_amounts[]" id="cash_amounts" value="" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_amount') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_dates" class="form-label">{{ __('field_cash_date') }} </label><input type="date" class="form-control date" name="cash_dates[]" id="cash_dates" value="" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_date') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_names" class="form-label">{{ __('field_cash_name') }} </label><input type="text" class="form-control" name="cash_names[]" id="cash_names" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_name') }}</div></div>';


                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldCash" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldCash').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldCash', function() {
                $(this).closest('#inputFormFieldcCash').remove();
            });
        }(jQuery));
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldBank', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldBank" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_ids" class="form-label">{{ __('field_bank_id') }}</label><input type="text" class="form-control" name="bank_ids[]" id="bank_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_id') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="utr_nos" class="form-label">{{ __('field_bank_utr_no') }} </label><input type="text" class="form-control utr_nos" name="utr_nos[]" id="utr_nos" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_utr_no') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_amounts" class="form-label">{{ __('field_bank_amount') }} </label><input type="text" class="form-control bank_amounts" name="bank_amounts[]" id="bank_amounts" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_amount') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_dates" class="form-label">{{ __('field_bank_date') }} </label><input type="date" class="form-control date" name="bank_dates[]" id="bank_dates" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_date') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_names" class="form-label">{{ __('field_bank_names') }} </label><input type="text" class="form-control" name="bank_names[]" id="bank_names" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_names') }}</div></div>';


                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldBank" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldBank').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldBank', function() {
                $(this).closest('#inputFormFieldBank').remove();
            });
        }(jQuery));
    </script>



    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldDeduction', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldDeduction" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_ids" class="form-label">{{ __('field_deduction_id') }}</label><input type="text" class="form-control" name="deduction_ids[]" id="deduction_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_id') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_amounts" class="form-label">{{ __('field_deduction_amount') }} </label><input type="text" class="form-control deduction_amounts" name="deduction_amounts[]" id="deduction_amounts" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_amount') }}</div></div>';
                
                html +=
                    '<div class="form-group col-md-4"><label for="utr_nos" class="form-label">{{ __('field_bank_utr_no') }} </label><input type="text" class="form-control utr_nos" name="utr_nos[]" id="utr_nos" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_utr_no') }}</div></div>';  
                    
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_dates" class="form-label">{{ __('field_deduction_date') }} </label><input type="date" class="form-control date" name="deduction_dates[]" id="deduction_dates" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_date') }}</div></div>';
                
                html +=
                    '<div class="form-group col-md-4"><label for="purposes" class="form-label">{{ __('field_purpose') }} </label><input type="text" class="form-control purposes" name="purposes[]" id="purposes" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_purpose') }}</div></div>'; 
                        
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_names" class="form-label">{{ __('field_deduction_names') }} </label><input type="text" class="form-control" name="deduction_names[]" id="deduction_names" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_names') }}</div></div>';


                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldDeduction" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldDeduction').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldDeduction', function() {
                $(this).closest('#inputFormFieldDeduction').remove();
            });
        }(jQuery));
    </script>







    <script type="text/javascript">
        (function($) {
            "use strict";

            // ADD SEMESTER FIELD (BSc Nursing)
            $(document).on('click', '.addNursingField', function() {

                let html = '';
                html += '<hr>';
                html += '<div class="row FieldWrapper_bsc_nursing_group">';

                // Semester
                html += `
        <div class="form-group col-md-6">
             <label>Semester <span>*</span></label>
                                                        <select class="form-control" name="nursing_years[]"
                                                            >
                                                            <option value="">Select</option>
                                                            <option value="1">1st Semester</option>
                                                            <option value="2">2nd Semester</option>
                                                            <option value="3">3rd Semester</option>
                                                            <option value="4">4th Semester</option>
                                                            <option value="5">5th Semester</option>
                                                            <option value="6">6th Semester</option>
                                                            <option value="7">7th Semester</option>
                                                            <option value="8">8th Semester</option>
                                                        </select>
            <div class="invalid-feedback">{{ __('required_field') }}</div>
        </div>`;

                // Marksheet
                html += `
        <div class="form-group col-md-6">
            <label>Semester Marksheet <span>*</span></label>
            <input type="file"
                class="form-control"
                name="nursing_semester_marksheets[]">
            <div class="invalid-feedback">
                {{ __('required_field') }} {{ __('field_semester_marksheet') }}
            </div>
        </div>`;

                // Admit Card
                html += `
        <div class="form-group col-md-6">
            <label>Admit Card</label>
            <input type="file"
                class="form-control"
                name="nursing_admit_cards[]">
        </div>`;

                // Remove Button
                html += `
        <div class="form-group col-md-12">
            <button type="button"
                class="btn btn-danger removeNursingField">
                <i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}
            </button>
        </div>`;

                html += '</div>';

                // ✅ CORRECT WRAPPER
                $('#add_FieldWrapper_bsc_nursing').append(html);
            });

            // REMOVE FIELD
            $(document).on('click', '.removeNursingField', function() {
                $(this).closest('.FieldWrapper_bsc_nursing_group').remove();
            });

        })(jQuery);
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";

            // ADD SEMESTER FIELD (BSc Nursing)
            $(document).on('click', '.addGnmField', function() {

                let html = '';
                html += '<hr>';
                html += '<div class="row FieldWrapper_Gnm_group">';

                // Semester
                html += `
        <div class="form-group col-md-6">
             <label>Year <span>*</span></label>
                                                        <select class="form-control" name="gnm_years[]"
                                                            >
                                                            <option value="">Select</option>
                                                            <option value="1">1st Year</option>
                                                            <option value="2">2nd Year</option>
                                                            <option value="3">3rd Year</option>
                                                            <option value="4">4th Year</option>
                                                            <option value="5">5th Year</option>
                                                            <option value="6">6th Year</option>
                                                            <option value="7">7th Year</option>
                                                            <option value="8">8th Year</option>
                                                        </select>
            <div class="invalid-feedback">{{ __('required_field') }}</div>
        </div>`;

                // Marksheet
                html += `
        <div class="form-group col-md-6">
            <label>Marksheet <span>*</span></label>
            <input type="file"
                class="form-control"
                name="gnm_marksheets[]">
            <div class="invalid-feedback">
                {{ __('required_field') }} {{ __('field_semester_marksheet') }}
            </div>
        </div>`;

                // Admit Card
                html += `
        <div class="form-group col-md-6">
            <label>Admit Card</label>
            <input type="file"
                class="form-control"
                name="gnm_admit_cards[]">
        </div>`;

                // Remove Button
                html += `
        <div class="form-group col-md-12">
            <button type="button"
                class="btn btn-danger removeGnmField">
                <i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}
            </button>
        </div>`;

                html += '</div>';

                // ✅ CORRECT WRAPPER
                $('#add_FieldWrapper_Gnm').append(html);
            });

            // REMOVE FIELD
            $(document).on('click', '.removeGnmField', function() {
                $(this).closest('.FieldWrapper_Gnm_group').remove();
            });

        })(jQuery);
    </script>


    <script type="text/javascript">
        (function($) {
            "use strict";

            // ADD SEMESTER FIELD (BSc Nursing)
            $(document).on('click', '.addAnmField', function() {

                let html = '';
                html += '<hr>';
                html += '<div class="row FieldWrapper_Anm_group">';

                // Semester
                html += `
        <div class="form-group col-md-6">
             <label>Year <span>*</span></label>
                                                        <select class="form-control" name="anm_years[]"
                                                            >
                                                            <option value="">Select</option>
                                                            <option value="1">1st Year</option>
                                                            <option value="2">2nd Year</option>
                                                            <option value="3">3rd Year</option>
                                                            <option value="4">4th Year</option>
                                                            <option value="5">5th Year</option>
                                                            <option value="6">6th Year</option>
                                                            <option value="7">7th Year</option>
                                                            <option value="8">8th Year</option>
                                                        </select>
            <div class="invalid-feedback">{{ __('required_field') }}</div>
        </div>`;

                // Marksheet
                html += `
        <div class="form-group col-md-6">
            <label>Marksheet <span>*</span></label>
            <input type="file"
                class="form-control"
                name="anm_marksheets[]">
            <div class="invalid-feedback">
                {{ __('required_field') }} {{ __('field_semester_marksheet') }}
            </div>
        </div>`;

                // Admit Card
                html += `
        <div class="form-group col-md-6">
            <label>Admit Card</label>
            <input type="file"
                class="form-control"
                name="anm_admit_cards[]">
        </div>`;

                // Remove Button
                html += `
        <div class="form-group col-md-12">
            <button type="button"
                class="btn btn-danger removeAnmField">
                <i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}
            </button>
        </div>`;

                html += '</div>';

                // ✅ CORRECT WRAPPER
                $('#add_FieldWrapper_Anm').append(html);
            });

            // REMOVE FIELD
            $(document).on('click', '.removeAnmField', function() {
                $(this).closest('.FieldWrapper_Anm_group').remove();
            });

        })(jQuery);
    </script>


    <script>
        function calculateTotal() {
            let refTotal = 0;
            let cashTotal = 0;
            let bankTotal = 0;
            let reductionTotal = 0;

            document.querySelectorAll('.ref_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                refTotal += value;
            });

            document.querySelectorAll('.cash_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                cashTotal += value;
            });

            document.querySelectorAll('.bank_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                bankTotal += value;
            });

            document.querySelectorAll('.deduction_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                reductionTotal += value;
            });

            let grandTotal = cashTotal + bankTotal;
            document.getElementById('RefT').value = refTotal.toFixed(2);
            document.getElementById('CashT').value = cashTotal.toFixed(2);
            document.getElementById('BankT').value = bankTotal.toFixed(2);
            document.getElementById('deductionT').value = reductionTotal.toFixed(2);

            document.getElementById('total_amounts').value = grandTotal.toFixed(2);
        }

        // Jab bhi amount me kuch type karo to calculate karo
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('ref_amounts') || e.target.classList.contains('cash_amounts') || e
                .target.classList.contains('bank_amounts') || e.target.classList.contains('deduction_amounts')) {
                calculateTotal();
            }
        });
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addDocument', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="documentFormField" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="title" class="form-label">{{ __('field_title') }} <span>*</span></label><input type="text" class="form-control" name="titles[]" id="title" value="{{ old('title') }}" required><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_title') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="document" class="form-label">{{ __('field_document') }} <span>*</span></label><input type="file" class="form-control" name="documents[]" id="document" value="{{ old('document') }}" required><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_document') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><button id="removeDocument" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newDocument').append(html);
            });

            // remove Field
            $(document).on('click', '#removeDocument', function() {
                $(this).closest('#documentFormField').remove();
            });
        }(jQuery));
    </script>

@endsection
