package smi.demo.ws.hello.client;

import org.apache.commons.cli.CommandLine;
import org.apache.commons.cli.CommandLineParser;
import org.apache.commons.cli.DefaultParser;
import org.apache.commons.cli.HelpFormatter;
import org.apache.commons.cli.Option;
import org.apache.commons.cli.Options;
import org.apache.commons.cli.ParseException;

import java.net.URL;

import smi.demo.ws.hello.proxy.HelloService;
import smi.demo.ws.hello.proxy.Hello;

public class ClientHelloServiceMain {

    private static CommandLine commandLine;
    private static CommandLineParser commandLineParser;
    private static Options commandLineOptions;

    private static void showHelp() {
        String header = "";
        String message = "java <JVM options> -jar ServiceHelloClient-1.0.0-jar-with-dependencies.jar <arguments>";
        String footer = "\nPlease report issues to carlos.goncalves@isel.pt";

        HelpFormatter formatter = new HelpFormatter();
        formatter.printHelp(message, header, commandLineOptions, footer, false);
    }

    public static void main(String[] args) throws Exception {
        commandLineOptions = new Options();

        Option optionHelp = new Option("h", "help", false, "Show help");
        Option optionServiceEndPoint = new Option("e", "endPoint", true, "Service end point");
        Option optionUserName = new Option("a", "arg", true, "Web Service argument");

        commandLineOptions.addOption(optionHelp);
        commandLineOptions.addOption(optionServiceEndPoint);
        commandLineOptions.addOption(optionUserName);

        commandLineParser = new DefaultParser();
        try {
            commandLine = commandLineParser.parse(commandLineOptions, args);
        } catch (ParseException e) {
            System.out.println("Parsing failed. Reason: " + e.getMessage());
            showHelp();
            System.exit(0);
        }

        if (commandLine.hasOption("help")) {
            showHelp();
            System.exit(0);
        }

        String argument = null;

        if (!commandLine.hasOption("arg")) {
            System.out.println("Web Service argument not specified.");
            System.exit(0);
        } else {
            argument = commandLine.getOptionValue("arg");
        }

        String serviceEndPoint;

        if (commandLine.hasOption("endPoint")) {
            serviceEndPoint = commandLine.getOptionValue("endPoint");
        } else {
            System.out.println("Using default service end point.");
            serviceEndPoint = "http://localhost:8081/serviceHello";
        }

        System.out.printf("Service end point: %s\n", serviceEndPoint);

        HelloService proxy = new HelloService( new URL( serviceEndPoint ) );
        Hello service = proxy.getHelloPort();

        System.out.printf("Invoking Web Service operation with \"%s\"...\n", argument);

        System.out.println( service.sayHello(argument) );
        System.out.println( service.addInteger( 4, 2) );
        System.out.println( service.addFloat( (float)2.0, (float)1.5) );
        service.buuu(1, 2);
        service.foo(3, 3);
    }
}
