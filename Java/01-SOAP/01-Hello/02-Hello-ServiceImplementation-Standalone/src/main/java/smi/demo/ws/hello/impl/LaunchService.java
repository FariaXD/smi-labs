package smi.demo.ws.hello.impl;

import javax.xml.ws.Endpoint;

import org.apache.commons.cli.CommandLine;
import org.apache.commons.cli.CommandLineParser;
import org.apache.commons.cli.DefaultParser;
import org.apache.commons.cli.HelpFormatter;
import org.apache.commons.cli.Option;
import org.apache.commons.cli.Options;
import org.apache.commons.cli.ParseException;


public class LaunchService {
    private static CommandLine commandLine;
    private static CommandLineParser commandLineParser;
    private static Options commandLineOptions;
	
    private static String defaultServiceEndPoint = 
            "http://localhost:8081/serviceHello";
	
    private static void showHelp() {
        String header = "";
        String message = "java <JVM options> -jar ServiceBookStoreImplementation-1.0.0-jar-with-dependencies.jar <arguments>";
        String footer = "\nPlease report issues to carlos.goncalves@isel.pt";

        HelpFormatter formatter = new HelpFormatter();
        formatter.printHelp(
                message, 
                header, 
                commandLineOptions, 
                footer, 
                false);
    }

    public static void main(String[] args) {
        commandLineOptions = new Options();

        Option optionHelp = new Option( 
                "h", "help", 
                false, 
                "Show help");
        Option optionServiceEndPoint = new Option( 
                "e", "endPoint", 
                true, 
                "Service end point");

        commandLineOptions.addOption( optionHelp );
        commandLineOptions.addOption( optionServiceEndPoint );

        commandLineParser = new DefaultParser();
        try {
            commandLine = commandLineParser.parse(
                    commandLineOptions, 
                    args);
        } catch (ParseException e) {
            System.out.println( "Parsing failed. Reason: " + e.getMessage() );
            showHelp();
            System.exit(0);
        }

        if ( commandLine.hasOption("help") ) {
            showHelp();
            System.exit(0);
        }
		
        String serviceEndPoint;
        if ( commandLine.hasOption( "endPoint" ) ) {
            serviceEndPoint = commandLine.getOptionValue( "endPoint" );
        }
        else {
            System.out.println( "Using default service end point." );
            serviceEndPoint = LaunchService.defaultServiceEndPoint;
        }
				
        ServiceHello serviceImpl = new ServiceHello();

        System.out.printf( "Creating service end point...\n" );
        Endpoint ep = Endpoint.create( serviceImpl );

        System.out.printf( "Starting site server (%s)...\n", serviceEndPoint );
        ep.publish( serviceEndPoint );
    }
}
