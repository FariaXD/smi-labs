package smi.demo.ws.bookstore.impl;

import java.util.ArrayList;
import java.util.List;

public class BookFactory {
  
  private static final List<Book> books;
  
  static {
    books = new ArrayList<>();
    
    Book b1;
    b1 = new Book();
    b1.title = "Java Web Services: Up and Running";
    b1.isbn = "978-1449365110";
    b1.price = 29.73f;
    b1.quantity = 33;
    books.add( b1 );
    
    Book b2;
    b2 = new Book();
    b2.title = "Java Web Services";
    b2.isbn = "978-0596002695";
    b2.price = 36.30f;
    b2.quantity = 21;
    books.add( b2 );
    
    Book b3;
    b3 = new Book();
    b3.title = "Java Web Services in a Nutshell";
    b3.isbn = "978-0596003999";
    b3.price = 19.01f;
    b3.quantity = 28;
    books.add( b3 );
    
    Book b4;
    b4 = new Book();
    b4.title = "RESTful Java Web Services - Third Edition";
    b4.isbn = "978-1788294041";
    b4.price = 44.99f;
    b4.quantity = 14;
    books.add( b4 );
  }
  
  public static Book getBookByISBN(String isbn) {
    for (Book currentBook : books) {
      if ( currentBook.isbn.equalsIgnoreCase(isbn) ) {
        return currentBook;
      }
    }
    return new Book();
  }
  
  public static Book getBookByTitle(String title) {
    for (Book currentBook : books) {
      if ( currentBook.title.equalsIgnoreCase(title) ) {
        return currentBook;
      }
    }
    return new Book();
  }
  
  public static String[] getBookTitles() {
    String[] result;
    result = new String[ books.size() ];
    
    int idxBook;
    idxBook = 0;
    for (Book currentBook : books) {
      result[ idxBook++ ] = currentBook.title; 
    }
    
    return result;
  }
}
