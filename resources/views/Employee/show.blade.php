@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="pull-left">
            <h2>View Employee</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employee') }}"> Back</a>
        </div>
    </div>
</div>
    
     <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Employee Name:</strong>
                <label>{{@$employee->name}}</label>
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Employee Email:</strong>
                <label>{{@$employee->email}}</label>
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Contact Number:</strong>
                <label>{{@$employee->contact_number}}</label>
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Office Address:</strong>
                <label>{{@$employee->office_location}}</label>
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Salary:</strong>
                <label>{{@$employee->salary}}</label>
            </div>
        </div>
    </div>
<!-- </form> -->
</div>
@endsection