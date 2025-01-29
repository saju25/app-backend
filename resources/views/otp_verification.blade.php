<x-guest-layout>
      	<!--Page Title-->
    	<div class="page section-header text-center otp_topmar mb-4">
			<div class="page-title mt-5">
        		<div class="wrapper text-bold"><h1 class="page-width">Email Verification</h1></div>
      		</div>
		</div>
        <!--End Page Title-->
    <div class=" ">
        <div class="row justify-content-center align-items-center ">
          
            <div class="col-md-5 otp_sec bg-white p-4">
                <!-- Modal -->
                <form action="{{ route('verifyotp')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Enter OTP</label>
                        <input type="hidden" name="user" value="{{ $user->id }}" class="form-control" placeholder="Entrez OTP">
                        <input type="number" name="token" class="form-control" placeholder="Enter OTP ">
                    </div>
                    <button type="submit" class="btn btn-1 mt-3 w-100 post_btn">Submit</button>
                    <a href="{{ route('resend-otp', $user->id) }}" class="btn btn-1 mt-3 w-100 post_btn">You have not received? Resend</a>
                </form>
            </div>
        </div>
    </div>
 
</x-guest-layout>  


