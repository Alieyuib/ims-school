@extends('layouts.app')

@section('content')
    <div class="crumbs">
        <div class="col-md-12 breadcrumbs">
            <p class="breadcrumbs-text">Dashboard/Edit Student</p>
        </div>
    </div>
    <div class="form-div col-md-12">
        @foreach ($edit_data as $item)
            <form action="{{ url('/dashboard/student/edit/inst/'.$item->id) }}" method="POST" id="reg-edit-form" class="container card reg-form">
                @csrf
                <h4 class="form-header">
                    Student Data Edit Form
                </h4>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="firstname">Firstname</label>
                        <input type="hidden" value="{{ $item->id }}" class="form-control" name="sid" id="sid">
                        <input type="text" value="{{ $item->fname }}" class="form-control" name="fname" placeholder="Firstname" id="firstname">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lastname">Lastname</label>
                        <input type="text" value="{{ $item->lname }}" class="form-control" name="lname" placeholder="Lastname" id="lastname">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="familyname">Family Name</label>
                        <input type="text" value="{{ $item->ffname }}" class="form-control" name="ffname" placeholder="Family Name" id="familyname">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dob">DOB</label>
                        <input type="date" value="{{ $item->dob }}" class="form-control" name="dob" placeholder="DOB" id="dob">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pob">POB</label>
                        <input type="text" value="{{ $item->pob }}" class="form-control" name="pob" placeholder="Place of Birth" id="pob">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sickness">Sickness/Allergy</label>
                        <input type="text" value="{{ $item->sickness_allergy }}" class="form-control" name="sickness" placeholder="Sickness/Allergy" id="sickness">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="guard">Guardian/Husband</label>
                        <input type="text" value="{{ $item->guardian }}" class="form-control" name="guard" placeholder="Guardian/Husband" id="guard">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone">Phone Number</label>
                        <input type="text" value="{{ $item->phone_no }}" class="form-control" name="phone" placeholder="Phone Number" id="phone">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="school">Name of School</label>
                        <input type="text" value="{{ $item->name_of_school }}" class="form-control" name="school" placeholder="Name of School" id="school">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="subject">Subject Learned</label>
                        <input type="text" value="{{ $item->Subject_learned }}" class="form-control" name="subject" placeholder="Subject Learned" id="subject">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email Address</label>
                        <input type="text" value="{{ $item->email }}" class="form-control" name="email" placeholder="Email Address" id="email">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="address">Address</label>
                        <input type="text" value="{{ $item->address }}" class="form-control" name="address" placeholder="Address" id="address">
                    </div>
                    <div class="form-group col-md-12">
                    <button class="btn btn-success" type="submit" id="edit-save-btn">Save <i class="fa fa-save"></i></button>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
@endsection