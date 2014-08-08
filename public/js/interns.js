(function($) {
	$(function() {
		var BASE_PATH = $('#basePath').val();
		var HAS_LOGGED_IN = $('#hasLoggedIn').val();
		$( document ).tooltip();
		$("#startDateRefine").datepicker();
		$('.forgotten-password-box').hide();
		$('.othertextbox').hide();
		$('.navbar-nav-right').bind('click', function(e) {
			e.preventDefault();
			if(HAS_LOGGED_IN){
				$.post(BASE_PATH +'/users/logout',{}, function(data){
					if(data.success){
						location.href = BASE_PATH;
					}
					else{
						alert("Signout unsuccessful. Please try again.");
					}
				},'json');
			}
			else{
				$('.forgotten-password-box').hide();
				$('.login-box').bPopup({
					speed : 650,
					transition : 'slideIn',
					closeClass : 'close1',
				});
			}
		});

		$('.forgotten-password-link').bind('click', function(e) {
			// Prevents the default action to be triggered. 
			e.preventDefault();
			$('.forgotten-password-box').show("slow");
		});

		$('.fieldSelectionCriteria input[type=radio]').not("#otherradioinput")
				.bind('click', function(e) {
					$(".othertextbox").hide(1000);
				});

		$("#otherradioinput").bind('click', function(e) {
			$(".othertextbox").show(500, function(){
				$(".othertextbox").focus();
			});
		});
		
		$("#loginButton").bind('click', function(e) {
			$.post(BASE_PATH +'/users/login',{'username': $('#loginUsername').val(), 'password':$('#loginPassword').val()}, function(data){
				if(data.success && data.user_type==1 ){
					$("#welcomeName").html("Welcome "+data.user.name);
					$("#hasLoggedIn").val(true);
					HAS_LOGGED_IN = true;
				}
				else if(data.success && data.user_type==2){
					$("#welcomeName").html("Welcome "+data.user.company_name);
					$("#hasLoggedIn").val(true);
					HAS_LOGGED_IN = true;
				}
				else{
					alert(data.message);
					$('.login-box').bPopup({
						speed : 650,
						transition : 'slideIn',
						closeClass : 'close1',
					});
				}
			},'json');
		});
		
	});
})(jQuery);