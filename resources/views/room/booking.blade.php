@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.links')

    <title>Booking Room - {{ $room->category->name }}</title>
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">Book Room: {{ $room->category->name }}</h2>
        <div class="h-line bg-dark"></div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('room.booking.store', $room->room_no) }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <h3>Personal Information</h3>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="fullname" class="col-sm-3 col-form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" id="fullname" value="{{ old('fullname', Auth::user()->name) }}" required>
                @error('fullname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="date_of_birth" class="col-sm-3 col-form-label">Date Of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                @error('date_of_birth')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                <select name="gender" class="form-control" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="year_of_study" class="col-sm-3 col-form-label">Session Year</label>
                <input type="number" name="year_of_study" class="form-control" id="year_of_study" value="{{ old('year_of_study') }}" required>
                @error('year_of_study')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
 <label for="department" class="col-sm-3 col-form-label">Department</label>
                <input type="text" name="department" class="form-control" id="department" value="{{ old('department') }}" required>
                @error('department')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="rollno" class="col-sm-3 col-form-label">College Rollno</label>
                <input type="text" name="rollno" class="form-control" id="rollno" value="{{ old('rollno') }}" required>
                @error('rollno')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <h3>Room Details</h3>
            <div class="form-group row">
                <label for="room_no" class="col-sm-3 col-form-label">Room No</label>
                <input type="text" name="room_no" class="form-control" id="room_no" value="{{ $room->room_no }}" readonly>
                @error('room_no')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="room_name" class="col-sm-3 col-form-label">Room Name</label>
                <input type="text" name="room_name" class="form-control" id="room_name" value="{{ $room->category->name }}" readonly>
                @error('room_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ $room->description }}" readonly>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="facilities" class="col-sm-3 col-form-label">Facilities</label>
                @if($room->facilities && $room->facilities->isNotEmpty())
                @foreach ($room->facilities as $facility)
                <input type="text" name="facilities[]" class="form-control" id="facilities" value="{{ $facility->name }}" readonly>
                @endforeach
                @else
                <input type="text" name="facilities[]" class="form-control" id="facilities" value="No Facility Available" readonly>
                @endif
                @error('facilities')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="number_of_members" class="form-label">Number of Guests</label>
                <input type="number" name="number_of_members" id="number_of_members" class="form-control" value="1" readonly>
            </div>

            <h3>Select Bed</h3>
            <div id="bed_selection">
                @foreach ($room->beds as $bed)
                <div class="form-check">
                    <input type="radio" name="bedno" class="form-check-input" id="bed_id_{{ $bed->id }}" value="{{ $bed->bed_no }}" required>
                    <label class="form-check-label" for="bed_id_{{ $bed->id }}">Bed {{ $bed->bed_no }}</label>
                </div>
                @endforeach
            </div>

            <div class="form-group row">
                <label for="duration_months" class="form-label">Duration of Months</label>
                <input type="number" name="duration_months" id="duration_months" class="form-control" min="1" required onchange="calculateTotalCharge();">
                @error('duration_months')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group row">
                <label for="room_charge" class="form-label">Room Charges per month</label>
                <input type="number" name="room_charge" id="room_charge" class="form-control" value="{{ $room->room_charge }}" readonly>
                @error('room_charge')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group row">
                <label for="total_charge" class="form-label ">Total Room Charges</label>
                <input type="number" name="total_charge" id="total_charge" class="form-control" required readonly>
                @error('total_charge')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <h3>Emergency Contact</h3>
            <div class="form-group row">
                <label for="emergency_contact_name" class="form-label">Name</label>
                <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control" required>
                @error('emergency_contact_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group row">
                <label for="emergency_contact_phone" class="form-label">Emergency Contact Number</label>
                <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control" required>
                @error('emergency_contact_phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I agree to the terms and conditions.</label>
            </div>

            <div class="form-group row">
                <button type="submit" class="btn btn-warning">Submit Book Request</button>
            </div>
        </form>
    </div>

    <script>
        function calculateTotalCharge() {
            const numMonths = document.getElementById('duration_months').value;
            const roomCharge = document.getElementById('room_charge').value;
            const totalCharge = numMonths * roomCharge;
            document.getElementById('total_charge').value = totalCharge;
        }
    </script>
</body>

</html>
@endsection