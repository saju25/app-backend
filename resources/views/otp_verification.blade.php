
<!doctype html>
<html lang="en">
  <head>
    <title>OTP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      	<!--Page Title-->
    	<div class="page section-header text-center">
			<div class="page-title">
        		<div class="wrapper"><h1 class="page-width">Email Verification</h1></div>
      		</div>
		</div>
        <!--End Page Title-->
    <div class="container ">
        <div class="row justify-content-center align-items-center otp_div">
            <div class="col-md-7">
                <img src="{{asset('assets')}}/images/business-laptop.png" alt="">
            </div>
            <div class="col-md-5 otp_sec bg-white p-4">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                @if(session()->has('invalid'))
                <div class="alert alert-success">
                    {{ session()->get('invalid') }}
                </div>
                @endif
                <br />
                @if(session()->has('incorrect'))
                <div class="alert alert-success">
                    {{ session()->get('incorrect') }}
                </div>
                @endif
                <!-- Modal -->
                <form action="{{ route('verifyotp')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Enter OTP</label>
                        <input type="hidden" name="user" value="{{ $user->id }}" class="form-control" placeholder="Entrez OTP">
                        <input type="number" name="token" class="form-control" placeholder="Enter OTP ">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 w-100 post_btn">Submit</button>
                    <a href="{{ route('resend-otp', $user->id) }}" class="btn btn-primary mt-3 w-100 post_btn">You have not received? Resend</a>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
    


