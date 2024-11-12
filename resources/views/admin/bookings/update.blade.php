@extends('layouts.admin-app')

@section('content')
<style>
	.avatar {
		background-color: #aaa;
		border-radius: 50%;
		color: #fff;
		display: inline-block;
		font-weight: 500;
		height: 38px;
		line-height: 38px;
		margin: -38px 10px 0 0;
		text-align: center;
		text-transform: uppercase;
		width: 38px;
		position: relative;
	}
</style>

{{-- Toastr Message --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title mt-5">Edit Booking</h3>
				</div>
			</div>
		</div>

		<form action="{{ route('admin.booking.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT') <!-- Add this to use PUT method for updates -->
			
			<div class="row">
				<div class="col-lg-12">
					<div class="row formtype">
						<div class="col-md-4">
							<div class="form-group">
								<label>Booking ID</label>
								<input class="form-control" type="text" name="user_id" value="{{ $booking->user_id }}" readonly>
							</div>
						</div>

						<!-- Other fields for editing booking details -->
						<div class="col-md-4">
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" name="name" value="{{ $booking->name }}">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Room Type</label>
								<select class="form-control" name="room_type">
									<option selected value="{{ $booking->room_type }}">{{ $booking->room_type }}</option>
									<option value="Simple room">Simple room</option>
									<option value="Luxury room">Luxury room</option>
								</select>
							</div>
						</div>

						<!-- Additional form fields -->

						<div class="col-md-4">
							<div class="form-group">
								<label>File Upload</label>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="customFile" name="fileupload">
									<input type="hidden" name="hidden_fileupload" value="{{ $booking->fileupload }}">
									<a href="#" class="avatar avatar-sm mr-2">
										<img class="avatar-img rounded-circle" src="{{ URL::to('/assets/upload/'.$booking->fileupload) }}" alt="{{ $booking->fileupload }}">
									</a>
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Message</label>
								<textarea class="form-control" rows="1.5" name="message">{{ $booking->message }}</textarea>
							</div>
						</div>
					</div>
				</div>
			</div>

			<button type="submit" class="btn btn-primary buttonedit">Update</button>
		</form>
	</div>
</div>

@section('script')
<script>
	$(function() {
		$('#datetimepicker3').datetimepicker({
			format: 'LT'
		});
	});
</script>
@endsection

@endsection
