package smi.demo.ws.bookstore.client;

import org.apache.commons.cli.CommandLine;
import org.apache.commons.cli.CommandLineParser;
import org.apache.commons.cli.DefaultParser;
import org.apache.commons.cli.HelpFormatter;
import org.apache.commons.cli.Option;
import org.apache.commons.cli.Options;
import org.apache.commons.cli.ParseException;

import java.net.URL;

import smi.demo.ws.bookstore.proxy.ServiceBookStore_Service;
import smi.demo.ws.bookstore.proxy.ServiceBookStore;

public class ClientBookStoreServiceMain {

  private static CommandLine commandLine;
  private static CommandLineParser commandLineParser;
  private static Options commandLineOptions;

  private static void showHelp() {
    String header = "";
    String message = "java <JVM options> -jar ClientServiceBook-1.0.0-jar-with-dependencies.jar <arguments>";
    String footer = "\nPlease report issues to carlos.goncalves@isel.pt";

    HelpFormatter formatter = new HelpFormatter();
    formatter.printHelp(message, header, commandLineOptions, footer, false);
  }

  public static void main(String[] args) throws Exception {
    commandLineOptions = new Options();

    Option optionHelp = new Option("h", "help", false, "Show help");
    Option optionConfigurationDir = new Option("c", "conf", true, "Configuration directory");

    commandLineOptions.addOption(optionHelp);
    commandLineOptions.addOption(optionConfigurationDir);

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

    String configDirectory;
    if (commandLine.hasOption("conf")) {
      configDirectory = commandLine.getOptionValue("conf");
    } else {
      System.out.println("Using default configuration directory.");
      configDirectory = ".";
    }

    ClientBookGUI client;
    client = new ClientBookGUI(configDirectory);
  }
}
