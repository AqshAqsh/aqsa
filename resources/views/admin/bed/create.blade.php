@extends('layouts.admin-app')

@section('content')
<div class="content-wrapper">
    <div class="row" id="proBanner">
        <div class="col-12">
            <span class="d-flex align-items-center purchase-popup">
                <h3 class="mt-2 mr-3">Bed Create</h3>
                <a href="{{ route('admin.bed.list') }}" class="btn purchase-button">Go Back</a>
            </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Bed Form</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.bed.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="room_id">Room No</label>
                            <select name="room_id" id="room_id" class="form-control" required>
                                <option value="">Select a room</option>
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}"
                                    data-category="{{ $room->category->name }}"
                                    data-min-beds="{{ $categoryLimits[$room->category->name]['min'] ?? 1 }}"
                                    data-max-beds="{{ $categoryLimits[$room->category->name]['max'] ?? 8 }}"
                                    data-current-beds="{{ $room->number_of_members ?? 0 }}"
                                    {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_no }}
                                    ({{ $room->number_of_members ?? 0 }} beds)
                                </option>
                                @endforeach

                            </select>
                            @if ($errors->has('room_id'))
                            <span class="text-danger">{{ $errors->first('room_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="bed_no">Number of Beds</label>
                            <input type="number" name="bed_no" class="form-control" id="bed_no" value="{{ old('bed_no') }}" min="1" required>
                            <small id="bed-limit-message" class="form-text text-muted"></small>
                            @if ($errors->has('bed_no'))
                            <span class="text-danger">{{ $errors->first('bed_no') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('room_id').addEventListener('change', function() {
        var roomSelect = this;
        var selectedOption = roomSelect.options[roomSelect.selectedIndex];

        // Get the min and max bed limits from the data attributes
        var minBeds = selectedOption.getAttribute('data-min-beds');
        var maxBeds = selectedOption.getAttribute('data-max-beds');

        // Calculate remaining capacity (e.g., maxBeds - current bed count)
        var currentBedCount = selectedOption.getAttribute('data-current-beds') || 0;
        var remainingCapacity = maxBeds - currentBedCount;

        // Update the form field limits dynamically
        document.getElementById('bed_no').setAttribute('min', minBeds);
        document.getElementById('bed_no').setAttribute('max', remainingCapacity);

        // Update the message for remaining bed capacity
        document.getElementById('bed-limit-message').innerText =
            `Available beds: ${remainingCapacity} (Max: ${maxBeds}, Min: ${minBeds})`;

        // If remaining capacity is less than min, show a warning message
        if (remainingCapacity < minBeds) {
            document.getElementById('bed-limit-message').style.color = 'red';
        } else {
            document.getElementById('bed-limit-message').style.color = 'green';
        }
    });

    // Trigger the change event when the page is loaded with a selected room
    if (document.getElementById('room_id').value) {
        document.getElementById('room_id').dispatchEvent(new Event('change'));
    }
</script>

@endsection