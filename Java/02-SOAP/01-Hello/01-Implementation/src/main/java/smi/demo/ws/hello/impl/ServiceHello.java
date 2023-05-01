package smi.demo.ws.hello.impl;

import javax.jws.Oneway;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;
import javax.jws.soap.SOAPBinding.Style;

//import smi.demo.ws.hello.IServiceHello;
@WebService(
        /*
		Name of the Web Service.
		Maps to the <wsdl:portType> element in the WSDL file.
		Default value is the unqualified name of the Java class in the JWS file.
         */
        name = "Hello",
        /*
		The XML namespace used for the WSDL and XML elements generated from this Web Service.
		The default value is specified by the JAX-RPC specification. 
         */
        targetNamespace = "http://demo.smi/wsdl",
        /*
		Service name of the Web Service. Maps to the <wsdl:service> element in the WSDL file.
		Default value is the unqualified name of the Java class in the JWS file, appended with the string Service. 
         */
        serviceName = "HelloService"
/*
		More details:
			https://www.jcp.org/en/jsr/detail?id=181
			https://docs.oracle.com/cd/E13222_01/wls/docs92/webserv/annotations.html
 */
)
@SOAPBinding(
        style = Style.DOCUMENT
)
public class ServiceHello /*implements IServiceHello*/ {

  @WebMethod(
    /*
    Name of the operation.
    Maps to the <wsdl:operation> element in the WSDL file.
    Default value is the name of the method. 
     */
    operationName = "sayHello"
  )
  public String sayHello(
      @WebParam(
        /*
        Name of the parameter in the WSDL file.
        The default value is the name of the method’s parameter. 
        */
        name = "user"
      ) String user) {

    System.out.printf("sayHello(%s)\n", user);

    return "Hello " + user;
  }

  @WebMethod(operationName = "foo")
  @Oneway
  public void foo(@WebParam(name = "fooArg") String arg) {
    System.out.printf("foo(%s)\n", arg);
  }
}
