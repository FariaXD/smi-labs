<%@page contentType="text/html" pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Hello (Service) Web Application</title>
  </head>

  <body>
		<h1 align="center">Hello (Service) Web Application</h1>
		
		<div>Web App absolute path is: <%= getServletContext().getRealPath("/") %> </div>
		
		<div>
      <p><a href="${pageContext.request.contextPath}/serviceHello?WSDL">Web Service WSDL</a></p>
      <p><a href="${pageContext.request.contextPath}/serviceHello?Tester">Test Web Service</a></p>
    </div>

  </body>
</html>
