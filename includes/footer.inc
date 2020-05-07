<?php
print'

<footer>

		<div id="Opening-hours"> 
				Opening Hours <br>
				Monday - Friday : 08.00 am - 10.00 pm<br>
				Saturday-Sunday : 10.00 am - 10.00 pm			
		</div>	

		<div id="Contact"> 
			Address	: 15 Karnigradska St.R <br>
			Phone :	+359 894 420 440	<br>
			E-mail : SteakHouse@gmail.com 		
		</div>																					
		<div id="social"> 
			<a href="#"><i class="fab fa-facebook-f"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
				
		</div>	
			<!-- polzvame date("Y") za da pokajem tekushtata godina -->
		<div id="copyright">Copyright © '.date("Y").' Margarita Georgieva & Stoyanka Dancheva. <br> All rights reserved.</div>					
	</footer>
</body>
</html>';
$mysqli->close(); //krai na vruzkata s bazata danni
?>