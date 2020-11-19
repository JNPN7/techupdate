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
			<div class="main-pad contact-text">
				<h2>Contact</h2>
				<p>Techx Network, Inc<br>
				Kathmandu,44600<br>
				Capital of Nepal</p>
				<h6>Bibek Manandhar</h6>
				<p>Email: manandhar.bibek01@gmail.com</p>
				<p>Cell: +9779860906640</p>
				<h6>Sudip Manandhar</h6>
				<p>Email: manandharsudip8@gmail.com</p>
				<p>Cell: +9779861287059</p>
				<h6>Juhel Phanju</h6>
				<p>Email: jpphanju54@gmail.com</p>
				<p>Cell: +9779860906640</p>
				<h6>Abhinandan Shrestha</h6>
				<p>Email: shtabhi@gmail.com</p>
				<p>Cell: +9779868205040</p>
			</div>
		</article>

		<!-- right section -->
		<aside class="right-contact">
			<div class="main-pad col" style="padding-top: 20px;">
				<h2>Send A Message</h2>
				<form action="process/subEmail" method="post">  
					<div class="col" style="padding-right: 50px;">

						<h3 style="margin-bottom: 0;">Username</h3>
						<input class="input" type="text" name="username" required=""/>

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