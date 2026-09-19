@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                @can($access . '-create')
                    <div class="col-md-4">
                        <form class="needs-validation" novalidate action="{{ route($route . '.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{ __('btn_create') }} {{ $title }}</h5>
                                </div>
                                <div class="card-block">
                                    <!-- Form Start -->
                                    <div class="form-group">
                                        <label for="title" class="form-label">{{ __('field_title') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            value="{{ old('title') }}" required>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_title') }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="year" class="form-label">{{ __('field_year') }} <span>*</span></label>
                                        <select class="form-control" name="year" id="year">
                                            <option value="">{{ __('select') }}</option>

                                            <option value="1st" @if (old('year') == '1st') selected @endif>
                                                {{ __('1st_year') }}
                                            </option>

                                            <option value="2nd" @if (old('year') == '2nd') selected @endif>
                                                {{ __('2nd_year') }}
                                            </option>

                                            <option value="3rd" @if (old('year') == '3rd') selected @endif>
                                                {{ __('3rd_year') }}
                                            </option>

                                            <option value="4th" @if (old('year') == '4th') selected @endif>
                                                {{ __('4th_year') }}
                                            </option>

                                            <option value="5th" @if (old('year') == '5th') selected @endif>
                                                {{ __('5th_year') }}
                                            </option>

                                            <option value="6th" @if (old('year') == '6th') selected @endif>
                                                {{ __('6th_year') }}
                                            </option>

                                            <option value="7th" @if (old('year') == '7th') selected @endif>
                                                {{ __('7th_year') }}
                                            </option>

                                            <option value="8th" @if (old('year') == '8th') selected @endif>
                                                {{ __('8th_year') }}
                                            </option>
                                        </select>


                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_year') }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="program">{{ __('field_assign') }} {{ __('field_program') }}
                                            <span>*</span></label>

                                        <div class="checkbox">
                                            <input type="checkbox" name="all_check" id="all_check" class="all_check" checked>
                                            <label for="all_check" class="cr">{{ __('all') }}</label>
                                        </div>

                                        @foreach ($programs as $key => $program)
                                            <br />
                                            <div class="checkbox d-inline">
                                                <input type="checkbox" class="program" name="programs[]"
                                                    id="program-{{ $key }}" value="{{ $program->id }}" checked>
                                                <label for="program-{{ $key }}"
                                                    class="cr">{{ $program->title }}</label>
                                            </div>
                                        @endforeach

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_program') }}
                                        </div>
                                    </div>
                                    <!-- Form End -->
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
                                        {{ __('btn_save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endcan
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }} {{ __('list') }}</h5>
                        </div>
                        <div class="card-block">
                            <!-- [ Data table ] start -->
                            <div class="table-responsive">
                                <table id="basic-table" class="display table nowrap table-striped table-hover"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('field_title') }}</th>
                                            <th>{{ __('field_year') }}</th>
                                            <th>{{ __('field_program') }}</th>
                                            <th>{{ __('field_status') }}</th>
                                            <th>{{ __('field_action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->title }}</td>
                                                <td>
                                                    @if ($row->year == '1st')
                                                        {{ __('1st_year') }}
                                                    @elseif($row->year == '2nd')
                                                        {{ __('2nd_year') }}
                                                    @elseif($row->year == '3rd')
                                                        {{ __('3rd_year') }}
                                                    @elseif($row->year == '4th')
                                                        {{ __('4th_year') }}
                                                    @elseif($row->year == '5th')
                                                        {{ __('5th_year') }}
                                                    @elseif($row->year == '6th')
                                                        {{ __('6th_year') }}
                                                    @elseif($row->year == '7th')
                                                        {{ __('7th_year') }}
                                                    @elseif($row->year == '8th')
                                                        {{ __('8th_year') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach ($row->programs as $key => $program)
                                                        <span class="badge badge-primary">{{ $program->title }}</span><br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($row->status == 1)
                                                        <span
                                                            class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @can($access . '-edit')
                                                        <button type="button" class="btn btn-icon btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal-{{ $row->id }}">
                                                            <i class="far fa-edit"></i>
                                                        </button>
                                                        <!-- Include Edit modal -->
                                                        @include($view . '.edit')
                                                    @endcan

                                                    @can($access . '-delete')
                                                        <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal-{{ $row->id }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <!-- Include Delete modal -->
                                                        @include('admin.layouts.inc.delete')
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- [ Data table ] end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection

@section('page_js')
    <script type="text/javascript">
        "use strict";
        // checkbox all-check-button selector
        $(".all_check").on('click', function(e) {
            if ($(this).is(":checked")) {
                // check all checkbox
                $(".program").prop('checked', true);
            } else if ($(this).is(":not(:checked)")) {
                // uncheck all checkbox
                $(".program").prop('checked', false);
            }
        });
    </script>
@endsection
