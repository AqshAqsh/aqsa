@extends('layouts.admin-app')

@section('title')
Member List
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row " id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3>Member</h3>
                <a href="{{ route('admin.member.create') }}" class="btn purchase-button">Add New</a>
            </span>
        </div>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Members List</h4>
                    </p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>UserName</th>
                                <th>Religion</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Address</th>
                                <th>Guardian name</th>
                                <th>Guardian Contact</th>
                                <th>User image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->password }}</td>
                                <td>{{ $member->username }}</td>
                                <td>{{ $member->religion }}</td>
                                <td>{{ $member->gender }}</td>
                                <td>{{ $member->dob }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->guardian_number }}</td>
                                <td>{{ $member->guardian_name }}</td>
                                <td>@if($member->image)
                                    <img src="{{ asset('member/' . $member->image) }}" alt="Member Image" style="max-width: 100px; max-height: 100px;">
                                    @else
                                    No Image
                                    @endif
                                </td>


                                <td>
                                    <a href="{{ route('admin.member.edit', ['id' => $member->id]) }}"
                                        class="btn btn-success">Edit</a>
                                    <a href="{{ route('admin.member.delete', ['id' => $member->id]) }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection