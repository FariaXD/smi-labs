package smi.demo.ws.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import smi.demo.ws.bean.Country;

/*
 * It is just a helper class which should be replaced by database implementation.
 * It is not very well written class, it is just used for demonstration.
 */
public class CountryService {

	static HashMap<Integer,Country> countryIdMap=getCountryIdMap();

	public CountryService() {
		super();

		if( countryIdMap==null ) {
			countryIdMap=new HashMap<Integer,Country>();

			// Creating some object of countries while initializing
			Country indiaCountry  = new Country( 1, "India", 10000 );
			Country chinaCountry  = new Country( 4, "China", 20000 );
			Country nepalCountry  = new Country( 3, "Nepal", 8000 );
			Country bhutanCountry = new Country( 2, "Bhutan", 7000 );

			countryIdMap.put( indiaCountry.getId(), indiaCountry);
			countryIdMap.put( chinaCountry.getId(), chinaCountry);
			countryIdMap.put( nepalCountry.getId(), nepalCountry);
			countryIdMap.put( bhutanCountry.getId(), bhutanCountry);
		}
	}

	public List<Country> getAllCountries() {
		List<Country> countries = new ArrayList<Country>( countryIdMap.values() );

		return countries;
	}

	public Country getCountry(int id) {
		Country country= countryIdMap.get( id );

		return country;
	}
	
	public Country addCountry(Country country) {
		country.setId( countryIdMap.size() + 1 );
		countryIdMap.put( country.getId(), country );

		return country;
	}
	
	public Country updateCountry(Country country) {
		if( country.getId()<=0 ) {
			return null;
		}
		
		countryIdMap.put(country.getId(), country);

		return country;
	}
	
	public void deleteCountry(int id) {
		countryIdMap.remove(id);
	}

	public static HashMap<Integer, Country> getCountryIdMap() {
		return countryIdMap;
	}
}
