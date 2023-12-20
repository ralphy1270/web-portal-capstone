<!--- Start Contact Section -->
<div id="contact" class="footer offset">

<div class="row">

	<div class="col-md-5 footer-left">
		<img src="assets/images/icons/logo.png" alt="">		
		<h3>Sta. Cruz, Laguna</h3>
		<div class="content-footer">
			<p><p><?php echo $get_obj->info_footer(); ?></p></p>
			<strong>Our Location</strong>
			<p><p><?php echo $get_obj->address(); ?></p></p>
			<strong>Contact Info</strong>
			<p><p><?php echo $get_obj->contact(); ?></p></p>
			<a href="<?php echo $get_obj->fb(); ?>" target="_blank" title="facebook"><i class="fab fa-facebook-square"></i></a>
			<a href="<?php echo $get_obj->ig(); ?>" target="_blank" title="instagram"><i class="fab fa-instagram"></i></a>
			<a href="mailto:santacruzofficial@gmail.com" title="gmail" rel="noopener noreferrer"><i class="fas fa-envelope"></i></a>
		</div>
	</div>

	<div class="col-md-3 footer-right">
		<h3>Organizations</h3>

		<table>
			<tr>
				<td><a href="https://nyc.gov.ph/" target="_blank" title="National Youth Commission"><img src="assets/images/icons/national-youth-commission.png" alt=""></a></td>
				<td><a href="https://www.dilg.gov.ph/" target="_blank" title="DILG"><img src="assets/images/icons/DILG.png" alt=""></a></td>
				<td><a href="https://laguna.gov.ph/" target="_blank" title="Provincial Youth Development Affairs"><img src="assets/images/icons/provinial-youth-development-affairs-logo.png" alt=""></a></td>
				<td><a href="https://nyc.gov.ph/sangguniangkabataan/" target="_blank" title="Sangguniang Kabataan (Baranggay level)"><img src="assets/images/icons/sangguniang-kabataan.png" alt=""></a></td>
			</tr>
			<tr>
				<td><a href="https://www.facebook.com/Laguna-Provincial-Federation-of-the-Sangguniang-Kabataan-1722995394489628/" target="_blank" title="Sangguniang Kabataan Federation"><img src="assets/images/icons/SK-federation.png" alt=""></a></td>
				<td><a href="https://www.gsis.gov.ph/" target="_blank" title="GSIS"><img src="assets/images/icons/gsis.png" alt=""></a></td>
				<td><a href="https://www.dswd.gov.ph/list-of-sap-beneficiaries/" target="_blank" title="DSWD"><img src="assets/images/icons/Department-of-Social-Welfare-and-Development.png" alt=""></a></td>
				<td></td>
			</tr>
		</table>

	</div>

	<div class="col-md-4 footer-forum">
<!--			<h3>Questions:</h3>

     	<form id="contact-form" method="post" action="contact.php">

			<div class="messages"></div>
			<div class="controls">

				<div class="form-group">
					<input id="form_name" type="text" name="name" class="form-control footer_input" placeholder="Enter your name." required="required" autocomplete="off">
				</div>

				<div class="form-group">
					<input id="form_email" type="email" name="email" class="form-control footer_input" placeholder="Enter your email." required="required" autocomplete="off">
				</div>

				<div class="form-group">
					<textarea id="form_message" name="message" class="form-control footer_input" placeholder="Add your question." rows="4" required="required"></textarea>
				</div>

				<input type="submit" class="btn btn-outline-light btn-sm" value="Send message">

			</div>

		</form> -->

	</div>

	<hr class="socket">
	&copy; LSPU-SCC

</div> <!--- End of Row -->

</div>

<!--- Top Scroll -->
<a href="#intro" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!--- End of Top Scroll -->

<!--- Script Source Files -->
<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script src="js/all.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/waypoints.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.counterup.js"></script>
<script src="js/validator.js"></script>
<script src="js/contact.js"></script>
<!--- End of Script Source Files -->

</body>
</html>