package smi.demo.ws.bookstore.impl;

import java.io.File;
import java.io.FileInputStream;
import java.io.InputStream;

import javax.annotation.Resource;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.soap.SOAPBinding;
import javax.jws.soap.SOAPBinding.Style;
import javax.jws.soap.SOAPBinding.Use;

import javax.servlet.ServletContext;

import javax.xml.ws.soap.MTOM;

import javax.xml.ws.WebServiceContext;
import javax.xml.ws.handler.MessageContext;

@MTOM(
        enabled=true, 
        threshold=1024*50)
@SOAPBinding(
        use=Use.LITERAL, 
        style=Style.DOCUMENT)
@WebService(
        serviceName = "ServiceBookStore")
public class ServiceBookStore {
  
  @Resource
  private WebServiceContext context;
	
	private String configDirectory;
  
  private String getConfigDirectory() {
    if ( this.configDirectory!=null ) {
      return this.configDirectory;
    }
    
    ServletContext servletContext;
    servletContext = (ServletContext)context.getMessageContext().get( MessageContext.SERVLET_CONTEXT );
    
    String rootPath;
    rootPath = servletContext.getRealPath( "/" );
    
    String cfgDirectory = (new File( rootPath, "conf" )).getAbsolutePath();
    
    System.out.printf( "getConfigDirectory() -> %s\n", cfgDirectory );
    
    return cfgDirectory;
  }
  
  public ServiceBookStore() {
    this.configDirectory = null;
  }
	
	public ServiceBookStore(String configDirectory) {
		this.configDirectory = configDirectory;

    System.out.printf( "Config directory: %s\n", (new File( this.configDirectory )).getAbsolutePath() );
	}
   
	@WebMethod(operationName = "getStoreName")
	public String getStoreName() {
		String result;
    
		try {
			File file;
			file = new File( this.getConfigDirectory(), "ApplicationSettings.xml" );
	  
			ApplicationSettings appSettings = ApplicationSettings.load( file );

			result = appSettings.getApplicationName();
		}
		catch (Exception ex) {
			ex.printStackTrace( System.err );
			result = "Book store";
		}

		return result;
	}
  
	@WebMethod(operationName = "getBookISBN")
	public String getBookISBN(@WebParam(name = "title") String _title) {
		Book book;
		book = BookFactory.getBookByTitle( _title );

		return book.isbn;
	}
  
	@WebMethod(operationName = "getBookCover")
	public byte[] getBookCover(@WebParam(name = "title") String title) {
		byte[] result;
    
		try {    
			File file;
			file = new File( this.getConfigDirectory(), "images" + File.separator + title + ".jpg" );

			result = new byte[ (int)file.length() ];

			InputStream input;
			input = new FileInputStream( file );
			int currentSize;
			currentSize = input.read( result );
			input.close();
			System.out.println( "Sent " + currentSize + " bytes" );
		}
		catch (Exception ex) {
			ex.printStackTrace( System.err );
			result = null;
		}    

		return result;
	}
  
	@WebMethod(operationName = "getBookPrice")
	public float getBookPrice(@WebParam(name = "isbn") String isbn) {
		Book book;
		book = BookFactory.getBookByISBN(isbn);
		return book.price;
	}
  
	@WebMethod(operationName = "getBookByISBN")
	public Book getBookByISBN(@WebParam(name = "isbn") String isbn) {
		return BookFactory.getBookByISBN( isbn );
	}
  
	@WebMethod(operationName = "getBookByTitle")
	public Book getBookByTitle(@WebParam(name = "title") String title) {
		Book book;
		book = BookFactory.getBookByTitle(title);

		return book;
	}
  
	@WebMethod(operationName = "getBookTitles")
	public String[] getBookTitles() {
		return BookFactory.getBookTitles( );
	}

	@WebMethod(operationName = "submitPurchaseOrder")
	public String submitPurchaseOrder(@WebParam(name = "order") PurchaseOrder order) {
		return "OK: " + order.accountName + " : " + order.accountNumber;
	}
}
