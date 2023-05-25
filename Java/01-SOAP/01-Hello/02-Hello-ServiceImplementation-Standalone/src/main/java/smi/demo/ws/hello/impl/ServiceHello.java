package smi.demo.ws.hello.impl;

import javax.jws.Oneway;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;
import javax.jws.soap.SOAPBinding.Style;
import smi.demo.ws.hello.IServiceHello;


@WebService(name = "Hello", targetNamespace = "http://demo.smi/wsdl", serviceName = "HelloService")
@SOAPBinding(style = Style.DOCUMENT)
public class ServiceHello implements IServiceHello {

    @WebMethod(operationName = "sayHello")
    public String sayHello( @WebParam(name = "user") String user) {

        System.out.printf("sayHello(%s)\n", user);

        return "Hello " + user;
    }

    @WebMethod(operationName = "addInteger")
    public int addInteger( @WebParam(name = "op1") int op1, @WebParam(name = "op2") int op2) {

        System.out.printf("addInteger(%d, %d)\n", op1, op2);

        return op1 + op2;
    }
        
    @WebMethod(operationName = "addFloat")
    public float addFloat( @WebParam(name = "op1") float op1, @WebParam(name = "op2") float op2) {

        System.out.printf("addFloat(%f, %f)\n", op1, op2);

        return op1 + op2;
    }
    
    @WebMethod(operationName = "foo")
    public void foo(@WebParam(name = "op1") float op1, @WebParam(name = "op2") float op2) {

        System.out.printf( "foo(%f, %f)\n", op1, op2);
    }
    
    @WebMethod(operationName = "buuu")
    @Oneway
    public void buuu(@WebParam(name = "op1") float op1, @WebParam(name = "op2") float op2) {

        System.out.printf( "buuu(%f, %f)\n", op1, op2);
    }
}
