@extends('dashboard.layouts.default')
@push('styles')
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
	.profile-pic-wrapper {
		/*height: 100vh;*/
		width: 100%;
		position: relative;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
	.pic-holder {
		text-align: center;
		position: relative;
		border-radius: 50%;
		width: 150px;
		height: 150px;
		overflow: hidden;
		display: flex;
		justify-content: center;
		align-items: center;
		margin-bottom: 20px;
	}

	.pic-holder .pic {
		height: 100%;
		width: 100%;
		-o-object-fit: cover;
		object-fit: cover;
		-o-object-position: center;
		object-position: center;
	}

	.pic-holder .upload-file-block,
	.pic-holder .upload-loader {
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		background-color: rgba(90, 92, 105, 0.7);
		color: #f8f9fc;
		font-size: 12px;
		font-weight: 600;
		opacity: 0;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s;
	}

	.pic-holder .upload-file-block {
		cursor: pointer;
	}

	.pic-holder:hover .upload-file-block {
		opacity: 1;
	}

	.pic-holder.uploadInProgress .upload-file-block {
		display: none;
	}

	.pic-holder.uploadInProgress .upload-loader {
		opacity: 1;
	}

	/* Snackbar css */
	.snackbar {
		visibility: hidden;
		min-width: 250px;
		background-color: #333;
		color: #fff;
		text-align: center;
		border-radius: 2px;
		padding: 16px;
		position: fixed;
		z-index: 1;
		left: 50%;
		bottom: 30px;
		font-size: 14px;
		transform: translateX(-50%);
	}

	.snackbar.show {
		visibility: visible;
		-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
		animation: fadein 0.5s, fadeout 0.5s 2.5s;
	}

	@-webkit-keyframes fadein {
		from {
			bottom: 0;
			opacity: 0;
		}
		to {
			bottom: 30px;
			opacity: 1;
		}
	}

	@keyframes fadein {
		from {
			bottom: 0;
			opacity: 0;
		}
		to {
			bottom: 30px;
			opacity: 1;
		}
	}

	@-webkit-keyframes fadeout {
		from {
			bottom: 30px;
			opacity: 1;
		}
		to {
			bottom: 0;
			opacity: 0;
		}
	}

	@keyframes fadeout {
		from {
			bottom: 30px;
			opacity: 1;
		}
		to {
			bottom: 0;
			opacity: 0;
		}
	}

</style>
@endpush
@section('contentdashboard')
<!-- https://codepen.io/chiraggoyal777/pen/xxEowxq -->
<div class="card">
	<div class="card-body">
		<div class="profile-pic-wrapper">
			<div class="pic-holder">
				<img id="profilePic" class="pic" src="https://source.unsplash.com/random/150x150">
				<label for="newProfilePhoto" class="upload-file-block">
					<div class="text-center">
						<div class="mb-2">
							<i class="fa fa-camera fa-2x"></i>
						</div>
						<div class="text-uppercase">
							Update <br /> Profile Photo
						</div>
					</div>
				</label>
				<Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="display: none;" />
			</div>
		</div>
		<form method="POST" action="{{ url('dashboard') }}" autocomplete="off">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group mb-3">
						<label>Nama Lengkap <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" required value="{{ $user->name }}" placeholder="Nama Lengkap">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group mb-3">
						<label>No. Telepon <span class="text-danger">*</span></label>
						<input type="text" name="phone" class="form-control" required value="{{ $user->phone }}" placeholder="Contoh: 085699000999">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group mb-3">
						<label>Email <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" required value="{{ $user->email }}" placeholder="example@gmail.com" disabled style="cursor: no-drop;">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group mb-3">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Isi untuk mengubah password">
					</div>
				</div>
			</div>
			<div class="form-group mb-3">
				<label>Alamat <span class="text-danger">*</span></label>
				<textarea name="address" class="form-control" required placeholder="Alamat Lengkap" rows="4">{{ $user->address }}</textarea>
			</div>
			<button type="submit" class="btn btn-primary w-100"><i class="fa fa-save"></i> Update</button>
		</form>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
	$(document).ready(function($) {
		$('.select2').select2();

		$(document).on("change", ".uploadProfileInput", function () {
			var triggerInput = this;
			var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
			var holder = $(this).closest(".pic-holder");
			var wrapper = $(this).closest(".profile-pic-wrapper");
			$(wrapper).find('[role="alert"]').remove();
			var files = !!this.files ? this.files : [];
			if (!files.length || !window.FileReader) {
				return;
			}
			if (/^image/.test(files[0].type)) {
    // only image file
    var reader = new FileReader(); // instance of the FileReader
    reader.readAsDataURL(files[0]); // read the local file

    reader.onloadend = function () {
    	$(holder).addClass("uploadInProgress");
    	$(holder).find(".pic").attr("src", this.result);
    	$(holder).append(
    		'<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
    		);

      // Dummy timeout; call API or AJAX below
      setTimeout(() => {
      	$(holder).removeClass("uploadInProgress");
      	$(holder).find(".upload-loader").remove();
        // If upload successful
        if (Math.random() < 0.9) {
        	$(wrapper).append(
        		'<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
        		);

          // Clear input after upload
          $(triggerInput).val("");

          setTimeout(() => {
          	$(wrapper).find('[role="alert"]').remove();
          }, 3000);
      } else {
      	$(holder).find(".pic").attr("src", currentImg);
      	$(wrapper).append(
      		'<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
      		);

          // Clear input after upload
          $(triggerInput).val("");
          setTimeout(() => {
          	$(wrapper).find('[role="alert"]').remove();
          }, 3000);
      }
  }, 1500);
  };
} else {
	$(wrapper).append(
		'<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
		);
	setTimeout(() => {
		$(wrapper).find('role="alert"').remove();
	}, 3000);
}
});

	});
</script>
@endpush