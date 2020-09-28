@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="pull-left">
            <h2>{{@$employee->id?'Edit':'Add'}} Employee</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employee') }}"> Back</a>
        </div>
    </div>
</div>
   
<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
    @method('PUT')
    {{ csrf_field() }}
  
     <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Employee Name:</strong>
                <input type="text" name="name" value="{{@$employee->name}}" id="name" class="form-control" placeholder="Employee Name">
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Employee Email:</strong>
                <input type="email" name="email" value="{{@$employee->email}}" id="email" class="form-control" placeholder="Employee Email">
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Contact Number:</strong>
                <input type="number" name="contact_number" value="{{@$employee->contact_number}}" id="contact_number" class="form-control" placeholder="Contact Number">
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Office Location:</strong>
                <input type="text" name="office_location" value="{{@$employee->office_location}}" id="office_location" class="form-control" placeholder="Office Location">
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Salary:</strong>
                <input type="number" name="salary" value="{{@$employee->salary}}" id="salary" class="form-control" placeholder="Salary">
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" value="{{@$employee->password}}" id="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <input type="hidden" name="latitude" class="form-control" id="latitude" value="{{ old('latitude') }}">
        <input type="hidden" name="longitude" class="form-control" id="longitude" value="{{ old('longitude') }}">
        <div class="col-xs-8 col-sm-8 col-md-8 text-center">
                <button type="submit" id="update_data" value="{{ @$employee->id }}" class="btn btn-primary">Submit</button>
        </div>
    </div>

<!-- </form> -->
</div>
@endsection