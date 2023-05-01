<html>
    <head>
        <title>My Protected Application Demo - Wellcome page</title>

        <meta http-equiv="Content-Language" content="pt">
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="-1">
    </head>

    <body>
        <p>Isto � a p�gina de boas vindas!</p>

        <p>Voc� est� <i>"logginado"</i> como o utilizador <b><%= request.getRemoteUser() %></b> na sess�o <b><%= session.getId() %></b><p>

<%
    if (request.getUserPrincipal() != null) {
%>
        <p>O seu nome <i>Principal</i> � <b><%= request.getUserPrincipal().getName() %></b></p>
<%
    } else {
%>
        <p>N�o foi poss�vel obter o seu <i>Principal</i></p>  
<%
    }
%>

<%
    String role = request.getParameter("role");
    if (role == null) {
        role = "";
    }
    
    if (role.length() > 0) {
        if (request.isUserInRole(role)) {
%>
        <p>Foi-lhe atribu�do o role <b><%= role %></b></p>
<%
        } else {
%>
        <p>N�o lhe foi atribu�do role <b><%= role %></b></p>
<%
        }
    }
%>
        <p>Resources for administrators</p>
        <p><i><a href="admin/AP1.pdf" target="_blank">Link</a></i> para um documento PDF.</p>
        
        <p>Resources for all users</p>
        <p><i><a href="users/docs/AP2.pdf" target="_blank">Link</a></i> para um documento PDF.</p>
    
        <p><i><a href="users/images/monitor.gif" target="_blank">Link</a></i> para uma imagem protegida.</p>

        <p>E o resto fica � vossa imagina��o :)</p>
    
	<br>
	<p>Pode sair <a href="<%=request.getContextPath() + "/pages/Logout.jsp"%>">aqui</a>.
    </body>

</html>
