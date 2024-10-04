import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.PrintWriter;

@WebServlet("/impuesto")
public class impuesto extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) 
        throws ServletException, IOException {


        String codigoCatastral = request.getParameter("codigo_catastral");

     
        if (codigoCatastral != null && !codigoCatastral.isEmpty()) {
            char primerDigito = codigoCatastral.charAt(0);

       
            String mensaje = "";
            switch (primerDigito) {
                case '1':
                    mensaje = "Impuesto Alto";
                    break;
                case '2':
                    mensaje = "Impuesto Medio";
                    break;
                case '3':
                    mensaje = "Impuesto Bajo";
                    break;
                default:
                    mensaje = "Numero no valido para impuesto";
                    break;
            }


            response.setContentType("text/html");
            PrintWriter out = response.getWriter();
            out.println("<html><head>\n" );
            out.println("<meta charset=\"utf-8\">\n" );
            out.println("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n" );
            out.println("<title>JAVA IMPUESTO</title>\n" );
            out.println("<link href=\'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\' rel=\'stylesheet\' integrity=\'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH\' crossorigin=\'anonymous\'>\n" );
            out.println("<style>");
            out.println("body { font-family: Arial, sans-serif; margin: 20px; }");
            out.println("h1 { color: #333; }");
            out.println("h2 { color: green; }");
            out.println("p { font-size: 18px; }");
            out.println("</style>");
            out.println("</head><body>");
            out.println("<div class='container'>");
            out.println("<h1>Tipo de Impuesto</h1>");
            out.println("<h3>Codigo Catastral: " + codigoCatastral + "</h3>");
            out.println("<h2>" + mensaje + "</h2>");
            out.println("</div>");
            out.println("</body></html>");
            out.flush();
        } else {
            response.sendError(HttpServletResponse.SC_BAD_REQUEST, "Numero invalido");
        }
    }
}
