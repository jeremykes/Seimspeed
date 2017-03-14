@extends('layouts.corp')

@section('corp-home-active')
    active
@endsection

@section('corp-home')
      <div class="col-md-6">
        <table class="table table-hover"> 
          <thead> 
            <tr> 
              <!-- <th>#</th>  -->
              <th style="text-align:center">Account Snapshot</th> 
              <!-- <th>Last Name</th>  -->
              <!-- <th>Username</th>  -->
            </tr> 
          </thead> 

          <tbody> 
            <tr> 
              <th scope="row">Cars</th> 
              <td>8</td> 
            </tr> 
            <tr> 
              <th scope="row">Cars sold</th> 
              <td>3</td> 
            </tr> 
            <tr> 
              <th scope="row">Parts</th> 
              <td>12</td> 
            </tr> 
            <tr> 
              <th scope="row">Members</th> 
              <td>5</td> 
            </tr> 
            <tr> 
              <th scope="row">Subscription</th> 
              <td>Premium</td> 
            </tr> 
            <tr> 
              <th scope="row">Complaints</th> 
              <td>2</td> 
            </tr> 
          </tbody> 
        </table>
      </div>
@endsection
