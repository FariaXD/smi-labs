package smi.demo.ws.bookstore.impl;

import java.io.Serializable;

public class PurchaseOrder implements Serializable {

  /**
	 * 
	 */
	private static final long serialVersionUID = -4439133270898657093L;

	public String accountName;
  
	public int accountNumber;
  
	public Address paddress;
  
	public Book itemBook;
}
