@include('header')

@include('navbar')
<div class="container-fluid pt-2 mb-5">
	<div class="row pt-4 contact-info">
		<div class="col-lg-6 my-6 mb-5">
			<h3>Contact Info</h3>
			<div class="row my-6">
				<div class="col-2 contact-icon">
					<i class="fa-solid fa-location-dot"></i>
				</div>
				<div class="col-10">
					<h4>Address</h4>
					<span>Agriculture Services Academy Opposite Islamia College, Jamrud Road Peshawar</span>


				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-2 contact-icon">
					<i class="fa-solid fa-phone"></i>
				</div>
				<div class="col-10">
					<h4>Phone</h4>
					<span>091-9224234</span>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-2 contact-icon">
					<i class="fa-solid fa-envelope"></i>
				</div>
				<div class="col-10">
					<h4>Email</h4>
					<span>admission@asap.edu.pk</span>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<h3>Send A Message</h3>
			<div id="responseMessage"></div>

			<form id="contactForm" method="post" action="{{ route('contact.submit') }}">
				@csrf
				<div class="row">
					<div class="col-6 form-group">
						<input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
					</div>
					<div class="col-6">
						<input type="email" name="email" id="email" class="form-control" placeholder="Your Email Address">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 form-group">
						<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12">
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"
                                  placeholder="Your Suggestion"></textarea>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12">
						<button type="submit" id="submitBtn" class="btn btn-sm btn-style"><i class="fa-brands fa-telegram"></i> Submit
						</button>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#contactForm').on('submit', function (e) {
			e.preventDefault()

			// Clear previous error messages
			$('.error-message').remove()

			// Validate email format
			const emailInput = $('[name="email"]')
			const emailValue = emailInput.val()
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

			if (!emailRegex.test(emailValue)) {
				emailInput.addClass('is-invalid')
				emailInput.after('<div class="invalid-feedback error-message">Invalid email format</div>')
				return // Stop submission if email format is invalid
			}

			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function (response) {
					$('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>')
				},
				error: function (xhr) {
					if (xhr.status === 422) {
						const errors = xhr.responseJSON.errors
						$.each(errors, function (field, messages) {
							const fieldElement = $('[name="' + field + '"]')
							fieldElement.addClass('is-invalid')
							$.each(messages, function (key, message) {
								fieldElement.after('<div class="invalid-feedback error-message">' + message + '</div>')
							})
						})
					} else {
						$('#responseMessage').html('<div class="alert alert-danger">An error occurred. Please try again later.</div>')
					}
				}
			})
		})

		// Clear error messages when input is focused
		$('input, textarea').on('focus', function () {
			$(this).removeClass('is-invalid')
			$(this).siblings('.error-message').remove()
		})
	})

</script>

@include('footer')