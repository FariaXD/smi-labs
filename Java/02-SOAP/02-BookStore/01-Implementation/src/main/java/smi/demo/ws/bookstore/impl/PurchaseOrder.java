package smi.demo.ws.bookstore.impl;

import java.io.Serializable;

public class PurchaseOrder implements Serializable {

  public String accountName;
  public int accountNumber;
  public Address paddress;
  public Book itemBook;
}
