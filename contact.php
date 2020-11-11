<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';
?>

<main role="main" class="col">
	<!-- banner -->
	<!-- main content -->
	<section class="row">
		<!-- main section -->
		<article class="main-contact">
			<div class="main-pad">
				<h3>Contact Information</h3>
				<p>Oh! So, you wanna contact me. Why? I don't see any reason for you to contact me. Why I wanna get in contact with this world burden, who should be dead, not tying to contact me. Ok! Ok! Don't cry! I have left some of my detail down there. Contact me just before dying, I need some reason to celebrate!!</p>
				<ul class="list-style">
					<li><p><strong>Email:</strong> <a href="#"> jpphanju54@gmail.com</a></p></li>
					<li><p><strong>Phone:</strong> Dream About it</p></li>
					<li><p><strong>Address:</strong> Hahaha Why??</p></li>
				</ul>
			</div>
		</article>

		<!-- right section -->
		<aside class="right-contact">
			<div class="main-pad col" style="padding-top: 20px;">
				<h2>Send A Message</h2>
				<form>  
					<div class="col" style="padding-right: 50px;">

						<h3 style="margin-bottom: 0;">Email</h3>
						<input class="input" type="email" name="email" required=""/>
	
						<h3 style="margin-bottom: 0; margin-top: 15px">Subject</h3>
						<input class="input" type="text" name="subject" required=""/>

						<div style="height: 20px"></div>
						<textarea class="input" style="height: 100px; padding-top: 5px" name="message" placeholder="Message" required=""/></textarea>

						<div style="height: 20px"></div>
						<button class="primary-button" style="width: 140px">Submit</button>
						
					</div>
				</form>
			</div>
		</aside>
	</section>
</main>


<?php
	include 'includes/footer.php';
?>