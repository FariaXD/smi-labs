package smi.demo.ws.bookstore.client;

import java.io.FileReader;
import java.io.FileWriter;
import java.io.Writer;
import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.JAXBContext;
import javax.xml.bind.Marshaller;
import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlElementWrapper;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlType;

@XmlRootElement(name = "ServiceLocations")
@XmlType(propOrder={
  "description", 
  "locations" 
})
public class ServiceLocations {
  private String description;
  
  @XmlElement(name = "Description")
  public String getDescription() {
    return description;
  }

  public void setDescription(String description) {
    this.description = description;
  }
  
  private List<String> locations;
  
  @XmlElementWrapper(name = "Locations")
  @XmlElement(name = "ServiceLocation")
  public List<String> getLocations() {
    return locations;
  }

  public void setLocations(List<String> locations) {
    this.locations = locations;
  }
  
  private Marshaller getMarshaller() throws Exception {
    JAXBContext context;
    context = JAXBContext.newInstance(this.getClass());

    Marshaller m;
    m = context.createMarshaller();
    m.setProperty(Marshaller.JAXB_FORMATTED_OUTPUT, Boolean.TRUE);

    return m;
  }

  public static ServiceLocations load(String fileName) throws Exception {
    ServiceLocations result;

    JAXBContext context;
    context = JAXBContext.newInstance(ServiceLocations.class);

    Unmarshaller unMarshaller;
    unMarshaller = context.createUnmarshaller();
    result = (ServiceLocations) unMarshaller.unmarshal(new FileReader(fileName));

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

  public ServiceLocations() {
    this.description = "Book store services locations";
    this.locations = new ArrayList<>();
  }  
}