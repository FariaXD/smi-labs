package smi.demo.ws.app;

import java.util.logging.Level;
import java.util.logging.Logger;
import org.apache.commons.cli.CommandLine;
import org.apache.commons.cli.CommandLineParser;
import org.apache.commons.cli.DefaultParser;
import org.apache.commons.cli.HelpFormatter;
import org.apache.commons.cli.Option;
import org.apache.commons.cli.Options;
import org.apache.commons.cli.ParseException;
import org.eclipse.jetty.server.Server;
import org.eclipse.jetty.servlet.ServletContextHandler;
import org.eclipse.jetty.servlet.ServletHolder;
import org.glassfish.jersey.servlet.ServletContainer;

public class RestApplication {

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

  public static void main(String[] args) {
    commandLineOptions = new Options();

    Option optionHelp = new Option("h", "help", false, "Show help");
    Option optionServerPort = new Option("p", "port", true, "Server port");

    commandLineOptions.addOption(optionHelp);
    commandLineOptions.addOption(optionServerPort);

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

    int port = 8080;

    if (commandLine.hasOption("port")) {
      port = Integer.parseInt(commandLine.getOptionValue("port", "8080"));
    }

    System.out.printf("Server port: %d\n", port);

    Server server = new Server(port);

    ServletContextHandler ctx;
    ctx = new ServletContextHandler(ServletContextHandler.NO_SESSIONS);

    ctx.setContextPath("/");
    server.setHandler(ctx);

    ServletHolder serHol = ctx.addServlet(ServletContainer.class, "/rest/*");

    serHol.setInitOrder(1);
    serHol.setInitParameter(
            "jersey.config.server.provider.packages",
            "smi.demo.ws.controller");

    try {
      server.start();
      server.join();
    } catch (Exception ex) {
      Logger.getLogger(RestApplication.class.getName()).log(Level.SEVERE, null, ex);
    } finally {
      try {
        server.stop();
      } catch (Exception ex) {
        Logger.getLogger(RestApplication.class.getName()).log(Level.SEVERE, null, ex);
      }
      server.destroy();
    }
  }
}
