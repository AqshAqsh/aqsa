@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">User Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Personal Information Section -->
        <h2 class="h4 mb-3">Personal Information</h2>
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', auth()->user()->full_name) }}" required>
            @error('full_name') 
                <div class="text-danger">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" class="form-check-input" value="Male" {{ old('gender', auth()->user()->gender) == 'Male' ? 'checked' : '' }} required>
                <label class="form-check-label">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" class="form-check-input" value="Female" {{ old('gender', auth()->user()->gender) == 'Female' ? 'checked' : '' }} required>
                <label class="form-check-label">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="gender" class="form-check-input" value="Other" {{ old('gender', auth()->user()->gender) == 'Other' ? 'checked' : '' }} required>
                <label class="form-check-label">Other</label>
            </div>
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}" required>
            @error('date_of_birth') 
                <div class="text-danger">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', auth()->user()->contact_number) }}" pattern="^[0-9]{10}$" title="Enter a valid 10-digit contact number" required>
            @error('contact_number') 
                <div class="text-danger">{{ $message }}</div> 
            @enderror
        </div>

        <!-- Address Details Section -->
        <h2 class="h4 mb-3">Address Details</h2>
        <div class="mb-3">
            <label for="permanent_address" class="form-label">Permanent Address</label>
            <textarea name="permanent_address" class="form-control" required>{{ old('permanent_address', auth()->user()->permanent_address) }}</textarea>
            @error('permanent_address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="current_address" class="form-label">Current Address</label>
            <textarea name="current_address" class="form-control" required>{{ old('current_address', auth()->user()->current_address) }}</textarea>
            @error('current_address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Educational Details Section -->
        <h2 class="h4 mb-3">Educational Details</h2>
        <div class="mb-3">
            <label for="college_roll_number" class="form-label">College Roll Number</label>
            <input type="text" name="college_roll_number" class="form-control" value="{{ old('college_roll_number', auth()->user()->college_roll_number) }}" required>
            @error('college_roll_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="college_department" class="form-label">College Department</label>
            <input type="text" name="college_department" class="form-control" value="{{ old('college_department', auth()->user()->college_department) }}" required>
            @error('college_department')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester/Year of Study</label>
            <input type="text" name="semester" class="form-control" value="{{ old('semester', auth()->user()->semester) }}" required>
            @error('semester')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="program" class="form-label">Program/Course</label>
            <input type="text" name="program" class="form-control" value="{{ old('program', auth()->user()->program) }}" required>
            @error('program')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="enrollment_year" class="form-label">Enrollment Year</label>
            <input type="number" name="enrollment_year" class="form-control" value="{{ old('enrollment_year', auth()->user()->enrollment_year) }}" required min="2000" max="{{ date('Y') }}">
            @error('enrollment_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Hostel Information Section -->
        <h2 class="h4 mb-3">Hostel Information</h2>
        <div class="mb-3">
            <label for="room_number" class="form-label">Room Number</label>
            <input type="number" name="room_number" class="form-control" value="{{ old('room_number', auth()->user()->room_number) }}" required>
            @error('room_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hostel_block" class="form-label">Hostel Block/Building</label>
            <input type="text" name="hostel_block" class="form-control" value="{{ old('hostel_block', auth()->user()->hostel_block) }}" required>
            @error('hostel_block')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bed_number" class="form-label">Bed/Seat Number</label>
            <input type="text" name="bed_number" class="form-control" value="{{ old('bed_number', auth()->user()->bed_number) }}" required>
            @error('bed_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Guardian/Emergency Contact Section -->
        <h2 class="h4 mb-3">Guardian/Emergency Contact</h2>
        <div class="mb-3">
            <label for="guardian_name" class="form-label">Guardian Name</label>
            <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name', auth()->user()->guardian_name) }}" required>
            @error('guardian_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="guardian_contact_number" class="form-label">Guardian Contact Number</label>
            <input type="text" name="guardian_contact_number" class="form-control" value="{{ old('guardian_contact_number', auth()->user()->guardian_contact_number) }}" pattern="^[0-9]{10}$" title="Enter a valid 10-digit contact number" required>
            @error('guardian_contact_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="guardian_address" class="form-label">Guardian Address</label>
            <textarea name="guardian_address" class="form-control" required>{{ old('guardian_address', auth()->user()->guardian_address) }}</textarea>
            @error('guardian_address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection