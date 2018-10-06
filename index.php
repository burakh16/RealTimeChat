<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

	<div class="panel">
		<a href="logout.php" class="btn btn-danger" style="float: right; padding: 10px 30px; ">Çıkıs</a>
	</div>	
	<div class="container-fluid" style="padding-top: 50px;">
		<div class="chat_wrapper">
			
			<div id="chat" class="border rounded"></div>
			<form method="post" id="msgForm">


				<div class="form-group">
					<label for="exampleFormControlTextarea1"></label>
					<textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Enter your message ..."></textarea>
				</div>
			</form>
		</div>	
		
	</div>

	<script>
		loadChat();
		setInterval(function(){
			loadChat();
		}, 1000);

		function loadChat(){
			$.post('messages.php?action=getMessages', function(response){

				var pos = $('#chat').scrollTop();
				var pos = parseInt(pos) + 520;
				var scrollHeight = $('#chat').prop('scrollHeight')
				$('#chat').html(response);

				if( pos < scrollHeight){

				}else
				$('#chat').scrollTop($('#chat').prop('scrollHeight'));
			});
		}


		$('.form-control').keyup(function(e){

			if(e.which == 13){
				$('#msgForm').submit(); 
				$('.form-control').val('');
			}
		});



		$('#msgForm').submit(function(){
			var message = $('.form-control').val();

			$.post('messages.php?action=sendMessage&message='+message,function(response){

				if (response == 1) {
					loadChat();
					$('#chat').scrollTop($('#chat').prop('scrollHeight'));
					document.getElementById('msgForm').reset();
				}


			});

			return false;
		});


	</script>


</body>
</html>