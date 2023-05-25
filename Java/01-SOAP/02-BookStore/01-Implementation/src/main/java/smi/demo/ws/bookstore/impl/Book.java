package smi.demo.ws.bookstore.impl;

import java.io.Serializable;

public class Book implements Serializable {

  /**
	 * 
	 */
	private static final long serialVersionUID = 8862893647984987782L;

	public String isbn;
  
	public String title;
  
	public int quantity;
  
	public float price;
  
  public Book() {
    this.isbn = "isbn";
    this.title = "title";
    this.quantity = 1;
    this.price = 1.0f;
  }
   
  @Override
  public String toString() {
    return String.format( 
            "{%s, %s, %d, %f}",
            this.isbn,
            this.title,
            this.quantity,
            this.price
            );
  }
}
