<html>
	<head>
		<title>Homepage</title>
	</head>

	<body>
		<h1><center>NITT STUDENT DATABASE</center></h1>
		</br>
			<ul type="disc">
				<li>One of the 30 National Institutes of Technology established by the Government of India</li>
				<li>Autonomous co-educational technological institute</li>
				<li>10 undergraduate & 22 graduate programs</li>
				<li>Also has a management and architecture school</li>
				<li>Located in Thuvakudi on the Trichy-Tanjore national highway</li>
			</ul>

		<form>
			<input type="button" value="Add Student" onclick="DirForm()"/>
			<input type="button" value="View Student" onclick="DirSearch()"/>
			
		</form>
	</body>

	<script language="javascript" type="text/javascript">
			function DirForm()
			{
				window.location="Form.php";
			}
			function DirSearch()
			{
				window.location="Check.php";
			}
	</script>
</html>