<%@page contentType="text/html" pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Book Store (Service) Web Application</title>
  </head>

  <body>
    <h1 align="center">Book Store (Service) Web Application</h1>
    
    <div>Web App absolute path is: <%= getServletContext().getRealPath("/") %> </div>
    
    <div>
      <p><a href="${pageContext.request.contextPath}/serviceBookStore?WSDL">Web Service WSDL</a></p>
      <p><a href="${pageContext.request.contextPath}/serviceBookStore?Tester">Test Web Service</a></p>
    </div>

  </body>
</html>
