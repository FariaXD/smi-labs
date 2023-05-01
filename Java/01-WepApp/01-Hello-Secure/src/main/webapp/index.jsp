<html>
<%
  String scheme              = request.getScheme();
  String serverName          = request.getServerName();
  int serverPort             = request.getServerPort();
  String webApplication      = request.getContextPath();
    
  String action =
    scheme + "://" +
    serverName + ":" +
    serverPort +
    webApplication + "/pages/Wellcome.jsp";
%>
    <head>
        <title>Main</title>

        <meta http-equiv="Content-Language" content="pt">   
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="-1">      

        <meta http-equiv="Refresh" Content="0; URL=<%=action%>">

        <base target="_self">
    </head>

    <body>
    </body>

</html>
