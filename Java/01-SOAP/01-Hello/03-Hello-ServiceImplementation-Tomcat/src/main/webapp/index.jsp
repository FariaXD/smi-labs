<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Hello Service - Tomcat</title>
    </head>
    <body>
        <p>Hello Service test page deployed in Apache Tomcat</p>
		
		<p>JSP</p>
		
		<div>Web App absolute path is: <%= getServletContext().getRealPath("/") %> </div>
		
		<div>
            <p><a href="${pageContext.request.contextPath}/hello?WSDL">Web Service WSDL</a></p>
            <p><a href="${pageContext.request.contextPath}/hello?Tester">Test Web Service</a></p>
        </div>
    </body>
</html>
