package smi.demo.ws.bookstore.impl;

import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.Writer;

import javax.xml.bind.JAXBContext;
import javax.xml.bind.Marshaller;
import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement(name = "ApplicationSettings")
public class ApplicationSettings {
  private String applicationName;
  
  @XmlElement(name = "ApplicationName")
  public String getApplicationName() {
    return applicationName;
  }

  public void setApplicationName(String applicationName) {
    this.applicationName = applicationName;
  }
  
  private Marshaller getMarshaller() throws Exception {
    JAXBContext context;
    context = JAXBContext.newInstance(this.getClass());

    Marshaller m;
    m = context.createMarshaller();
    m.setProperty(Marshaller.JAXB_FORMATTED_OUTPUT, Boolean.TRUE);

    return m;
  }

  public static ApplicationSettings load(File fileName) throws Exception {
    return load( fileName.getAbsolutePath() );
  }

  public static ApplicationSettings load(String fileName) throws Exception {
    ApplicationSettings result;

    JAXBContext context;
    context = JAXBContext.newInstance(ApplicationSettings.class);

    Unmarshaller unMarshaller;
    unMarshaller = context.createUnmarshaller();
    result = (ApplicationSettings) unMarshaller.unmarshal(new FileReader(fileName));

    return result;
  }

  public void save(String fileName) throws Exception {
    Writer w;
    w = new FileWriter(fileName);
    getMarshaller().marshal(this, w);
    w.close();
  }

  public void show() throws Exception {
    getMarshaller().marshal(this, System.out);
  }

  public ApplicationSettings() {
    this.applicationName = "Book Store";
  }
  
  @Override
  public String toString() {
    return this.getApplicationName();
  }
}