<%@ page import="java.util.ResourceBundle" %>

<%
  session.invalidate();

  String scheme              = request.getScheme();
  String serverName          = request.getServerName();
  int serverPort             = request.getServerPort();
  String webApplication      = request.getContextPath();
    
  String action =
    scheme + "://" +
    serverName + ":" +
    serverPort + "/" +
    webApplication + "/";
    
  response.sendRedirect( action );
%>
