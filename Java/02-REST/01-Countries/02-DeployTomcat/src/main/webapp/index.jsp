<!DOCTYPE html>
<html>
	<head>
		<script>
			var xmlHttp = GetXmlHttpObject();
			var _baseEndPoint = "${pageContext.request.contextPath}/rest/countries";

			var host = "<%=request.getServerName() %>";
			var port = "<%=request.getServerPort() %>";
			
			function init() {
				document.getElementById( "endpoint" ).value = "http://" + host + ":" + port + _baseEndPoint;
			}
			
			function getBaseEndPoint() {
				return document.getElementById( "endpoint" ).value;
			}

			function GetXmlHttpObject() {
				try {
					return new ActiveXObject("Msxml2.XMLHTTP");
				} catch(e) {} // Internet Explorer
				try {
					return new ActiveXObject("Microsoft.XMLHTTP");
				} catch(e) {} // Internet Explorer
				try {
					return new XMLHttpRequest();
				} catch(e) {} // Firefox, Opera 8.0+, Safari
					alert("XMLHttpRequest not supported");
				return null;
			}

			function listCountries() {
				var endPoint = getBaseEndPoint();
				
				document.getElementById( "method" ).innerHTML = "Method: GET";
				document.getElementById( "URL" ).innerHTML = "URL: " + endPoint;

				xmlHttp.open( "GET", endPoint, true );
				xmlHttp.onreadystatechange=countriesHandleReply;
				xmlHttp.send( null );
			}
			
			function addCountry() {
				var countryData = document.getElementById( "input" ).value;
				var endPoint = getBaseEndPoint();
				
				document.getElementById( "method" ).innerHTML = "Method: POST";
				document.getElementById( "URL" ).innerHTML = "URL: " + endPoint;

				xmlHttp.open( "POST", endPoint, true );
				xmlHttp.onreadystatechange=countriesHandleReply;
				xmlHttp.setRequestHeader( "Content-Type", "application/json;charset=UTF-8" );
				xmlHttp.send( countryData );
			}

			function getCountry() {
				var countryID = document.getElementById( "input" ).value;
				var endPoint = getBaseEndPoint() + "/" + countryID;
				
				document.getElementById( "method" ).innerHTML = "Method: GET";
				document.getElementById( "URL" ).innerHTML = "URL: " + endPoint;

				xmlHttp.open( "GET", endPoint, true );
				xmlHttp.onreadystatechange=countriesHandleReply;
				xmlHttp.send( null );
			}
			
			function updateCountry() {
				var countryData = document.getElementById( "input" ).value;
				var endPoint = getBaseEndPoint();

				document.getElementById( "method" ).innerHTML = "Method: PUT";
				document.getElementById( "URL" ).innerHTML = "URL: " + endPoint;
				
				xmlHttp.open( "PUT", endPoint, true );
				xmlHttp.onreadystatechange=countriesHandleReply;
				xmlHttp.setRequestHeader( "Content-Type", "application/json;charset=UTF-8" );
				xmlHttp.send( countryData );
			}
			
			function deleteCountry() {
				var countryID = document.getElementById( "input" ).value;
				var endPoint = getBaseEndPoint() + "/" + countryID;
				
				document.getElementById( "method" ).innerHTML = "Method: DELETE";
				document.getElementById( "URL" ).innerHTML = "URL: " + endPoint;

				xmlHttp.open( "DELETE", endPoint, true );
				xmlHttp.onreadystatechange=countriesHandleReply;
				xmlHttp.send( null );
			}
			
			function countriesHandleReply() {
				if( xmlHttp.readyState === 4 ) {
					var parsedresponse = JSON.parse( xmlHttp.response );
					var formatedValue = JSON.stringify( parsedresponse, null, 2);
					
					document.getElementById( "output" ).textContent = formatedValue; 
				}
			}
		</script>
		
		<style>
			textarea {
				resize:				none;
			}

			.outputStyle {
				margin:				auto;
				border-style:		double;
				display:			flex;
				justify-content:	left;
				width:				50%;
				height:				200px;
				overflow-y: 		auto;
			}
			
			.boldStyle {
				font-weight:		bold;
			}
		</style>
	</head>
	<body onload="init()" >
		<h2>Countries REST Example!</h2>
		
		<p />
		
		<p><a target="_blank" href="https://java2blog.com/restful-web-services-jaxrs-crud-example/">Original source code</a></p>
		
		<p><a target="_blank" href="${pageContext.request.contextPath}/rest/application.wadl?detail=true">Service Description</a></p>
		
		<table border="1" align="center">
			<tr>
				<th>Method</th>
				<th>Description</th>
			</tr>
			<tr>
				<td>POST</td>
				<td>It is used to create new resource (<b>C</b>reate operation) *</td>
			</tr>
			<tr>
				<td>GET</td>
				<td>It is used to read resource (<b>R</b>ead operation)</td>
			</tr>
			<tr>
				<td>PUT</td>
				<td>It is generally used to update resource (<b>U</b>pdate operation) **</td>
			</tr>
			<tr>
				<td>DELETE</td>
				<td>It is used to delete resource (<b>D</b>elete operation)</td>
			</tr>
		<table>
		
		<p>* It is not idempotent method</p>
		<p>** It is idempotent method</p>
		
		<p>Idempotent means result of multiple successful request will not change state of resource 
		after initial application</p>
		
		<p align="center">
			<textarea class="inputStyle" id="input" name="input" rows="5" cols="30">
			</textarea>
		</p>
		
		<p>Service endpoint: <input type="text" name="endpoint" id="endpoint" size="80"></p>

		<button onclick="listCountries()">List all Countries (GET)</button>&nbsp;&nbsp;
		
		<button onclick="addCountry()">Add a new country (POST)</button>&nbsp;&nbsp;
		
		<button onclick="getCountry()">Get details for a specify country (GET)</button>&nbsp;&nbsp;
		
		<button onclick="updateCountry()">Update a specify country (PUT)</button>&nbsp;&nbsp;
		
		<button onclick="deleteCountry()">Delete a specify country (DELETE)</button>
		
		<div class="boldStyle" id="method">Method: </div>
		
		<div class="boldStyle" id="URL">URL: </div>
		
		<div class="outputStyle">
			<pre id="output" name="output"></pre>
		</div>		
	</body>
</html>
